@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Basic Information') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a> </li>
                    <li class="breadcrumb-item">{{ __('Basic Information') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            {{-- update BAsic Information --}}
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Update Basic Information') }}</h3>
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
                        <form class="form-horizontal" action="{{ route('admin.setting.updateBasicinfo', $basicinfo->language_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="website_title" class="col-sm-2 control-label">{{ __('Site Title') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="website_title" id="website_title" class="form-control" value="{{$basicinfo->website_title}}" placeholder="{{ __('Site Title') }}">
                                    @if($errors->has('website_title'))
                                     <p class="text-danger">{{ $errors->first('website_title') }}</p>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="address" class="col-sm-2 control-label">{{ __('Address') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="address" id="address" class="form-control" value="{{$basicinfo->address}}" placeholder="{{ __('Address') }}">
                                    @if($errors->has('address'))
                                     <p class="text-danger">{{ $errors->first('address') }}</p>
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

            {{-- Update Common Setting Onfo --}}
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Update Basic Information') }} </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.setting.updateCommoninfo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="base_color" class="col-sm-2 control-label">{{ __('Theme Color') }}</label>
                                <div class="col-sm-10">
                                    <div class="input-group my-colorpicker2">
                                        <input type="text" class="form-control" value="{{ $commonsetting->base_color }}"  placeholder="#000000" name="base_color">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fas fa-square"></i></span>
                                        </div>
                                      </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 control-label">{{ __('Phone Number') }}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" data-role="tagsinput" name="number" placeholder="{{ __('Number') }}" value="{{ $commonsetting->number }}">
                                    <p class="help-block text-info">{{ __('The first entered number will show in the header top menu') }}
                                    @if ($errors->has('number'))
                                        <p class="text-danger"> {{ $errors->first('number') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 control-label">{{ __('Email') }}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" data-role="tagsinput" name="email" placeholder="{{ __('Email') }}" value="{{ $commonsetting->email }}">
                                    <p class="help-block text-info">{{ __('The first entered email will show in the header top menu') }}
                                    @if ($errors->has('email'))
                                        <p class="text-danger"> {{ $errors->first('email') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 control-label">{{ __('Contact Form Email') }}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control"  name="contactemail" placeholder="{{ __('Contact Form Email') }}" value="{{ $commonsetting->contactemail }}">
                                    <p class="help-block text-info">{{ __('Contact page form  maill will send this email') }}
                                    @if ($errors->has('contactemail'))
                                        <p class="text-danger"> {{ $errors->first('contactemail') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Favicon') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <img class="mb-3 show-img img-demo" src="
                                    @if($commonsetting->fav_icon)
                                    {{ asset('assets/front/img/'.$commonsetting->fav_icon) }}
                                    @else
                                    {{ asset('assets/admin/img/img-demo.jpg') }}
                                    @endif"
                                    " alt="">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="fav_icon">{{ __('Choose New Image') }}</label>
                                        <input type="file" class="custom-file-input up-img" name="fav_icon" id="fav_icon">
                                    </div>
                                    <p class="help-block text-info">{{ __('Upload 40X40 (Pixel) Size image or Squre size image for best quality.
                                        Only jpg, jpeg, png image is allowed.') }}
                                    </p>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Site Header Logo') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <img class="mb-3 show-img img-demo" src="
                                    @if($commonsetting->header_logo)
                                    {{ asset('assets/front/img/'.$commonsetting->header_logo) }}
                                    @else
                                    {{ asset('assets/admin/img/img-demo.jpg') }}
                                    @endif" alt="">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="header_logo">Choose New Image</label>
                                        <input type="file" class="custom-file-input up-img" name="header_logo" id="header_logo">
                                    </div>
                                    <p class="help-block text-info">{{ __('Upload 150X40 (Pixel) Size image for best quality.
                                        Only jpg, jpeg, png image is allowed.') }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Site Footer Logo') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <img class="mb-3 show-img img-demo" src="
                                    @if($commonsetting->footer_logo)
                                    {{ asset('assets/front/img/'.$commonsetting->footer_logo) }}
                                    @else
                                    {{ asset('assets/admin/img/img-demo.jpg') }}
                                    @endif" alt="">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="footer_logo">Choose New Image</label>
                                        <input type="file" class="custom-file-input up-img" name="footer_logo" id="footer_logo">
                                    </div>
                                    <p class="help-block text-info">{{ __('Upload 150X40 (Pixel) Size image for best quality.
                                        Only jpg, jpeg, png image is allowed.') }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Breadcrumb Image') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <img class="mw-400 mb-3 show-img img-demo" src="
                                    @if($commonsetting->breadcrumb_image)
                                    {{ asset('assets/front/img/'.$commonsetting->breadcrumb_image)}}
                                    @else
                                    {{ asset('assets/admin/img/img-demo.jpg') }}
                                    @endif"
                                    " alt="">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="breadcrumb_image">{{ __('Choose New Image') }}</label>
                                        <input type="file" class="custom-file-input up-img" name="breadcrumb_image" id="breadcrumb_image">
                                    </div>
                                    <p class="help-block text-info">{{ __('Upload 1920X390 (Pixel) Size image for best quality.
                                        Only jpg, jpeg, png image is allowed.') }}
                                    </p>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
    </div>
</div>



@endsection
