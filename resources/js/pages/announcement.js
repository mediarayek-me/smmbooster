

 const baseUrl = 'announcements/'
 import announcement from '../components/AnnouncementComponent.vue';
 import CKEditor from '@ckeditor/ckeditor5-vue2';
 import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
 window.CKEDITOR_VERSION = '29.1.1'
 const app = new Vue({
     el: '#app',
     data:{
     postdata : {},
     errors : {},
     modal_target :'#edit-announcement-modal',
     delete_item : 0,
     announcements : {},
     search : '',
     loading : true,
     editor: ClassicEditor,

     },
     components:{
         'announcement-item':announcement,
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
    storeAnnouncement: function(id = null){
         this.valideForm()
         if(Object.keys(this.errors).length  == 0)
         {
             // store new announcement
            if(!id){
                axios.post(baseUrl,this.postdata).then(res=>{
                    if(res.status == 200){
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('success','New announcement added successfully')
                    this.getAnnouncements()
                }
                }).catch(e=>{
                    if(e.response.status == 300)
                    {
                        $(this.modal_target).modal('hide'); 
                        window.utilities.notify('error',"for security reasons you can't update data in demo version")
                    }})
            }else{
            // edit announcement
            axios.put(window.location.href+'/'+id,this.postdata).then(res=>{
                if(res.status == 200){
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('success','announcement updated successfully')
                    this.getAnnouncements()
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
    getAnnouncements:function(page){
        this.loading = true
        if (typeof page === 'undefined') page = 1;
        
        let url = '?api=true&page='+ page

        if(this.search != undefined && this.search.length) url += '&search='+this.search

        axios.get(url).then(res=>{
            if(res.status == 200){
            this.announcements = res.data
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
            this.getAnnouncements()
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
         if(!this.postdata.description)
         this.$set(this.errors,'description',{required : true})
         if(!this.postdata.start)
         this.$set(this.errors,'start',{required : true})
         if(!this.postdata.end)
         this.$set(this.errors,'end',{required : true})

     },
     initForm : function(){
        this.$set(this.postdata,'status','active')
        this.$set(this.postdata,'type','new service')
        this.$set(this.postdata,'description','')
     }
     },
     mounted: function(){
        this.initForm()
        this.getAnnouncements()
     }
 });
 
