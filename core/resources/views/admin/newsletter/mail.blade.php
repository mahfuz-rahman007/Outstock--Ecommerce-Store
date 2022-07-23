@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Mail Subscribers') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Mail Subscribers') }}</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Send Mail') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                            <form class="" action="{{route('admin.subscribers.sendmail')}}" method="post">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="">Subject <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="subject" value="" placeholder="Enter subject of E-mail">
                                            @if ($errors->has('subject'))
                                              <p class="text-danger mb-0">{{$errors->first('subject')}}</p>
                                            @endif
                                          </div>
                                          <div class="form-group">
                                            <label for="">Message <span class="text-danger">*</span></label>
                                            <textarea name="message" class="summernote" data-height="150"></textarea>
                                            @if ($errors->has('message'))
                                              <p class="text-danger mb-0">{{$errors->first('message')}}</p>
                                            @endif
                                          </div>
                                          <button type="submit" class="btn btn-primary">
                                            Send Mail <i class="far fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
@endsection
