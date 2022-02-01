<template>
    <tr>
    
    <td class="font-w600">
        <a class="font-w700" href="#">{{user_notification.id}}</a>
    </td>
    <td class="d-none d-sm-table-cell">
        {{user_notification.subject}}
    </td>
     <td class="d-none d-sm-table-cell" v-html="user_notification.content"> </td>
    <td class="text-center">
        <div class="btn-group">
        <button v-on:click="deleteItem()" type="button" class="btn btn-sm btn-danger"  :title="this.$getLang('delete')"  data-toggle="tooltip" data-placement="bottom" >
            <i class="fa fa-trash"></i>
        </button>
        </div>
         <div class="btn-group">
        <button v-on:click="viewItem()" type="button" class="btn btn-sm btn-info"  title="View"  data-toggle="tooltip" data-placement="bottom" >
            <i class="fa fa-eye"></i>
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
    props:['user_notification','deleteFun','viewFun'],
    methods:{
        deleteItem:function(){
            this.deleteFun(this.user_notification.id)
        },
         viewItem:function(){
            this.viewFun(this.user_notification.id)
        }
    }
    }
    </script>
