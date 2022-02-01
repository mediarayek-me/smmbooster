<template>
    <tr>  
    <td class="font-w600">
        <a class="font-w700" href="#">{{announcement.id}}</a>
    </td>
     <td class="d-none d-sm-table-cell" v-html="announcement.description"> </td>
    <td class="d-none d-sm-table-cell">
        {{announcement.type}}
    </td>
    <td class="d-none d-sm-table-cell">
    {{announcement.start}}
    </td>
    <td class="d-none d-sm-table-cell">
    {{announcement.end}}
    </td>
    <td class="d-none d-sm-table-cell">
        <span class="badge badge-pill" :class="{ 'badge-success' :  announcement.status == 'active','badge-danger' : announcement.status == 'deactive' }" >{{this.$getLang(announcement.status)}}</span>
    </td>
    <td class="text-center">
        <div class="btn-group">
             <button v-on:click="editItem()" type="button" class="btn btn-sm btn-primary"  :title="this.$getLang('edit')"  data-toggle="tooltip" data-placement="bottom">
                <i class="fa fa-pencil-alt"></i>
            </button> 
        </div>
        <div class="btn-group">
        <button v-on:click="deleteItem()" type="button" class="btn btn-sm btn-danger" :title="this.$getLang('delete')"  data-toggle="tooltip" data-placement="bottom" >
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
    props:['announcement','editFun','deleteFun'],
    methods:{
        editItem:function(){
          this.editFun(this.announcement.id)
        },
        deleteItem:function(){
            this.deleteFun(this.announcement.id)
        }
    }
    }
    </script>
