<template>
    <tr>
    <td class="font-w600">
        <a class="font-w700" href="#">{{language.id}}</a>
    </td>
    <td class="d-none d-sm-table-cell">
        {{language.name}}
    </td>
    <td class="d-none d-sm-table-cell">
    {{language.code}}
    </td>
    <td class="d-none d-sm-table-cell">
    <img style="width: 40px;" :src="image" >
    </td>
     <td class="d-none d-sm-table-cell text-uppercase">
    {{language.direction}}
    </td>
     <td class="d-none d-sm-table-cell">
    {{language.sort}}
    </td>
      <td class="d-none d-sm-table-cell">
        <span class="badge badge-pill" :class="{ 'badge-success' :  language.is_default == 'yes','badge-info' : language.is_default == 'no' }" >{{language.is_default }}</span>
    </td>
    <td class="d-none d-sm-table-cell">
        <span class="badge badge-pill" :class="{ 'badge-success' :  language.status == 'active','badge-danger' : language.status == 'deactive' }" >{{this.$getLang(language.status)}}</span>
    </td>
    <td class="text-center">
        <div class="btn-group">
        <button v-on:click="viewItem()" type="button" class="btn btn-sm btn-info"  title="View"  data-toggle="tooltip" data-placement="bottom" >
            <i class="fa fa-eye"></i>
        </button>
        </div>
        <div class="btn-group">
             <button  :disabled="language.id == 1" v-on:click="editItem()" type="button" class="btn btn-sm btn-primary"  :title="this.$getLang('edit')"  data-toggle="tooltip" data-placement="bottom" >
                <i class="fa fa-pencil-alt"></i>
            </button> 
        </div>
        <div class="btn-group">
        <button :disabled="language.id == 1" v-on:click="deleteItem()" type="button" class="btn btn-sm btn-danger"  :title="this.$getLang('delete')"  data-toggle="tooltip" data-placement="bottom" >
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
    props:['language','image','editFun','deleteFun','viewFun'],
    methods:{
        editItem:function(){
          this.editFun(this.language.id)
        },
        deleteItem:function(){
            this.deleteFun(this.language.id)
        },
        viewItem:function(){
            this.viewFun(this.language.id)
        }
    }
    }
    </script>
