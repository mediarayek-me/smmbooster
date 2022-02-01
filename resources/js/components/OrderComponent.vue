<template>
    <tr>
        <td class="d-none d-sm-table-cell">
            {{order.id}}
        </td>
        <td class="d-none d-sm-table-cell">
            <div class="text-center">
                  <small> {{order.user.firstname +' '+ order.user.lastname}}</small>
                <div>
                    {{order.user.email}}
                </div>
            </div>
            </td>
        <td class="d-none d-sm-table-cell">
            <div v-html="order.details" class="details"></div>
        </td>
        <td class="d-none d-sm-table-cell">
            <small class="text-center">
                <div class="text-center">
                    {{order.created_at}}
                </div>
            </small>
        </td>
         <td  v-if="permissions.is_admin" class="d-none d-sm-table-cell">
            {{order.service.type}}
            <div v-if="order.service.type == 'api'">
            <small class="text-success" v-if="order.order_api_id" >Request send</small>
            <small class="text-danger" v-if="!order.order_api_id" >Error: <span>{{order.api_provider_error}}</span></small>
            </div>
        </td>
        <td class="d-none d-sm-table-cell">
        <span class="badge badge-pill p-2" :class="{ 'badge-primary': this.status != 'completed' &&   this.status != 'refunded' &&  this.status != 'error' ,'badge-success' :  this.status == 'completed','badge-danger' : this.status == 'refunded' ||  this.status == 'error'  }" >{{this.$getLang(this.status)}}</span>
       </td>
        <td v-if="permissions.is_admin"  class="text-center">
            <div v-if="permissions.edit"  class="btn-group">
             <button v-on:click="editItem()" type="button" class="btn btn-sm btn-primary"  :title="this.$getLang('edit')"  data-toggle="tooltip" data-placement="bottom" >
                <i class="fa fa-pencil-alt"></i>
            </button> 
           </div>
            <div v-if="permissions.delete"  class="btn-group">
                 <button v-on:click="deleteItem()" type="button" class="btn btn-sm btn-danger"  :title="this.$getLang('delete')"  data-toggle="tooltip" data-placement="bottom">
            <i class="fa fa-trash"></i>
                 </button>
            </div>
        </td>
    </tr>
</template>

<script>
export default {
    name:'order-item',
    props:['order','editFun','viewFun','deleteFun','permissions'],
    mounted:function(){
        this.getOrderStatus()
    },
    data:function()
    {
        return {
        status : ''
    }
    },
    methods:{
        editItem:function(){
          this.editFun(this.order.id)
        },
        deleteItem:function(){
            this.deleteFun(this.order.id)
        },
        viewItem:function(){
            this.viewFun(this.order.id)
        },
        getOrderStatus: function()
        {
            if(this.order.service.type == 'api' && this.order.order_api_id)
            {
            let api_provider = this.order.service.api_provider
            axios.post('api-providers/api',{key:api_provider.api_key,action:'status',order:this.order.order_api_id,url:api_provider.url}).then(res=>{
             if(res.data.status)
             this.status = res.data.status
             }) 
            }else
            this.status = this.order.status
        }

    }
}
</script>

