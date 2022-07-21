@extends('admin.layout')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Cookie Alert') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a> </li>
                        <li class="breadcrumb-item">{{ __('Cookie Alert') }}</li>
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
                            <h3 class="card-title">{{ __('Update Cookie Text') }}</h3>
                            <div class="card-tools d-flex">
                                <div class="d-inline-block mr-4">
                                    <select class="form-control lang languageSelect" data="{{ url()->current(). '?language='}}">
                                        @foreach ($langs as $lang)
                                        <option value="{{ $lang->code }}" {{ $lang->code == request()->input('language') ? 'selected':'' }}>{{ $lang->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form id="slink" class="form-horizontal" action="{{ route('admin.updateCookiealert', $cookiealert->language_id) }}" method="POST" >
                                @csrf


                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <textarea type="text" name="cookie_alert_text" id="cookie_alert_text" class="form-control summernote" placeholder="{{ __('Cookie Alert Text') }}" rows="5">{{ $cookiealert->cookie_alert_text }}</textarea>
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
