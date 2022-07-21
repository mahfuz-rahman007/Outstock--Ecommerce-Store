@extends('admin.layout')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Seo Information') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a> </li>
                        <li class="breadcrumb-item">{{ __('Seo Information') }}</li>
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
                            <h3 class="card-title">{{ __('Add Social Link') }}</h3>
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
                            <form id="slink" class="form-horizontal" action="{{ route('admin.updateSeoinfo', $seoinfo->language_id) }}" method="POST" onsubmit="store(event)" >
                                @csrf

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 control-label">{{ __('Meta Keywords') }}<span
                                    class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="meta_keywords" data-role="tagsinput" class="form-control" value="{{ $seoinfo->meta_keywords }}" placeholder="{{ __('Enter Meta Keywords') }}">
                                        @if ($errors->has('meta_keywords'))
                                        <p class="text-danger"> {{ $errors->first('meta_keywords') }} </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="meta_description" class="col-sm-2 control-label">{{ __('Meta Description') }}<span
                                    class="text-danger">*</span></label>

                                    <div class="col-sm-10">
                                        <textarea type="text" name="meta_description" id="meta_description" class="form-control" placeholder="{{ __('Enter Meta Description') }}" rows="4">{{ $seoinfo->meta_description }}</textarea>
                                        @if($errors->has('meta_description'))
                                        <p class="text-danger">{{ $errors->first('meta_description') }}</p>
                                    @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
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
