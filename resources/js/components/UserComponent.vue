<template>
<tr>
    <th class="text-center" scope="row">{{user.id}}</th>
                   
    <td class="d-none d-sm-table-cell">
                    {{user.firstname}} {{user.lastname}} <br>
                    {{user.email}}
                   </td>
                    <td class="d-none d-sm-table-cell">
                    {{user.funds | toCurrency}} 
                   </td>
                   <td class="d-none d-sm-table-cell">
                    <p>{{user.notes}}</p>
                   </td>
                   <td class="d-none d-sm-table-cell">
                    {{user.created_at}}
                   </td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-pill" :class="{ 'badge-success' :  user.status == 'active','badge-danger' : user.status == 'deactive' }" >{{this.$getLang(user.status)}}</span>
                    </td>
                   <td class="text-center">
                    <div class="btn-group">
                    <button v-on:click="editItem()" type="button" class="btn btn-sm btn-primary" >
                    <i class="fa fa-pencil-alt"></i>
                    </button> 
                    </div>
                    <!-- <div class="btn-group">
                    <button v-on:click="viewItem()" type="button" class="btn btn-sm btn-info"  :title="this.$getLang('edit')"  data-toggle="tooltip" data-placement="bottom">
                        <i class="fa fa-eye"></i>
                    </button>
                    </div> -->
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
    props:['user','editFun','deleteFun','viewFun'],

    methods:{
        editItem:function(){
        this.editFun(this.user.id)
        },
        deleteItem:function(){
        this.deleteFun(this.user.id)
        },
        viewItem:function(){
        this.viewFun(this.user.id)
        }
    }
    }
</script>
