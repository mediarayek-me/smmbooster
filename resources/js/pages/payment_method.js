

 const baseUrl = 'payment-methods/'
 import paymentMethod from '../components/PaymentMethodComponent.vue'
 const app = new Vue({
     el: '#app',
     data:{
     postdata : {},
     errors : {},
     modal_target :'#edit-payment-method-modal',
     delete_item : 0,
     paymentMethods : {},
     search : '',
     loading : true
     },
     components:{
         'payment-method-item':paymentMethod
     },
     methods:{
     loadModal : function(id = null){
         if(!id){
         this.initForm()
         $(this.modal_target).modal('show');
         }
         else{
             axios.get(window.location.href+'/'+id).then(res=>{
                if(res.status == 200){
                this.postdata = res.data
                $(this.modal_target).modal('show');
               }
            })
         }
    },
    closeModal: function(){
         $(this.modal_target).modal('hide');
     },
    storePaymentMethod: function(id = null){
         this.valideForm()
         if(Object.keys(this.errors).length  == 0)
         {
             // store new paymentMethod
            if(!id){
                axios.post(baseUrl,this.postdata).then(res=>{
                    if(res.status == 200){
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('success','New payment Method added successfully')
                    this.getPaymentMethods()
                }
                }).catch(e=>{
                    if(e.response.status == 300)
                    {
                        $(this.modal_target).modal('hide'); 
                        window.utilities.notify('error',"for security reasons you can't update data in demo version")
                    }})

            }else{
            // edit paymentMethod
            axios.put(window.location.href+'/'+id,this.postdata).then(res=>{
                if(res.status == 200){
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('success','payment method updated successfully')
                    this.getPaymentMethods()
                }
            }).catch(e=>{
                if(e.response.status == 300)
                {
                    $(this.modal_target).modal('hide'); 
                    window.utilities.notify('error',"for security reasons you can't update data in demo version")
                }})
            }
         }
     },
    getPaymentMethods:function(page){
        this.loading = true
        if (typeof page === 'undefined') page = 1;
        
        let url = '?api=true&page='+ page

        if(this.search != undefined && this.search.length) url += '&search='+this.search

        axios.get(url).then(res=>{
            if(res.status == 200){
            this.paymentMethods = res.data
            this.loading = false
            }
        })
     },
    loadModalDelete : function(id){
         this.delete_item = id
         $('#modal-delete').modal('show')
        },
     deleteItem : function(){
     axios.delete(window.location.href+'/'+this.delete_item).then(res=>{
        if(res.status == 200){
            $('#modal-delete').modal('hide')
            window.utilities.notify('success','item deleted successfully')
            this.getPaymentMethods()
        }
        }).catch(e=>{
            if(e.response.status == 300)
            {
                $('#modal-delete').modal('hide'); 
                window.utilities.notify('error',"for security reasons you can't update data in demo version")
            }})
     },
     valideForm : function(){
         this.errors = {}
        if(!this.postdata.name)
            this.$set(this.errors,'name',{required : true})
        else if(this.postdata.name.length > 150){
            this.$set(this.errors,'name',{over_length : true})
        }

     },
     initForm : function(){
        this.$set(this.postdata,'status','active')
        this.$set(this.postdata,'description','')
        this.$set(this.postdata,'name','')
     }
     },
     mounted: function(){
        this.initForm()
        this.getPaymentMethods()
     }
 });
 
