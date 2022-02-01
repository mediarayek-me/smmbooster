<template>
    <tr>
    
    <td class="font-w600">
        <a class="font-w700" href="#">{{ticket.id}}</a>
    </td>
    <td class="d-none d-sm-table-cell">
        {{ticket.name}}<br>
        {{ticket.email}}<br>
    </td>
     <td class="d-none d-sm-table-cell">
    {{ticket.type}}
    </td>
    <td class="d-none d-sm-table-cell">
        <span class="badge badge-pill" :class="{ 'badge-info' :  ticket.status == 'pending','badge-success' : ticket.status == 'answered','badge-danger' : ticket.status == 'closed' }" >{{ this.$getLang(ticket.status)}}</span>
    </td>
    <td class="d-none d-sm-table-cell">
    {{ticket.created_at}}
    </td>
 
    <td class="text-center">
        <div class="btn-group">
             <button v-on:click="viewItem(ticket.id)" type="button" class="btn btn-sm btn-info"  title="View"  data-toggle="tooltip" data-placement="bottom" >
                <i class="fa fa-eye"></i>
            </button> 
        </div>
        <div class="btn-group">
        <button v-on:click="deleteItem(ticket.id)" type="button" class="btn btn-sm btn-danger"  :title="this.$getLang('delete')"  data-toggle="tooltip" data-placement="bottom" >
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
    props:['ticket','viewFun','deleteFun'],
    methods:{
        viewItem:function(id){
          this.viewFun(id)
        },
        deleteItem:function(id){
            this.deleteFun(id)
        },
      
    }
    }
    </script>
