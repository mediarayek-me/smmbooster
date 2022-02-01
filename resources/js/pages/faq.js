

 const baseUrl = 'faqs/'
 import faq from '../components/FaqComponent.vue'
 import CKEditor from '@ckeditor/ckeditor5-vue2';
 import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
 window.CKEDITOR_VERSION = '29.1.0'

 const app = new Vue({
     el: '#app',
     data:{
     postdata : {},
     errors : {},
     modal_target :'#edit-faq-modal',
     delete_item : 0,
     faqs : {},
     search : '',
     loading : true,
     editor: ClassicEditor,
     },
     components:{
         'faq-item':faq,
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
    storeFaq: function(id = null){
         this.valideForm()
         if(Object.keys(this.errors).length  == 0)
         {
             // store new faq
            if(!id){
                axios.post(baseUrl,this.postdata).then(res=>{
                    if(res.status == 200){
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('success','New faq added successfully')
                    this.getFaqs()
                }
                }).catch(e=>{
                    if(e.response.status == 300)
                    {
                        $(this.modal_target).modal('hide'); 
                        window.utilities.notify('error',"for security reasons you can't update data in demo version")
                    }})
            }else{
            // edit faq
            axios.put(window.location.href+'/'+id,this.postdata).then(res=>{
                if(res.status == 200){
                    $(this.modal_target).modal('hide')
                    window.utilities.notify('success','faq updated successfully')
                    this.getFaqs()
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
    getFaqs:function(page){
        this.loading = true
        if (typeof page === 'undefined') page = 1;
        
        let url = '?api=true&page='+ page

        if(this.search != undefined && this.search.length) url += '&search='+this.search

        axios.get(url).then(res=>{
            if(res.status == 200){
            this.faqs = res.data
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
            this.getFaqs()
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
        if(!this.postdata.question)
            this.$set(this.errors,'question',{required : true})
        else if(this.postdata.question.length > 250){
            this.$set(this.errors,'question',{over_length : true})
        }
        if(!this.postdata.answer)
            this.$set(this.errors,'answer',{required : true})
        else if(this.postdata.answer.length > 800){
                this.$set(this.errors,'answer',{over_length : true})
            }

     },
     initForm : function(){
        this.$set(this.postdata,'status','active')
        this.$set(this.postdata,'question','')
        this.$set(this.postdata,'answer','')
     }
     },
     mounted: function(){
        this.initForm()
        this.getFaqs()
     }
 });
 
