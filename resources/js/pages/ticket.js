

 const baseUrl = 'tickets/'
 import ticket from '../components/TicketComponent.vue'
 const app = new Vue({
     el: '#app',
     data:{
     postdata : {},
     errors : {},
     modal_target :'#edit-ticket-modal',
     delete_item : 0,
     tickets : {},
     search : '',
     status: 'pending',
     loading : true,
     },
     components:{
         'ticket-item':ticket,
     },
     methods:{
    viewTicket : function(id = null){
        window.location.href += '/'+id
    },
    closeModal: function(){
         $(this.modal_target).modal('hide');
     },
    storeTicket: function(id = null){
         this.valideForm()
         if(Object.keys(this.errors).length  == 0)
         {
             // store new ticket
                this.$refs.from_ticket.submit()
        }
     },
     updateStatus : function(id)
     {
        this.$refs.ticket_status.submit()
     },
     getAttachment($event)
     {
         //console.log($event.target.files)
        this.postdata['attachment'] = $event.target.files[0]
        $('.select-file').after('<label>'+$event.target.files[0].name+'</label>')
     },
    getTickets:function(page){
        this.loading = true
        if (typeof page === 'undefined') page = 1;
        
        let url = '?api=true&page='+ page

        if(this.search != undefined && this.search.length) url += '&search='+this.search

        axios.get(url).then(res=>{
            if(res.status == 200){
            this.tickets = res.data
            this.loading = false
            }
        })
     },
    loadModalDelete : function(id){
         this.delete_item = id
         $('#modal-delete').modal('show')
        },
    loadModal :function(){
         $(this.modal_target).modal('show')
     },
     deleteItem : function(){
     axios.delete(window.location.href+'/'+this.delete_item).then(res=>{
        if(res.status == 200){
            $('#modal-delete').modal('hide')
            window.utilities.notify('success','item deleted successfully')
            this.getTickets()
        }
        }).catch(e=>{
            if(e.response.status == 300)
            {
                $('#modal-delete').modal('hide'); 
                window.utilities.notify('error',"for security reasons you can't update data in demo version")
            }})
     },
     valideForm : function(){
         //console.log(this.errors)
         this.errors = {}
        if(!this.postdata.name)
            this.$set(this.errors,'name',{required : true})
        else if(this.postdata.name.length > 100){
            this.$set(this.errors,'name',{over_length : true})
        }
        if(!this.postdata.email)
        this.$set(this.errors,'email',{required : true})
        else if(this.postdata.email.length > 100){
        this.$set(this.errors,'email',{over_length : true})
       }
       if(!this.postdata.subject)
       this.$set(this.errors,'subject',{required : true})
       else if(this.postdata.subject.length > 100){
       this.$set(this.errors,'subject',{over_length : true})
      }
      var message =this.editor.getData()
      if(!message)
      this.$set(this.errors,'message',{required : true})
      else if(message.length > 600)
      this.$set(this.errors,'message',{over_length : true})
     
     if(!this.postdata.type)
     this.$set(this.errors,'type',{required : true})

     },
     initForm : function(){
        this.$set(this.postdata,'name','')
        this.$set(this.postdata,'type','')
        this.$set(this.postdata,'email','')
        this.$set(this.postdata,'subject','')
        this.$set(this.postdata,'message','')
     },
     initEditor: function()
     {
        ClassicEditor
        .create(document.querySelector('#message')).then(editor=>{
            this.editor = editor
        })
        .catch(error => {
            console.error(error);
        });
     }
     },
     mounted: function(){
        this.initForm()
        this.getTickets()
        this.initEditor()
     }
 });
 
