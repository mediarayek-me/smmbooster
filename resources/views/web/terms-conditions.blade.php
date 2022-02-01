@extends('layouts.app')

@section('content')

<!--- Header Start ---->
@include('web/partials/header',['links'=>true]);

<!--  content-->
<div  class="container">
    <div class="bg-white p-4  my-4">
        <h3>{{Helper::getLang('Terms & Privacy Policy')}}</h3>
        <div class="my-1">
            {!! Helper::settings('terms_policy') !!}
        </div>

    </div>
     <div class="bg-white p-4  my-4">
        <h3>{{Helper::getLang('Cookie Policy')}}</h3>
        <div class="my-1">
            {!! Helper::settings('cookie_policy') !!}
        </div
    </div>
</div>



<!-- ***** Footer Start ***** -->
@include('web/partials/footer')

@endsection


@section('scripts')
<!-- jQuery -->
<script src="{{ asset('assets/js/jquery-2.1.0.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('assets/js/scrollreveal.min.js') }}"></script>
<script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/js/imgfix.min.js') }}"></script>

<!-- Global Init -->
<script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection


