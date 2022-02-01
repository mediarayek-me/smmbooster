<?php

namespace App\Http\Controllers\Admin;

use Stripe\Charge;
use App\Models\User;
use PayPal\Api\Item;
use Stripe\Customer;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;

use PayPal\Rest\ApiContext;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use App\Models\PaymentMethod;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
     

    public function __construct()
    {
         /** PayPal api context **/
         $paypal_conf = \Config::get('paypal');
         $this->_api_context = new ApiContext(new OAuthTokenCredential(
             $paypal_conf['client_id'],
             $paypal_conf['secret'])
         );
         $this->_api_context->setConfig($paypal_conf['settings']);
    }
    
    /**
     * Add funds to user account
     * @return \Illuminate\Http\Response
     */
    public function addFunds(Request $request,$payment_method = null)
    {
        if($request->isMethod('post')){
           if($payment_method == 'stripe')   
           return $this->payWithStrip($request);         
           elseif($payment_method == 'paypal')            
           return $this->payWithPaypal($request);         
        }

        $paymentMethods = PaymentMethod::where('status','active')->get();
        return view('admin.add_funds',compact('paymentMethods'));
    }
    public function payWithStrip($request){

         // request validation
         $validator = Validator::make($request->all(), [
            'stripe_token'=> 'required ',
            'min' => 'required | numeric',
            'max' => 'required | numeric',
            'method_id' => 'required ',
            //'amount' => 'required | numeric | gte:'.(int)$request->input('min').' | lte:'.(int)$request->input('max')
            'amount' => 'required | numeric ',
            'amount_total' => 'required | numeric '
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->messages(),400);
        }
     
         // get your logged in customer
        $customer = Auth::user();
      //  $customer  = User::factory()->create();
         // stripe customer payment token
        $stripe_token = $request->input('stripe_token');
        $amount = (float) $request->input('amount') * 100;
        $amount_total = (float)$request->input('amount_total') * 100;
        $method_id = $request->input('method_id');
        $paymentMethod = PaymentMethod::where('id',$method_id)->first();
        $paymentMethod->makeVisible('private_key');
        $user_id = $customer->id;
       
            // make sure that if we do not have customer token already
            // then we create nonce and save it to our database
            if ( !$customer->stripe_token ) 
            {
                  // once we received customer payment nonce
                  // we have to save this nonce to our customer table
                  // so that next time user does not need to enter his credit card details
                  $result = \Stripe\Customer::create(array(
                      "email"  => $customer->email,
                      "source" => $stripe_token['id']
                  ));

                  
                

                  if( $result && $result->id )
                  {
                      $customer->stripe_id = $result->id;
                      $customer->stripe_token = $stripe_token;
                      $customer->save();
                  }
            }
            if( $customer->stripe_token) 
            {
                // charge customer with your amount
                $result = \Stripe\Charge::create(array(
                     "currency" => "usd",
                     "customer" => $customer->stripe_id,
                     "amount"   => $amount_total // amount in cents                                                 
                ));

                // get transaction details
                $balance_transaction = $result->balance_transaction;
                  
                  $stripe = new \Stripe\StripeClient($paymentMethod->private_key);
                  $transactions_details = $stripe->balanceTransactions->retrieve(
                    $balance_transaction,
                    []
                  );

                // store transaction info for logs
                $transaction = new \App\Models\Transaction();
                $transaction->method_id =  $paymentMethod->id;
                $transaction->transaction_id =  $result->balance_transaction;
                $transaction->user_id =  Auth::user()->id;
                $transaction->fee =  $transactions_details->fee/100;
                $transaction->amount = $amount_total / 100;
                $transaction->profit = $transaction->amount - $transaction->fee;
                $transaction->take_fee = ($amount / 100) *  $paymentMethod->fee / 100;
                $transaction->status =  $result->paid ? 'paid' : 'refund';
                $transaction->save();

                // add funds to user
                $this->increaseBalance($amount/100);


                return response()->json(['result'=>$result,'transactions_details'=>$transactions_details], 200);
            } 
    }
    public function payWithPaypal($request){
        {
            // request validation
         $validator = Validator::make($request->all(), [
            'min' => 'required | numeric',
            'max' => 'required | numeric',
            'amount' => 'required | numeric ',
            'amount_total' => 'required | numeric ',
            'method_id' => 'required | numeric '
        ]);

        $method_id = $request->input('method_id');
        $paymentMethod = PaymentMethod::where('id',$method_id)->first();
        \Session::put('payment_method', $paymentMethod);
        
        if ($validator->fails()) {
            return response()->json($validator->messages(),400);
        }
        $amountToBePaid = $request->input('amount_total');
        $amountWithoutFee = $request->input('amount');
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        
        \Session::put('amount_to_BePaid', $amountToBePaid);
        \Session::put('amount_without_fee', $amountWithoutFee);

            $item_1 = new Item();
            $item_1->setName('Add funds Payment') /** item name **/
                    ->setCurrency('USD')
                    ->setQuantity(1)
                    ->setPrice($amountToBePaid); /** unit price **/
        
            $item_list = new ItemList();
            $item_list->setItems(array($item_1));
        
            $amount = new Amount();
            $amount->setCurrency('USD')
                   ->setTotal($amountToBePaid);
            $redirect_urls = new RedirectUrls();
            /** Specify return URL **/
            $redirect_urls->setReturnUrl(URL::route('user.get-payment-status'))
                      ->setCancelUrl(URL::route('user.get-payment-status'));
            
            $transaction = new \PayPal\Api\Transaction();
            $transaction->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription('Add funds');   
         
            $payment = new Payment();
            $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));
            try {
                 $payment = $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                 if (\Config::get('app.debug')) {
                    \Session::put('error', 'Connection timeout');
                   return response()->json([], 400);
                 } else {
                    \Session::put('error', 'Some error occur, sorry for inconvenient');
                   return response()->json([], 400);
                 }
            }

            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                   $redirect_url = $link->getHref();
                   break;
                }
              }
            /** add payment ID to session **/
            \Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
               /** redirect to paypal **/
              return response()->json(['payment_id'=>$payment->getId(),'redirect_url'=>$redirect_url], 200);
            }
        
            \Session::put('error', 'Unknown error occurred');
           return 0;
          }

    }

    public function getPaymentStatus(Request $request){
        /** Get the payment ID before session clear **/
      $payment_id = Session::get('paypal_payment_id');
      /** clear the session payment ID **/
      Session::forget('paypal_payment_id');
      if (empty($request->PayerID) || empty($request->token)) {
         session()->flash('error', 'Payment failed');
         return 'Payment failed';
      }
      $payment = Payment::get($payment_id, $this->_api_context);
      $execution = new PaymentExecution();
      $execution->setPayerId($request->PayerID);
      /**Execute the payment **/
      $result = $payment->execute($execution, $this->_api_context);
      if ($result->getState() == 'approved') {
          // transaction fee
        // dd($result->getTransactions()[0]->getRelatedResources()[0]);
         $transaction_details = $result->getTransactions()[0]->getRelatedResources()[0];
         $paymentMethod = \Session::get('payment_method');
         $amountToBePaid = \Session::get('amount_to_BePaid');
         $amountWithoutFee = \Session::get('amount_without_fee');
         Session::forget('payment_method');
         Session::forget('amount_to_BePaid');
         Session::forget('amount_without_fee');
         Session::forget('success_payment');

        // add balance to user
        $this->increaseBalance($amountWithoutFee);

        // store transaction info for logs
         $transaction = new \App\Models\Transaction();
         $transaction->method_id =  $paymentMethod->id;
         $transaction->transaction_id = $transaction_details->sale->getId();
         $transaction->user_id =  Auth::user()->id;
         $transaction->fee =  $transaction_details->sale->getTransactionFee()->getValue();
         $transaction->amount = $amountToBePaid;
         $transaction->profit = $transaction->amount  -  $transaction->fee;
         $transaction->take_fee = $amountWithoutFee *  $paymentMethod->fee / 100;

         $transaction->status =  $transaction_details->sale->getState() == 'completed' ? 'paid' : 'refund';
         $transaction->save();

         \Session::put('success_payment',true);
        
        return redirect(URL::route('user.transactions.index'));
    }
    session()->flash('error', 'Payment failed');
    
    }

    public function increaseBalance($funds)
    {
        $user = Auth::user();
        $user->update(['funds'=> ($user->funds + $funds)]);
    }

}
