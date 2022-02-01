@extends('layouts.admin')


@section('content')
<main id="main-container">

<div class="language_value-area my-4">
    <!-- filters bar -->
    <div class="block-header bg-white mb-4">
        <div class="m-0">
                <h3 class="m-0">{{Helper::getLang('Language values')}}</h3>
        </div>
    </div>
    <!-- Hover Table -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <div class="block-content">
            <div class="d-flex justify-content-between">
                <button v-on:click="storeValues()" type="button" class="btn btn-primary mb-3">{{Helper::getLang('save')}}</button>
            </div>
            <form ref="form" action="{{route('admin.languages.store-values')}}" method="post">
              @csrf
                <div class="col-md-12">
                    @foreach ($keys as $i => $row)
                    {{-- <a target="_blank"  href="{{route('admin.languages.delete-key',$row->id)}}" class="">delete</a> --}}
                    <div class="row">
                        <div class="col-md-6">
                        @if ($i == 0) <label >{{Helper::getLang('Keys')}}</label> @endif
                        <input type="hidden" value="{{$id}}" name="language_id">
                          <div class="form-group">
                              <input type="text" class="form-control" readonly value="{{$row->key}}" name="key[]" id="key"  placeholder="{{Helper::getLang('Key')}}" style="direction:ltr !important;text-align:left !important">
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            @if ($i == 0) <label >{{Helper::getLang('Values')}}</label> @endif
                            <input @if($language->direction == 'rtl')  dir="rtl" @endif type="text" class="form-control" value="{{$row->value}}" name="value[]" id="value"  placeholder="{{Helper::getLang('Value')}}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                   
                </div>
            </form>
        </div>
      </div>

  </div>
  <!-- END Hover Table -->
</div>
</main>

<!-- END Page Container -->
@endsection

@section('scripts')
@if(session()->has('success_save') == true)
<script>
  jQuery(function(){
    window
    .utilities.notify('success','language saved successfully');
  })
</script>
@endif
@php session()->forget('success_save') @endphp

<script src="{{asset('js/pages/language.js')}}"></script>
@endsection