<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMethodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return  [
            'name'=> 'Paypal Checkout',
            'min'=>10,
            'max'=>10000000,
            'status'=>'active',
            'fee'=>0,
            'environment'=>'sanbox',
            'api_key'=>'api_key',
            'private_key'=>'private_key',
            'client_id'=>'client_id',
            'image'=>'image.png'

        ];
    }
}
