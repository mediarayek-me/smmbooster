const baseUrl = 'payment-methods/'
const app = new Vue({
    el: '#app',
    data: {
        postdata: {},
        errors: {},
        payementMethod: {},
        card: {},
        stripe: {},
        total_funds:0,
        stripe_payment_id : 2, // id of strip payement method
        loading:true,
        processing:false
    },
    methods: {
        valideForm: function () {
            this.errors = {}
            if (!this.postdata.confirmation)
                this.$set(this.errors, 'confirmation', {
                    required: true
                })
            if (!this.postdata.amount)
                this.$set(this.errors, 'amount', {
                    required: true
                })
            if (this.postdata.amount && parseFloat(this.postdata.amount) < parseFloat(this.payementMethod.min))
                this.$set(this.errors, 'amount', {
                    min: true
                })
            if (this.postdata.amount && parseFloat(this.postdata.amount) > parseFloat(this.payementMethod.max))
                this.$set(this.errors, 'amount', {
                    max: true
                })
            // validate card input
            // to do
        },
    addFunds:  function (id = null){
        this.getPaymentMethod(res => {
            this.payementMethod = res.data
            this.$set(this.postdata,'min',res.data.min)
            this.$set(this.postdata,'max',res.data.max)
            this.$set(this.postdata,'method_id',id)
            this.$set(this.postdata,'amount',parseFloat(this.postdata.amount))
            this.valideForm()
            if (Object.keys(this.errors).length == 0 && document.getElementById('card-errors').textContent.length == 0) {
                this.processing = true
                // Send the token to your server
                if(this.payementMethod.id == 2 )  //stipe
                {
                var method_name = 'stripe'
                this.stripe.createToken(this.card).then((result) =>{
                    if (result.error) {
                        // Inform the user if there was an error
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        //console.log(result.token);
                        this.$set(this.postdata,'stripe_token',result.token)
                        axios.post('add-funds/'+method_name,this.postdata).then(res => {
                            
                             if(res.status == 200){
                                 //console.log(res.data);
                                 this.card.clear()
                                 window.utilities.notify('success','your payment has been processed successfully')
                                 this.postdata = {}
                                 this.processing = false
                             }
                         }).catch(e =>{
                            $(this.modal_target).modal('hide'); 
                            window.utilities.notify('error',"for security reasons you can't update data in demo version")
                        })
                    }
                 });
                }else if(this.payementMethod.id == 1 )  //paypal
                {
                var method_name = 'paypal'
                axios.post('add-funds/'+method_name,this.postdata).then(res => {
                    
                     if(res.status == 200){
                         //console.log(res.data);
                         this.card.clear()
                         this.postdata = {}
                         this.processing = false
                         window.location.href = res.data.redirect_url
                     }
                 }).catch(e=>{
                    if(e.response.status == 300)
                    {
                        $(this.modal_target).modal('hide'); 
                        window.utilities.notify('error',"for security reasons you can't update data in demo version")
                    }})
                }

             
            }
        }, id)
    },
    getPaymentMethod: function (callback, id) {
        axios.get(baseUrl + id).then(res => {
            if (res.status == 200)
                callback(res)
        })
    },
    getCard() {
        // Create a Stripe client
        axios.get(baseUrl + this.stripe_payment_id).then(res => {
            if (res.status == 200) {
                 this.stripe = Stripe(res.data.api_key,{ locale: 'en'});

                // Create an instance of Elements
                var elements = this.stripe.elements();

                // Custom styling can be passed to options when creating an Element.
                // (Note that this demo uses a wider set of styles than the guide below.)
                var style = {
                    base: {
                        color: '#32325d',
                        lineHeight: '24px',
                        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#aab7c4'
                        }
                    },
                    invalid: {
                        color: '#e04f1a',
                        iconColor: '#e04f1a'
                    }
                };

                // Create an instance of the card Element
                var card = elements.create('card', {
                    style: style
                });

                this.card = card;
                this.loading = false
                
                // Add an instance of the card Element into the `card-element` <div>
                setTimeout(() => {
                    card.mount('#card-element');

                // Handle real-time validation errors from the card Element.
                card.addEventListener('change', function (event) {
                    var displayError = document.getElementById('card-errors');
                    if (event.error) {
                        displayError.textContent = event.error.message;
                    } else {
                        displayError.textContent = '';
                    }
                });
                }, 0);
            }
        })
    },
    getAmount: function(){
        if(this.postdata.amount){
            var fee =  0;
        if($('#payement1').hasClass('active'))
            fee  = parseFloat($('#paypal_fee').html())
        if($('#payement2').hasClass('active'))
            fee  = parseFloat($('#strip_fee').html())

            //console.log(fee);
            this.total_funds = parseFloat( this.postdata.amount) + parseFloat(this.postdata.amount * fee / 100)
             this.$set(this.postdata,'amount_total',this.total_funds.toFixed(2))
        }else
        this.$set(this.postdata,'amount_total',0)
    }
    },

    mounted() {
        this.getCard()
    },
})
