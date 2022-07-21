@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Admin Profile') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item">{{ __('Admin Profile') }}</li>
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
                        <h3 class="card-title">{{ __('Update Admin Password') }} </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.updatePassword') }}" method="POST">
                            @csrf
                
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Current Password') }} <span
                                    class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="old_password" value="" placeholder="{{ __('Your Current Password') }}">
                                    @if ($errors->has('old_password'))
                                        <p class="text-danger"> {{ $errors->first('old_password') }} </p>
                                    @else
                                    @if ($errors->first('oldPassMatch'))
                                        <span class="text-danger">
                                            {{"Old password doesn't match with the existing password!"}}
                                        </span>
                                    @endif
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label"> {{ __('New Password') }}<span
                                    class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="password" value="" placeholder="{{ __('New Password') }}">
                                    @if ($errors->has('password'))
                                    <p class="text-danger"> {{ $errors->first('password') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Confirm Password') }}<span
                                    class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="password_confirmation" value="" placeholder="{{ __('Confirm Password') }}">
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
            <!-- /.col -->
        </div>
    </div>


</section>

@endsection

