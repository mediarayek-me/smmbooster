

 const baseUrl = 'transactions/'
 import transaction from '../components/TransactionComponent.vue'
 const app = new Vue({
     el: '#app',
     data:{
     postdata : {},
     errors : {},
     modal_target :'#edit-transaction-modal',
     delete_item : 0,
     transactions : {},
     permissions : {},
     search : '',
     loading : true
     },
     components:{
         'transaction-item':transaction
     },
     methods:{
     loadModal : function(id = null){
         axios.get(window.location.href+'/'+id).then(res=>{
             
             if(res.status == 200){
                 this.postdata = res.data
                 this.$set(this.postdata,'user_email',res.data.user.email)
                 this.$set(this.postdata,'amount',this.$options.filters.toCurrency(this.postdata.amount))
                 this.$set(this.postdata,'fee',this.$options.filters.toCurrency(this.postdata.fee))
                 $(this.modal_target).modal('show');
               }
            })
    },
    closeModal: function(){
         $(this.modal_target).modal('hide');
     },
    storeTransaction: function(id = null){
         //console.log(this.postdata);
            // edit transaction
            axios.put(window.location.href+'/'+id,this.postdata).then(res=>{
                if(res.status == 200){
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('success','transaction updated successfully')
                    this.getTransactions()
                }
            })
     },
    getTransactions:function(page){
        this.loading = true
        if (typeof page === 'undefined') page = 1;
        
        let url = '?api=true&page='+ page

        if(this.search != undefined && this.search.length) url += '&search='+this.search

        axios.get(url).then(res=>{
            if(res.status == 200){
            this.transactions = res.data.transactions
            this.permissions = res.data.permissions
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
            this.getTransactions()
        }
        }).catch(e=>{
            if(e.response.status == 300)
            {
                $('#modal-delete').modal('hide'); 
                window.utilities.notify('error',"for security reasons you can't update data in demo version")
            }})
     }
     },
     mounted: function(){
        this.getTransactions()
     }
 });
 
