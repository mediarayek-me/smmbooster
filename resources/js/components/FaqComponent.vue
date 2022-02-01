<template>
    <tr>
    
    <td class="font-w600">
        <a class="font-w700" href="#">{{faq.id}}</a>
    </td>
    <td class="d-none d-sm-table-cell">
        {{faq.question}}
    </td>
     <td class="d-none d-sm-table-cell" v-html="faq.answer"> </td>
    <td class="d-none d-sm-table-cell">
    {{faq.sort}}
    </td>
    <td class="d-none d-sm-table-cell">
        <span class="badge badge-pill" :class="{ 'badge-success' :  faq.status == 'active','badge-danger' : faq.status == 'deactive' }" >{{this.$getLang(faq.status)}}</span>
    </td>
    <td class="text-center">
        <div class="btn-group">
             <button v-on:click="editItem()" type="button" class="btn btn-sm btn-primary"  :title="this.$getLang('edit')"  data-toggle="tooltip" data-placement="bottom" >
                <i class="fa fa-pencil-alt"></i>
            </button> 
        </div>
        <div class="btn-group">
        <button v-on:click="deleteItem()" type="button" class="btn btn-sm btn-danger"  :title="this.$getLang('delete')"  data-toggle="tooltip" data-placement="bottom" >
            <i class="fa fa-trash"></i>
        </button>
        </div>
    </td>
</tr>
</template>

    <script>
    export default {
    mounted() {
    console.log('Component mounted.')
    },
    props:['faq','editFun','deleteFun'],
    methods:{
        editItem:function(){
          this.editFun(this.faq.id)
        },
        deleteItem:function(){
            this.deleteFun(this.faq.id)
        }
    }
    }
    </script>
