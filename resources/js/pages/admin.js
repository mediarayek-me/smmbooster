

 const baseUrl = 'admins/'
 import admin from '../components/AdminComponent.vue'
 const app = new Vue({
     el: '#app',
     data:{
     postdata : {},
     errors : {},
     modal_target :'#edit-admin-modal',
     delete_item : 0,
     admins : {},
     search : '',
     confirm_password : null,
     loading : true,
     id:0
     },
     components:{
         'admin-item':admin
     },
     methods:{
     loadModal : function(id = null){
         this.id = id
         this.initForm(id)
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
    storeAdmin: function(id = null){
         this.valideForm(id)
         //console.log(this.errors);
         if(Object.keys(this.errors).length  == 0)
         {
             // store new admin
            if(!id){
                axios.post(baseUrl,this.postdata).then(res=>{
                    if(res.status == 201){
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('success','New admin added successfully')
                    this.getAdmins()
                   }else if(res.status == 200){
                    if(res.data.email)
                    this.$set(this.errors,'email',{taken : res.data.email})
                    if(res.data.username)
                    this.$set(this.errors,'username',{taken : res.data.username})
                   }
                }).catch(e=>{
                    if(e.response.status == 300)
                    {
                        $(this.modal_target).modal('hide'); 
                        window.utilities.notify('error',"for security reasons you can't update data in demo version")
                    }})
            }else{
            // edit admin
            axios.put(window.location.href+'/'+id,this.postdata).then(res=>{
                
                if(res.status == 201){
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('success','admin updated successfully')
                    this.getAdmins()
                }else if(res.status == 200){
                    if(res.data.email)
                    this.$set(this.errors,'email',{taken : res.data.email})
                    if(res.data.username)
                    this.$set(this.errors,'username',{taken : res.data.username})
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
    getAdmins:function(page){
        this.loading = true
        if (typeof page === 'undefined') page = 1;
        
        let url = '?api=true&page='+ page

        if(this.search != undefined && this.search.length) url += '&search='+this.search

        axios.get(url).then(res=>{
            if(res.status == 200){
            this.admins = res.data
            //console.log(this.admins);
            this.loading = false
            }
        })
     },
    loadModalDelete : function(id){
         this.delete_item = id
         $('#modal-delete').modal('show')
    },
    loadModalView: function(id){
        
    },
    deleteItem : function(){
     axios.delete(window.location.href+'/'+this.delete_item).then(res=>{
        if(res.status == 200){
            $('#modal-delete').modal('hide')
            window.utilities.notify('success','item deleted successfully')
            this.getAdmins()
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
         
        if(!this.postdata.username)
            this.$set(this.errors,'username',{required : true})
        if(!this.postdata.email)
            this.$set(this.errors,'email',{required : true})
        if(!this.postdata.firstname)
            this.$set(this.errors,'firstname',{required : true})
        if(!this.postdata.username)
            this.$set(this.errors,'username',{required : true})
        if(!this.postdata.lastname)
            this.$set(this.errors,'lastname',{required : true})
        if(this.postdata.password && this.postdata.password.length >= 8){
            if(!this.confirm_password)
            this.$set(this.errors,'confirm_password',{required : true})
            if(this.confirm_password !=  this.postdata.password)
            this.$set(this.errors,'confirm_password',{notmatch : true})
        }
        if(this.postdata.password &&  this.postdata.password.length < 8)
        this.$set(this.errors,'password',{minimum : true})
        
        if(!id){
        if(!this.postdata.password)
            this.$set(this.errors,'password',{required : true}) 
        }
     },
     initForm : function(id){
        if(!id){
        this.$set(this.postdata,'status','active')
        this.$set(this.postdata,'firstname','')
        this.$set(this.postdata,'lastname','')
        this.$set(this.postdata,'email','')
        this.$set(this.postdata,'password','')
        this.confirm_password = ''
    }else{
        this.$set(this.postdata,'password','')
        this.confirm_password = ''
        }
        // this.$set(this.postdata,'funds','')

     }
     },
     mounted: function(){
        this.initForm()
        this.getAdmins()
     }
 });
 
