@extends('admin.layout')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/codemirror/codemirror.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/codemirror/monokai.css')}}">
@endsection


@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Custom Css') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a> </li>
                        <li class="breadcrumb-item">{{ __('Custom Css') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Write Your Custom CSS Here') }}</h3>
                        </div>

                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('admin.updateCustomcss') }}" method="POST" >
                                @csrf


                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <textarea  name="custom_css_area" id="custom_css_area" cols="30" rows="10">{{ $custom_css }}</textarea>
                                        @if($errors->has('cookie_alert_text'))
                                        <p class="text-danger">{{ $errors->first('cookie_alert_text') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection


@section('script')
    <script src="{{asset('assets/admin/plugins/codemirror/codemirror.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/codemirror/css.js')}}"></script>
    <script>
        (function($) {
            "use strict";
            var editor = CodeMirror.fromTextArea(document.getElementById("custom_css_area"), {
                lineNumbers: true,
                mode: "text/css",
                matchBrackets: true,
                theme: "monokai"
            });
        })(jQuery);
    </script>
@endsection
