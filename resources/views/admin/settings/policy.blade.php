@extends('layouts.admin')

@section('css')
<style>
    .ck.ck-editor{
    height: 500px !important;
    overflow: auto !important;
    }
</style>
@endsection
@section('content')
<main id="main-container">

    <!-- Page Content -->
    <div class="content">
        <div class="block block-rounded">
            <form class="actionForm" action="{{ route('admin.settings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="policy">
                <div class="block-content">
                    <h4>{{Helper::getLang('Terms & Policy')}}</h4>
                    <div class="form-group">
                        <textarea name="terms_policy"  id="terms_policy">@if(isset($settings['terms_policy'])){{$settings['terms_policy'] }}@endif</textarea>
                    </div>
                </div>
                    

                <div class="block-content border-top">
                    <h4>{{Helper::getLang('Cookie Policy')}}</h4>
                        <div class="form-group">
                            <!-- CKEditor 5 Classic Container -->
                            <textarea name="cookie_policy" id="cookie_policy">@if(isset($settings['cookie_policy'])){{$settings['cookie_policy'] }}@endif</textarea>
        
                        </div>
                        <div class="form-group">
                                <button class="btn btn-primary btn-min-width btn-sm mt-3">{{Helper::getLang('Save')}}</button>
        
                        </div>
                </div>

                </form>
        </div>
        <!-- END CKEditor 5 Classic-->
    </div>
    <!-- END Page Content -->
</main>
@endsection

@section('scripts')
@if(session()->has('success_save') == true)
<script>
    jQuery(function () {
        window.utilities.notify('success', 'settings saved successfully');
    })
    
    </script>
    @endif
@php session()->forget('success_save') @endphp

    <!-- Page JS Plugins -->
    <script src="{{ asset('admin/js/plugins/ckeditor5-classic/build/ckeditor.js') }}">
    </script>

    <!-- Page JS Helpers (CKEditor 5 plugins) -->
    <script>
        jQuery(function () {
            Dashmix.helpers(['ckeditor5']);
        });

    </script>
    <script>
        
        ClassicEditor
            .create(document.querySelector('#cookie_policy'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#terms_policy'))
            .catch(error => {
                console.error(error);
            });

    </script>
    @endsection
