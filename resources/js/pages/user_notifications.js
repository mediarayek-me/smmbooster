

 const baseUrl = 'user-notifications/'
 import user_notification from '../components/UserNotificationComponent.vue'
 import CKEditor from '@ckeditor/ckeditor5-vue2';
 import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
 window.CKEDITOR_VERSION = '29.1.0'

 const app = new Vue({
     el: '#app',
     data:{
     postdata : {},
     errors : {},
     modal_target :'#edit-user_notification-modal',
     delete_item : 0,
     user_notifications : {},
     search : '',
     loading : true,
     editor: ClassicEditor,
     },
     components:{
         'user_notifications-item':user_notification,
         ckeditor: CKEditor.component
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
    loadModalView: function(id)
     {
        window.location.href += '/'+id
       /* axios.get(window.location.href+'/'+id).then(res=>{
            if(res.status == 200)
            {
            this.postdata = res.data
            $('#edit-user_notification-view-modal').modal('show')
            }
        })*/
     },
    storeUserNotification: function(id = null){
         this.valideForm()
         if(Object.keys(this.errors).length  == 0)
         {
             // store new user_notification
            if(!id){
                axios.post(baseUrl,this.postdata).then(res=>{
                    if(res.status == 200){
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('success','new user notification added successfully')
                    this.getUserNotifications()
                }
                }).catch(e=>{
                    if(e.response.status == 300)
                    {
                        $(this.modal_target).modal('hide'); 
                        window.utilities.notify('error',"for security reasons you can't update data in demo version")
                    }})
            }else{
            // edit user_notification
            axios.put(window.location.href+'/'+id,this.postdata).then(res=>{
                if(res.status == 200){
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('success','user notification updated successfully')
                    this.getUserNotifications()
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
    getUserNotifications:function(page){
        this.loading = true
        if (typeof page === 'undefined') page = 1;
        
        let url = '?api=true&page='+ page

        if(this.search != undefined && this.search.length) url += '&search='+this.search

        axios.get(url).then(res=>{
            if(res.status == 200){
            this.user_notifications = res.data
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
            this.getUserNotifications()
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
        if(!this.postdata.subject)
            this.$set(this.errors,'subject',{required : true})
        else if(this.postdata.subject.length > 250){
            this.$set(this.errors,'subject',{over_length : true})
        }
        if(!this.postdata.content)
            this.$set(this.errors,'content',{required : true})
        else if(this.postdata.content.length > 500){
                this.$set(this.errors,'content',{over_length : true})
        }
        if(!this.postdata.user_id)
            this.$set(this.errors,'user_id',{required : true})

     },
     initForm : function(){
        this.$set(this.postdata,'subject','')
        this.$set(this.postdata,'content','')
        this.$set(this.postdata,'user_id','')
     }
     },
     mounted: function(){
        this.initForm()
        this.getUserNotifications()
     }
 });
 
