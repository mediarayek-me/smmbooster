

 const baseUrl = 'languages/'
 import language from '../components/LanguageComponent.vue'

 const app = new Vue({
     el: '#app',
     data:{
     postdata : {},
     errors : {},
     modal_target :'#edit-language-modal',
     delete_item : 0,
     languages : {},
     search : '',
     loading : true,
     keys : [],
     },
     components:{
         'language-item':language,
     },
     methods:{
     loadModal : function(id = null){
         if(!id){
         this.initForm()
         $(this.modal_target).modal('show');
         }
         else{
             axios.get(baseUrl+'show/'+id).then(res=>{
                if(res.status == 200){
                this.postdata = res.data
                let is_default = res.data.is_default == 'yes'
                let status = res.data.status == 'active'
                this.$set(this.postdata,'is_default',is_default)
                this.$set(this.postdata,'status',status)
                $(this.modal_target).modal('show');
               }
            })
         }
    },
    closeModal: function(){
         $(this.modal_target).modal('hide');
     },
    storeLanguage: function(id = null){
         this.valideForm(id)
         //console.log(this.errors);
         if(Object.keys(this.errors).length  == 0)
         {
             // store new language
               this.$refs.form.submit()
         
            
         }
     },
     storeValues : function()
     {
        this.$refs.form.submit()
     },
    getLanguages:function(page){
        this.loading = true
        if (typeof page === 'undefined') page = 1;
        
        let url = '?api=true&page='+ page

        if(this.search != undefined && this.search.length) url += '&search='+this.search

        axios.get(url).then(res=>{
            if(res.status == 200){
            this.languages = res.data
            this.loading = false
            }
        })
     },
    loadModalDelete : function(id){
         this.delete_item = id
         $('#modal-delete').modal('show')
        },
    loadPageView : function(id){
       window.location.href += '/'+id
    },
     deleteItem : function(){
     axios.delete(window.location.href+'/'+this.delete_item).then(res=>{
        if(res.status == 200){
            $('#modal-delete').modal('hide')
            window.utilities.notify('success','item deleted successfully')
            this.getLanguages()
        }
        }).catch(e=>{
            if(e.response.status == 300)
            {
                $('#modal-delete').modal('hide'); 
                window.utilities.notify('error',"for security reasons you can't update data in demo version")
            }})
     },
     valideForm : function(id = null){
         this.errors = {}

        if(!this.postdata.name.length)
            this.$set(this.errors,'name',{required : true})
        else if(this.postdata.name.length > 100){
            this.$set(this.errors,'name',{over_length : true})
        }
        if(!this.postdata.code.length)
        this.$set(this.errors,'code',{required : true})
         else if(this.postdata.code.length > 100){
        this.$set(this.errors,'code',{over_length : true})
       }
        if(this.postdata.sort == null )
        this.$set(this.errors,'sort',{required : true}) 
        if(!this.postdata.direction)
        this.$set(this.errors,'direction',{required : true})

        if(!id)
        {
            if(!this.postdata.image)
            this.$set(this.errors,'image',{required : true})

        }
       

     },
     initForm : function(){
        this.$set(this.postdata,'status','active')
        this.$set(this.postdata,'name','')
        this.$set(this.postdata,'code','')
        this.$set(this.postdata,'sort',0)
        this.$set(this.postdata,'direction','rtl')
        this.$set(this.postdata,'is_default',false)
        this.$set(this.postdata,'status',true)
        this.$set(this.postdata,'image','')
        if(this.$refs.label)
        this.$refs.label.innerHTML = ''
     },
     selectImage : function()
     {
        this.$refs.image.click()
     },
     setImage : function($event){
          this.$set(this.postdata,'image',$event.target.files[0] )
          this.$refs.label.innerHTML = $event.target.files[0].name
     }
     },
     mounted: function(){
        this.initForm()
        this.getLanguages()
     }
 });
 
