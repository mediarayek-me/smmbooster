

 const baseUrl = 'services/'
 import service from '../components/ServiceComponent.vue'
 const app = new Vue({
     el: '#app',
     data:{
     is_api_provider : false,
     postdata : {},
     errors : {},
     modal_target :'#edit-service-modal',
     delete_item : 0,
     services : {},
     search : '',
     selected_api_provider : '',
     loading : true,
     permissions: [],
     min:0,
     max:0,
     rate:0,
     percentage_increase:0
     },
     components:{
         'service-item':service
     },
     methods:{
     loadModal : function(id = null){
         this.initForm()
         if(!id){
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
    storeService: function(id = null){
         this.valideForm()
         if(Object.keys(this.errors).length  == 0)
         {
             // store new service
            if(!id){
                axios.post(baseUrl,this.postdata).then(res=>{
                    if(res.status == 200){
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('success','New service added successfully')
                    this.getServices()
                }
                }).catch(e=>{
                    if(e.response.status == 300)
                    {
                        $(this.modal_target).modal('hide'); 
                        window.utilities.notify('error',"for security reasons you can't update data in demo version")
                    }})
            }else{
            // edit service
            axios.put(window.location.href+'/'+id,this.postdata).then(res=>{
                if(res.status == 200){
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('success','service updated successfully')
                    this.getServices()
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
    getServices:function(page){
        this.loading = true
        let urlParams = new URLSearchParams(window.location.search);
        let api_provider =  ''
        if(urlParams.has('api_provider'))
        {
            api_provider = '&api_provider='+urlParams.get('api_provider')
        } else
        if(this.selected_api_provider)
        {
            api_provider = '&api_provider='+this.selected_api_provider
        } 
        
        if (typeof page === 'undefined') page = 1;
        
        let url = '?api=true&page='+ page + api_provider

        if(this.search != undefined && this.search.length) url += '&search='+this.search

        axios.get(url).then(res=>{
            if(res.status == 200){
            this.services = res.data.services
            this.permissions = res.data.permissions
            this.loading = false
            //console.log(this.services)
            }
        }).catch(e=>{
            //console.log(e)
        })
     },
    loadModalDelete : function(id){
         this.delete_item = id
         $('#modal-delete').modal('show')
    },
    loadModalView : function(id){
        dashboard('// to do ')
        // $('#modal-delete').modal('show')
    },
     deleteItem : function(){
     axios.delete(baseUrl+this.delete_item).then(res=>{
        if(res.status == 200){
            $('#modal-delete').modal('hide')
            window.utilities.notify('success','item deleted successfully')
            this.getServices()
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
        if(!this.postdata.category_id)
             this.$set(this.errors,'category_id','required')

        if(this.postdata.type === 'api' && !this.postdata.api_provider_id)
                this.$set(this.errors,'api_provider_id','required')

        if(this.postdata.type === 'api' && !this.postdata.percentage_increase)
            this.$set(this.errors,'percentage_increase','required')

         if(!this.postdata.min || this.postdata.min < 0)
            this.$set(this.errors,'min','required')

        if(!this.postdata.max)
            this.$set(this.errors,'max','required')
        
        if(!this.postdata.rate || this.postdata.rate < 0)
            this.$set(this.errors,'rate','required')
     },
     initForm : function(){
        this.$set(this.postdata,'type','normal')
        this.$set(this.postdata,'category_id','')
        this.$set(this.postdata,'status','active')
        this.$set(this.postdata,'min',this.min)
        this.$set(this.postdata,'max',this.max)
        this.$set(this.postdata,'rate',this.rate)
        this.$set(this.postdata,'description','')
        this.$set(this.postdata,'name',null)
        this.$set(this.postdata,'api_provider_id',null)
        this.$set(this.postdata,'id',null)
       
        // set default percentage increase
     
        //this.$set(this.postdata,'percentage_increase',this.postdata.apiProvider.percentage_increase)

     },
     getSettings : function(){
        axios.post('/admin/settings/all').then(res=>{
       if(res.data){
           //console.log(res.data);
        this.min = res.data.min_order 
        this.max = res.data.max_order 
        this.rate = res.data.price_per_1000 
        }
        }).catch(e=>{
            if(e.response.status == 300)
            {
                $(this.modal_target).modal('hide'); 
                window.utilities.notify('error',"for security reasons you can't update data in demo version")
            }})
     },
     initApiProvider : function()
     {
        let urlParams = new URLSearchParams(window.location.search);
        this.selected_api_provider =   urlParams.get('api_provider')
     }
     },
     mounted: function(){
        this.initForm()
        this.initApiProvider()
        this.getServices()
        this.getSettings()
     }
 });
