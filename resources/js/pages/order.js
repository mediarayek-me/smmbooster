

import Order from  '../components/OrderComponent'
const baseUrl = 'orders/'
const app  =  new Vue({
    el:"#app",
    data : {
    modal_target : '#add-order-modal',
    postdata : {},
    errors : {},
    search : '',
    services : [],
    category_id : '',
    confirmation : '',
    total_price : '',
    selected_service : null,
    delete_item : null,
    loading : false,
    permissions : [],
    orders: {},
    processing:false
    },
    methods: {
    initForm : function(){
        this.$set(this.postdata,'service_id','')
        this.$set(this.postdata,'link','')
        this.$set(this.postdata,'quantity','')
        this.$set(this.postdata,'notes','')
        this.confirmation = ''
        this.category_id = ''
    },
    storeOrder : function(id = null){
     this.valideForm()
     //console.log(this.postdata);
     if(Object.keys(this.errors).length  == 0){
         // store new order
         if(!id){
            this.processing = true
            axios.post(baseUrl,this.postdata).then(res=>{
                if(res.status == 200){
                $(this.modal_target).modal('hide')
                window.utilities.notify('success','New order added successfully')
                this.getOrders()
                this.processing = false
            }
            }).catch(e=>{
                if(e.response.status == 300)
                {
                    $(this.modal_target).modal('hide'); 
                    window.utilities.notify('error',"for security reasons you can't update data in demo version")
                }
                if(e.response.status == 401)
                {
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('error','You don\'t have enough balance')  
                }
            })
        }
     }

    },
    updateOrder: function(id)
    {
        // edit ordeer
        axios.put(window.location.href+'/'+id,this.postdata).then(res=>{
        if(res.status == 200){
            $('#edit-order-modal').modal('hide');
            window.utilities.notify('success','order updated successfully')
            this.getOrders()
        }
    }).catch(e=>{
        if(e.response.status == 300)
        {
            $(this.modal_target).modal('hide'); 
            window.utilities.notify('error',"for security reasons you can't update data in demo version")
        }
    })
    },
    getServices:function(){
        this.services = []
       if(this.category_id){
            axios.get(baseUrl+'services/'+this.category_id).then(res=>{
                if(res.status == 200){
                this.services = res.data
                }
            })
       }
     },
    setService : function(){
    this.selected_service = null;
    if(this.postdata.service_id)
     this.selected_service = this.services.filter(e=>e.id == this.postdata.service_id)[0]
     this.selected_service['price'] = '-';
    },
    getTotalPrice : function()
    {
       if(this.selected_service)
       this.total_price = parseFloat(this.selected_service.rate * this.postdata.quantity / 1000).toFixed(4)
    },
    getOrders:function(page){
        this.loading = true
        if (typeof page === 'undefined') page = 1;
        
        let url = '?api=true&page='+ page

        if(this.search != undefined && this.search.length) url += '&search='+this.search

        axios.get(url).then(res=>{
            if(res.status == 200){
            this.orders = res.data.orders
            this.permissions = res.data.permissions
            this.loading = false
            }
        })
     },
    valideForm : function(){
        this.errors = {}      
        if(!this.category_id)
            this.$set(this.errors,'category_id','required')
        if(!this.postdata.service_id)
            this.$set(this.errors,'service_id','required')
        
        // validate link
        if(!this.postdata.link){
         this.$set(this.errors,'link',{'required' : true})
        }else{
        try {
         new URL(this.postdata.link)
        } catch (error) {
         this.$set(this.errors,'link',{'link_not_valid' : true})       
        }
        }
        // validate quantity
        if(!this.postdata.quantity)
            this.$set(this.errors,'quantity',{'required' : true})
        else if(parseFloat(this.postdata.quantity) > parseFloat(this.selected_service.max)){
            this.$set(this.errors,'quantity',{'maximum' : true})
        }else if(parseFloat(this.postdata.quantity) < parseFloat(this.selected_service.min)){
            this.$set(this.errors,'quantity',{'minimum' : true})
        }
        //console.log(this.errors);
        if(!this.confirmation)
            this.$set(this.errors,'confirmation','required')
    },
    loadModal : function(id = null){
            this.initForm()
            $(this.modal_target).modal('show');
     },
        loadModalEdit : function(id){
        axios.get(window.location.href+'/'+id).then(res=>{
            if(res.status == 200){
            this.postdata = res.data
            //console.log(this.postdata);
            this.postdata['type']  = res.data.service.type
            this.postdata['user']  = res.data.user.email
            this.postdata['type']  = res.data.service.type
            this.postdata['type']  = res.data.service.type
            this.postdata['service_name']  = res.data.service.name
            $('#edit-order-modal').modal('show');
           }
        })
     },
     loadModalView : function(){
         alert('// to do')
        //$('#edit-order-modal').modal('show');
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
               this.getOrders()
           }
           }).catch(e=>{
            if(e.response.status == 300)
            {
                $('#modal-delete').modal('hide'); 
                window.utilities.notify('error',"for security reasons you can't update data in demo version")
            }})
        },
    },
    components:{
        'order-item':Order
    },
    mounted : function() {
        this.getServices()
        this.getOrders()
    },
})