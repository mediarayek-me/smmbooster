<template>
<tr>
    <th class="text-center" scope="row">{{admin.id}}</th>
                   
    <td class="d-none d-sm-table-cell">
                    {{admin.username}}
                   </td>
                    <td class="d-none d-sm-table-cell">
                    {{admin.firstname+ ' ' +admin.lastname}} 
                   </td>
                    <td class="d-none d-sm-table-cell">
                    {{admin.email}} 
                   </td>
                   <td class="d-none d-sm-table-cell">
                    {{admin.created_at}}
                   </td>
                     <td class="d-none d-sm-table-cell">
                        <span class="badge badge-pill" :class="{ 'badge-success' :  admin.status == 'active','badge-danger' : admin.status == 'deactive' }" >{{this.$getLang(admin.status)}}</span>
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
    props:['admin','editFun','deleteFun'],

    methods:{
        editItem:function(){
        this.editFun(this.admin.id)
        },
        deleteItem:function(){
        this.deleteFun(this.admin.id)
        },
    }
    }
</script>
