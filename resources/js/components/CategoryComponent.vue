<template>
    <tr>
    
    <td class="font-w600">
        <a class="font-w700" href="#">{{category.id}}</a>
    </td>
    <td class="d-none d-sm-table-cell">
        {{category.name}}
    </td>
     <td class="d-none d-sm-table-cell">
    {{category.description}}
    </td>
    <td class="d-none d-sm-table-cell">
    {{category.sort}}
    </td>
    <td class="d-none d-sm-table-cell">
        <span class="badge badge-pill" :class="{ 'badge-success' :  category.status == 'active','badge-danger' : category.status == 'deactive' }" >{{this.$getLang(category.status)}}</span>
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
    props:['category','editFun','deleteFun'],
    methods:{
        editItem:function(){
          this.editFun(this.category.id)
        },
        deleteItem:function(){
            this.deleteFun(this.category.id)
        }
    }
    }
    </script>
