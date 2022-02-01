
Vue.component('pagination', require('laravel-vue-pagination'));


window.utilities  = {
  notify : function(type,message){
    var keys = JSON.parse(localStorage.getItem('lang_keys'))

    if(keys && keys[message.toLowerCase()] )
     message = keys[message.toLowerCase()]
    if(type == 'success'){

      Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: message });
    }else
    if(type == 'error')
    {
      Dashmix.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: message});
    }
  }
}



// get config settings
// axios.post('/admin/settings/currency').then(res=>{
//   if(res.data){
//     window.config = {}
//     window.config.currency = res.data.value 

    //set filters
    // setFilters()
// }
// })

var getLanguageValues = function()
{
   var language_id = $('meta[name="language_id"]').attr('content');
   if(!language_id) 
   language_id = 1
  axios.get('/admin/languages/get-language-values/'+language_id).then(res=>{
    if(res.status == 200){
      localStorage.setItem('lang_keys',JSON.stringify(res.data))
      //console.log(res.data)
    }
})
}

var setFilters = function()
{
      // set filters
Vue.filter('toCurrency', function (value) {
  if (typeof value !== "number") {
      return value;
  }
  var currency = window.config.currency?window.config.currency:'USD'
  var formatter = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: currency,
      minimumFractionDigits: 0
  });
  return formatter.format(value);
});
}
var logOut = function()
{
  $(document).ready(function(){
    $('.admin-logout').on('click',function(){
      $(this).find('form').submit()
    })
  })
}

setFilters()
getLanguageValues()
logOut()

Vue.prototype.$getLang = key =>
{
  var keys = JSON.parse(localStorage.getItem('lang_keys'))
  if(keys[key])
  return keys[key]
  else
  return key
}
//window.lang_keys[key]


