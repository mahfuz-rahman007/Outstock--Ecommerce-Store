@extends('admin.layout')

@section('content')

<div class="content-header">
        <div class="container-fluid">
            <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Edit Payment Gateway') }} </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                <li class="breadcrumb-item">{{ __('Payment Setting') }}</li>
                <li class="breadcrumb-item">{{ __('Edit Payment Gateway') }}</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title mt-1">{{ __('Edit Payment Gateway') }}</h3>
                                <div class="card-tools">
                                    <a href="{{ route('admin.payment') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form class="form-horizontal" action="{{ route('admin.payment.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label">{{ __('Image') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <img class="mw-400 mb-3 show-img img-demo" src="{{ asset('assets/front/img/'.$data->image) }}" alt="">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="image">{{ __('Choose New Image') }}</label>
                                                <input type="file" class="custom-file-input up-img" name="image" id="image">
                                            </div>
                                            @if ($errors->has('image'))
                                                <p class="text-danger"> {{ $errors->first('image') }} </p>
                                            @endif
                                            <p class="help-block text-info">{{ __('Upload 730X455 (Pixel) Size image for best quality.
                                                Only jpg, jpeg, png image is allowed.') }}
                                            </p>
                                        </div>
                                    </div>

                                    @if($data->type == 'automatic')

                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 control-label">{{ __('Name') }}<span class="text-danger">*</span></label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="title" placeholder="{{ __('Name') }}" value="{{$data->title}}">
                                                @if ($errors->has('title'))
                                                    <p class="text-danger"> {{ $errors->first('title') }} </p>
                                                @endif
                                            </div>

                                        </div>

                                        @if($data->information != null)
                                            @foreach($data->convertAutoData() as $pkey => $pdata)

                                            @if($pkey == 'sandbox_check')
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 control-label">{{ __( $data->name.' '.ucwords(str_replace('_',' ',$pkey)) ) }}<span class="text-danger">*</span></label>

                                                <div class="col-sm-10">
                                                    <input type="checkbox" class="form-control" name="pkey[{{ __($pkey) }}]" value="1" {{ $pdata == 1 ? "checked":"" }}>
                                                </div>
                                            </div>
                                            @else

                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 control-label">{{ __( $data->name.' '.ucwords(str_replace('_',' ',$pkey)) ) }}<span class="text-danger">*</span></label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="pkey[{{ __($pkey) }}]" placeholder="{{ __( $data->name.' '.ucwords(str_replace('_',' ',$pkey)) ) }}" value="{{ $pdata }}" required="">
                                                </div>
                                            </div>

                                            @endif
                                            @endforeach

                                        @endif
                                    @else

                                        <div class="form-group row">
                                            <label for="title" class="col-sm-2 control-label">{{ __('Title') }}<span class="text-danger">*</span></label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="title" placeholder="{{ __('Title') }}" value="{{$data->title}}">
                                                @if ($errors->has('title'))
                                                <p class="text-danger"> {{ $errors->first('title') }} </p>
                                                @endif
                                            </div>
                                        </div>

                                        @if($data->keyword == null)

                                        <div class="form-group row">
                                            <label for="details" class="col-sm-2 control-label">{{ __('Description') }}<span class="text-danger">*</span></label>

                                            <div class="col-sm-10">
                                                <textarea id="area1" class="form-control" name="details">{{$data->details}}</textarea>
                                            </div>
                                        </div>


                                        @endif
                                    @endif

                                    <div class="form-group row">
                                        <label for="status" class="col-sm-2 control-label">{{ __('Status') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <select class="form-control" name="status">
                                               <option value="0" {{ $data->status == '0' ? 'selected' : '' }}>{{ __('Unpublish') }}</option>
                                               <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>{{ __('Publish') }}</option>
                                              </select>
                                            @if ($errors->has('status'))
                                                <p class="text-danger"> {{ $errors->first('status') }} </p>
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
                            <!-- /.card-body -->
                        </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
@endsection
