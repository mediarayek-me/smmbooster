

 const baseUrl = 'api-providers/'
 import api_provider from '../components/ApiProviderComponent.vue'
 const app = new Vue({
     el: '#app',
     data:{
     postdata : {},
     errors : {},
     modal_target :'#edit-api_provider-modal',
     delete_item : 0,
     api_providers : {},
     search : '',
     loading : true,
     processing : false,
     },
     components:{
         'api_provider-item':api_provider
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
    storeApiProvider: function(id = null){
         this.valideForm()
         if(Object.keys(this.errors).length  == 0)
         {
             this.processing = true
             // store new api_provider
            if(!id){
                axios.post(baseUrl,this.postdata).then(res=>{
                    if(res.status == 200){
                    $(this.modal_target).modal('hide')
                    this.processing = false
                    window.utilities.notify('success','New API provider added successfully')
                    this.getApiProviders()
                }
                }).catch(e=>{
                    if(e.response.status == 300)
                    {
                        $(this.modal_target).modal('hide'); 
                        window.utilities.notify('error',"for security reasons you can't update data in demo version")
                    }})
            }else{
            // edit api_provider
            axios.put(window.location.href+'/'+id,this.postdata).then(res=>{
                if(res.status == 200){
                    $(this.modal_target).modal('hide')
                    this.processing = false
                    window.utilities.notify('success','api provider updated successfully')
                    this.getApiProviders()
                }
            }).catch(e =>{
                if(e.response.status == 300)
                {
                $(this.modal_target).modal('hide'); 
                window.utilities.notify('error',"for security reasons you can't update data in demo version")
            }})
            }
         }
     },
    getApiProviders:function(page){
        this.loading = true
        if (typeof page === 'undefined') page = 1;
        
        let url = '?api=true&page='+ page

        if(this.search != undefined && this.search.length) url += '&search='+this.search

        axios.get(url).then(res=>{
            if(res.status == 200){
            this.api_providers = res.data
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
            this.getApiProviders()
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
        if(!this.postdata.api_key)
        this.$set(this.errors,'api_key',{required : true})

        if(!this.postdata.percentage_increase)
        this.$set(this.errors,'percentage_increase',{required : true})

        if(!this.postdata.url){
            this.$set(this.errors,'url',{'required' : true})
           }else{
           try {
            new URL(this.postdata.url)
           } catch (error) {
            this.$set(this.errors,'url',{'url_not_valid' : true})       
           }
           }

     },
     initForm : function(){
        this.$set(this.postdata,'status','active')
        this.$set(this.postdata,'notes','')
        this.$set(this.postdata,'url','')
        this.$set(this.postdata,'name','')
        this.$set(this.postdata,'api_key','')
        this.$set(this.postdata,'percentage_increase','50')
     }
     },
     mounted: function(){
        this.initForm()
        this.getApiProviders()
     }
 });
 
