@if(session()->has($key))
@php session()->forget($key) @endphp
<script>
jQuery(function(){
     window.utilities.notify("{{$type}}","{{$message}}");
})
</script>
@endif