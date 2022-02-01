<template>
    <tr>
    
    <td class="font-w600">
        <a class="font-w700" href="#">{{paymentMethod.id}}</a>
    </td>
    <td class="d-none d-sm-table-cell">
        {{paymentMethod.name}} 
        <img class="ml-3" style="width:70px"  :src="image">
    </td>
      <td class="d-none d-sm-table-cell">
    {{paymentMethod.fee}}%
    </td>
     <td class="d-none d-sm-table-cell">
    {{paymentMethod.min}}
    </td>
    <td class="d-none d-sm-table-cell">
    {{paymentMethod.max}}
    </td>
    <td class="d-none d-sm-table-cell">
        <span class="badge badge-pill" :class="{ 'badge-success' :  paymentMethod.status == 'active','badge-danger' : paymentMethod.status == 'deactive' }" >{{this.$getLang(paymentMethod.status)}}</span>
    </td>
    <td class="text-center">
        <div class="btn-group">
             <button v-on:click="editItem()" type="button" class="btn btn-sm btn-primary"  :title="this.$getLang('edit')"  data-toggle="tooltip" data-placement="bottom">
                <i class="fa fa-pencil-alt"></i>
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
    props:['paymentMethod','image','editFun','deleteFun'],
    methods:{
        editItem:function(){
          this.editFun(this.paymentMethod.id)
        },
    }
    }
    </script>
