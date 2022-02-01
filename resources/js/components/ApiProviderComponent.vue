<template>
    <tr>
    
    <td class="font-w600">
        <a class="font-w700" href="#">{{api_provider.id}}</a>
    </td>
    <td class="d-none d-sm-table-cell">
        {{api_provider.name}}
    </td>
    <td class="d-none d-sm-table-cell">
    {{balance}}
    </td>
    <td class="d-none d-sm-table-cell">
    {{api_provider.services_count}}
    </td>
     <td class="d-none d-sm-table-cell">
    {{api_provider.url}}
    </td>
    <td class="d-none d-sm-table-cell">
    <span class="badge badge-pill" :class="{ 'badge-success' :  this.connected == 'yes','badge-danger' : this.connected == 'no' }" >{{this.connected}}</span>
    </td>
    <td class="d-none d-sm-table-cell">
    {{api_provider.notes}}
    </td>
    <td class="d-none d-sm-table-cell">
        <span class="badge badge-pill" :class="{ 'badge-success' :  api_provider.status == 'active','badge-danger' : api_provider.status == 'deactive' }" >{{this.$getLang(api_provider.status)}}</span>
    </td>
    <td class="text-center">
        <div class="btn-group">
             <button v-on:click="getServicesList()" type="button" class="btn btn-sm btn-primary"  data-toggle="tooltip" data-placement="bottom" title="Services" >
                <i class="fa fa-list"></i>
            </button>
        </div>
        <div class="btn-group">
             <button :disabled="processing" v-on:click="refreshServicesList(api_provider.id)" type="button" class="btn btn-sm btn-primary"  data-toggle="tooltip" data-placement="bottom" title="Sync Services" >
               <i v-if="!processing" class="fas fa-sync-alt"></i>
               <i v-if="processing" class="fas fa-sync-alt fa-spin"></i>
            </button>
        </div>
        <div class="btn-group">
             <button v-on:click="editItem()" type="button" class="btn btn-sm btn-primary" :title="this.$getLang('edit')"  data-toggle="tooltip" data-placement="bottom">
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
    data: function () {
    return {
      balance: 0,
      services_count : 0,
      processing : false,
      connected : 'no'
    }
    },
    mounted() {
    console.log('Component mounted api provider.')
    this.getServices()
    this.getBalance()
    },
    props:['api_provider','editFun','deleteFun'],
    methods:{
        editItem:function(){
          this.editFun(this.api_provider.id)
        },
        deleteItem:function(){
            this.deleteFun(this.api_provider.id)
        },
        getServices: function(){
            axios.post('api-providers/api',{key:this.api_provider.api_key,action:'services',url:this.api_provider.url}).then(res=>{
                this.connected = res.data.length == this.api_provider.services_count? 'yes' : 'no'
            })
        },
        getBalance: function()
        {
         axios.post('api-providers/api',{key:this.api_provider.api_key,action:'balance',url:this.api_provider.url}).then(res=>{
              if(res.data.balance != undefined)
              this.balance = res.data.balance+' '+res.data.currency
            }) 
        },
        getServicesList: function()
        {
            window.location.href = '/admin/services?api_provider='+this.api_provider.id
        },
        refreshServicesList : function(id)
        {
        this.processing = true
        axios.post('api-providers/sync-services/'+id).then(res=>{
              if(res.status == 200){
                window.utilities.notify('success','services synchronized successfully')
                this.processing = false
            }
            })
        }

    }
    }
    </script>
