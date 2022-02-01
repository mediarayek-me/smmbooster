@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{asset('admin/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/js/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/js/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}">
<link rel="stylesheet" href="{{asset('admin/js/plugins/dropzone/min/dropzone.min.css')}}">
@endsection

@section('content')
<main id="main-container">

    <div class="settings-area my-4">
        <h4 class="mt-2 mb-4">{{Helper::getLang('Appearance Settings')}}</h4>
        <div class="card content">
            <div class="card-body">
                <form class="actionForm" action="{{ route('admin.settings.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="apparence">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="site_base_color">{{Helper::getLang('Site Base Color')}}</label>
                            <div id="site_base_color" class="input-group" title=">Site Base Color">
                                <input name="site_base_color" type="text" class="form-control input-lg" value="@if(isset($settings['site_base_color'])){{$settings['site_base_color']}} @endif"/>
                                <span class="input-group-append">
                                  <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                              </div>
                        </div>
                        <div class="col-md-4">
                            <label for="site_secondary_color">{{Helper::getLang('Site Secondary Color')}}</label>
                            <div id="site_secondary_color" class="input-group" title="Site Secondary Color">
                                <input  name="site_secondary_color" type="text" class="form-control input-lg" value="@if(isset($settings['site_secondary_color'])){{$settings['site_secondary_color']}} @endif"/>
                                <span class="input-group-append">
                                  <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="site_tertiary_color">{{Helper::getLang('Site Tertiary Color')}}</label>
                            <div id="site_tertiary_color" class="input-group" title="Site Tertiary Color">
                                <input name="site_tertiary_color" type="text" class="form-control input-lg" value="@if(isset($settings['site_tertiary_color'])){{$settings['site_tertiary_color']}} @endif"/>
                                <span class="input-group-append">
                                  <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="block block-rounded text-center">
                                <div class="block-content block-content-full  p-0">
                                    <div class="m-0 overflow-hidden">
                                        <img height="140"
                                            src="{{ isset($settings['website_logo']) ? asset('images/'.$settings['website_logo']) : '#' }} "
                                            alt="">
                                    </div>
                                </div>
                                <div class="block-content block-content-full block-content-sm bg-body-light">
                                    <div class="font-w600">{{Helper::getLang('Logo')}}</div>
                                    <div class="font-size-sm text-muted">{{Helper::getLang('website Logo')}}</div>
                                </div>
                                <div class="block-content block-content-full">
                                    <a class="btn btn-sm btn-light select-img" href="javascript:void(0)">
                                        <i class="fa fa-save text-muted mr-1"></i>{{Helper::getLang('SELECT')}}
                                    </a>
                                    <input class="d-none" type="file" name="website_logo" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="block block-rounded text-center">
                                <div class="block-content block-content-full  p-0">
                                    <div class="m-0">
                                        <img height="140"
                                            src="{{ isset($settings['shortcut_icon']) ? asset('images/'.$settings['shortcut_icon']) : '#' }} "
                                            alt="">
                                    </div>
                                </div>
                                <div class="block-content block-content-full block-content-sm bg-body-light">
                                    <div class="font-w600">{{Helper::getLang('Icon')}}</div>
                                    <div class="font-size-sm text-muted">{{Helper::getLang('shortcut icon')}}</div>
                                </div>
                                <div class="block-content block-content-full">
                                    <a class="btn btn-sm btn-light select-img" href="javascript:void(0)">
                                        <i class="fa fa-save text-muted mr-1"></i>{{Helper::getLang('SELECT')}}
                                    </a>
                                    <input class="d-none" type="file" name="shortcut_icon" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="block block-rounded text-center">
                                <div class="block-content block-content-full  p-0">
                                    <div class="m-0">
                                        <img height="140"
                                            src="{{ isset($settings['website_icon']) ? asset('images/'.$settings['website_icon']) : '#' }}"
                                            alt="">
                                    </div>
                                </div>
                                <div class="block-content block-content-full block-content-sm bg-body-light">
                                    <div class="font-w600">{{Helper::getLang('Icon')}}</div>
                                    <div class="font-size-sm text-muted">{{Helper::getLang('website icon')}}</div>
                                </div>
                                <div class="block-content block-content-full">
                                    <a class="btn btn-sm btn-light select-img" href="javascript:void(0)">
                                        <i class="fa fa-save text-muted mr-1"></i>{{Helper::getLang('SELECT')}}
                                    </a>
                                    <input class="d-none" type="file" name="website_icon" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="block block-rounded text-center">
                                <div class="block-content block-content-full  p-0">
                                    <div class="m-0">
                                        <img height="140"
                                            src="{{ isset($settings['apple_icon']) ? asset('images/'.$settings['apple_icon']) : '#' }}"
                                            alt="">
                                    </div>
                                </div>
                                <div class="block-content block-content-full block-content-sm bg-body-light">
                                    <div class="font-w600">{{Helper::getLang('Apple Icon')}}</div>
                                    <div class="font-size-sm text-muted">{{Helper::getLang('Apple touch icon')}}</div>
                                </div>
                                <div class="block-content block-content-full">
                                    <a class="btn btn-sm btn-light select-img" href="javascript:void(0)">
                                        <i class="fa fa-save text-muted mr-1"></i>{{Helper::getLang('SELECT')}}
                                    </a>
                                    <input class="d-none" type="file" name="apple_icon" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-min-width btn-sm ">{{Helper::getLang('Save')}}</button>
                        </div>


                    </div>
                </form>
            </div>
        </div>


    </div>
</main>

<!-- END Page Container -->
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
    <script>
        var loadFile = function (input, output) {
            var reader = new FileReader();
            reader.onload = function () {
                output.attr('src', reader.result);
            };
            reader.readAsDataURL(input.files[0]);
        }

        jQuery(function () {
            // images click handler
            $(".select-img").on('click', function ($event) {
                $(this).parent().find('input').click()
                $(this).parent().find('input').on('change', function () {
                    var input = $(this)[0]
                    var output = $(this).parent().parent().find('img')
                    loadFile(input, output)

                })
            })
            // color picker handler
            $('#site_base_color').colorpicker({"color": "@if(isset($settings['site_base_color'])){{$settings['site_base_color']}}@endif"});
            $('#site_secondary_color').colorpicker({"color": "@if(isset($settings['site_secondary_color'])){{$settings['site_secondary_color']}}@endif"});
            $('#site_tertiary_color').colorpicker({"color": "@if(isset($settings['site_tertiary_color'])){{$settings['site_tertiary_color']}}@endif"});

        })

    </script>
    <script src="{{asset('admin/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('admin/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('admin/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('admin/js/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('admin/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('admin/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('admin/js/plugins/dropzone/min/dropzone.min.js')}}"></script>
    <script src="{{asset('admin/js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/plugins/flatpickr/flatpickr.min.js')}}"></script>  
    <script>jQuery(function(){Dashmix.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'rangeslider', 'masked-inputs', 'pw-strength']);});</script>
    @endsection
