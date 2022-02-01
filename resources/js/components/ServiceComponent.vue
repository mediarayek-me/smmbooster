<template>
    <tr>
    
    <td class="font-w600">
        <a class="font-w700" href="#">{{service.id}}</a>
    </td>
    <td class="d-none d-sm-table-cell">
        {{service.name}}
    </td>
     <td class="d-none d-sm-table-cell">
        {{service.category.name}}
    </td>
    <td class="d-none d-sm-table-cell">
     <div class="text-center">
          <div>  {{service.rate}}</div>
   <div> <small>{{service.rate_original}}</small></div>
     </div>
    </td>
    <td class="d-none d-sm-table-cell">
    {{service.min}}/ {{service.max}}
    </td>
    <td class="d-none d-sm-table-cell">
        <span class="badge badge-pill" :class="{ 'badge-success' :  service.status == 'active','badge-danger' : service.status == 'deactive' }" >{{this.$getLang(service.status)}}</span>
    </td>
    <td class="text-center">
        <div v-if="permissions.edit" class="btn-group">
             <button v-on:click="editItem()" type="button" class="btn btn-sm btn-primary"  :title="this.$getLang('edit')"  data-toggle="tooltip" data-placement="bottom" >
                <i class="fa fa-pencil-alt"></i>
            </button> 
        </div>
        <div v-if="permissions.delete" class="btn-group">
        <button v-on:click="deleteItem()" type="button" class="btn btn-sm btn-danger"  :title="this.$getLang('delete')"  data-toggle="tooltip" data-placement="bottom" >
            <i class="fa fa-trash"></i>
        </button>
        </div>
         <div v-if="permissions.view" class="btn-group">
        <button v-on:click="viewItem()" type="button" class="btn btn-sm btn-info" >
            <i class="fa fa-eye"></i>
        </button>
        </div>
    </td>
</tr>
</template>

    <script>
    export default {
    mounted() {
    },
    props:['service','editFun','deleteFun','viewFun','permissions'],
    methods:{
        editItem:function(){
          this.editFun(this.service.id)
        },
        deleteItem:function(){
            this.deleteFun(this.service.id)
        },
        viewItem:function(){
            this.viewFun(this.service.id)
        }
    }
    }
    </script>
