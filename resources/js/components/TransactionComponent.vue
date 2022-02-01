<template>
    <tr>
    <td class="d-none d-sm-table-cell" style="font-size:14px">
        {{transaction.transaction_id}}
    </td>
    <td v-if="permissions.is_admin" class="d-none d-sm-table-cell" style="font-size:13px">
    <strong>{{transaction.user.firstname +' '+ transaction.user.lastname}}</strong><br>
    {{transaction.user.email}} 

    </td>
     <td class="d-none d-sm-table-cell">
    {{transaction.payment_method.name}}
    </td>
    <td  class="d-none d-sm-table-cell">
    {{transaction.amount  | toCurrency}}
    </td>
     <td v-if="!permissions.is_admin" class="d-none d-sm-table-cell">
       {{transaction.take_fee  | toCurrency}}
    </td>
    <td v-if="permissions.is_admin" class="d-none d-sm-table-cell">
    {{transaction.fee | toCurrency}}
    </td>
     <td v-if="permissions.is_admin"  class="d-none d-sm-table-cell">
    {{transaction.profit | toCurrency}}
    </td>
    <td class="d-none d-sm-table-cell">
    {{transaction.created_at}}
    </td>
    <td class="d-none d-sm-table-cell">
        <span class="badge badge-pill" :class="{ 'badge-success' :  transaction.status == 'paid','badge-danger' : transaction.status == 'refund' }" >{{transaction.status}}</span>
    </td>
    <td  v-if="permissions.is_admin"  class="text-center">
        <div class="btn-group">
             <button v-on:click="editItem()" type="button" class="btn btn-sm btn-primary"  :title="this.$getLang('edit')"  data-toggle="tooltip" data-placement="bottom">
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
    props:['transaction','permissions','editFun','deleteFun'],
    methods:{
        editItem:function(){
          this.editFun(this.transaction.id)
        },
        deleteItem:function(){
            this.deleteFun(this.transaction.id)
        }
    }
    }
    </script>
