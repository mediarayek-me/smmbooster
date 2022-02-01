

 const baseUrl = 'users/'
 import user from '../components/UserComponent.vue'
 const app = new Vue({
     el: '#app',
     data:{
     postdata : {},
     errors : {},
     modal_target :'#edit-user-modal',
     delete_item : 0,
     users : {},
     search : '',
     password : '',
     avatar : '',
     password_new : '',
     password_new_confirm : '',
     confirm_password : null,
     loading : true,
     id:0
     },
     components:{
         'user-item':user
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
    storeUser: function(id = null){
         this.valideForm(id)
         if(Object.keys(this.errors).length  == 0)
         {
             // store new user
            if(!id){
                axios.post(baseUrl,this.postdata).then(res=>{
                    
                    if(res.status == 200){
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('success','New user added successfully')
                    this.getUsers()
                   }else if(res.status == 400){
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
            // edit user
            axios.put(window.location.href+'/'+id,this.postdata).then(res=>{
                
                if(res.status == 201){
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('success','user updated successfully')
                    this.getUsers()
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
    getUsers:function(page){
        this.loading = true
        if (typeof page === 'undefined') page = 1;
        
        let url = '?api=true&page='+ page

        if(this.search != undefined && this.search.length) url += '&search='+this.search

        axios.get(url).then(res=>{
            if(res.status == 200){
            this.users = res.data
            this.loading = false
            }
        })
     },
    loadModalDelete : function(id){
         this.delete_item = id
         $('#modal-delete').modal('show')
    },
    loadModalView: function(id){
        $('#view-user-modal').modal('show');
    },
    deleteItem : function(){
     axios.delete(window.location.href+'/'+this.delete_item).then(res=>{
        if(res.status == 200){
            $('#modal-delete').modal('hide')
            window.utilities.notify('success','item deleted successfully')
            this.getUsers()
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
        this.errors = {}
        if(!id){
        this.$set(this.postdata,'status','active')
        this.$set(this.postdata,'notes','')
        this.$set(this.postdata,'firstname','')
        this.$set(this.postdata,'lastname','')
        this.$set(this.postdata,'username','')
        this.$set(this.postdata,'phone','')
        this.$set(this.postdata,'address','')
        this.$set(this.postdata,'password','')
        this.$set(this.postdata,'confirm_password','')
        }else{
        this.$set(this.postdata,'password','')
        this.$set(this.postdata,'confirm_password','')
        }
        // this.$set(this.postdata,'funds','')

     },
     setAvatar : function(e){
        this.avatar =  e.target.files[0].name
     },
     validateUserPassword: function()
     {
         this.errors = {}
        // if(this.password){
        //     if(!this.password_new)
        //     this.$set(this.errors,'password_new',{required : true})

        //     if(!this.password_new_confirm)
        //     this.$set(this.errors,'password_new_confirm',{required : true})

        //     if(this.password_new_confirm !=  this.password_new)
        //     this.$set(this.errors,'password_new_confirm',{notmatch : true})

        //     if(this.password_new &&  this.password_new.length < 8)
        //     this.$set(this.errors,'password_new',{minimum : true})
        // }
        if(!Object.keys(this.errors).length)
        this.$refs.user_profil.submit();

     }
   
     },
     mounted: function(){
        this.initForm()
        this.getUsers()
     }
 });
 
