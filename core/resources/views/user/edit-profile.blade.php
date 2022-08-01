@extends('front.layout')

@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")

@section('content')
    <main>

        <!-- page title area start -->
        <section class="page__title p-relative d-flex align-items-center"
            data-background="{{ asset('assets/front/img/' . $commonsetting->breadcrumb_image) }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page__title-inner text-center">
                            <h1>{{ __('Edit Profile') }}</h1>
                            <div class="page__title-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                                        </li>

                                        <li class="breadcrumb-item" aria-current="page">
                                            {{ __('Edit Profile') }}
                                        </li>

                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page title area end -->

        <!-- User Dashboard Start -->
        <section class="user-dashboard-area pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        @includeif('user.side-dashboard')
                    </div>
                    <div class="col-lg-9 ">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <h4 class="card-header">{{ __('Edit Profile') }}</h4>
                                    <div class="card-body">
                                        <form action="{{ route('user.updateProfile', Auth::user()->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row justify-content-center">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-4 text-center">
                                                        <div class="upload-img d-inline">
                                                            <div class="img">
                                                                <img class="mb-3 show-img img-demo"
                                                                    src="
                                                                    @if (Auth::user()->image) {{ asset('assets/front/img/' . Auth::user()->image) }}
                                                                    @else
                                                                    {{ asset('assets/admin/img/img-demo.jpg') }}
                                                                    @endif"
                                                                    alt="">
                                                            </div>
                                                            <div class="file-upload-area">
                                                                <div class="upload-file">
                                                                    <input type="file" name="image"
                                                                        class="upload image form-control up-img">
                                                                </div>
                                                                @if ($errors->has('image'))
                                                                    <p class="m-1 text-danger">
                                                                        {{ $errors->first('image') }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">{{ __('Name') }}</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ Auth::user()->name }}">
                                                        @if ($errors->has('name'))
                                                            <p class="m-1 text-danger">{{ $errors->first('name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">{{ __('Email') }}</label>
                                                        <input type="email" class="form-control" name="email"
                                                            value="{{ Auth::user()->email }}">
                                                        @if ($errors->has('email'))
                                                            <p class="m-1 text-danger">{{ $errors->first('email') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">{{ __('Username') }}</label>
                                                        <input type="text" class="form-control" name="username"
                                                            value="{{ Auth::user()->username }}">
                                                        @if ($errors->has('username'))
                                                            <p class="m-1 text-danger">{{ $errors->first('username') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">{{ __('Phone') }}</label>
                                                        <input type="text" class="form-control" name="phone"
                                                            value="{{ Auth::user()->phone }}">
                                                        @if ($errors->has('phone'))
                                                            <p class="m-1 text-danger">{{ $errors->first('phone') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">{{ __('Address') }}</label>
                                                        <input type="text" class="form-control" name="address"
                                                            value="{{ Auth::user()->address }}">
                                                        @if ($errors->has('address'))
                                                            <p class="m-1 text-danger">{{ $errors->first('address') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">{{ __('Country') }}</label>
                                                        <input type="text" class="form-control" name="country"
                                                            value="{{ Auth::user()->country }}">
                                                        @if ($errors->has('country'))
                                                            <p class="m-1 text-danger">{{ $errors->first('country') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">{{ __('State') }}</label>
                                                        <input type="text" class="form-control" name="state"
                                                            value="{{ Auth::user()->state }}">
                                                        @if ($errors->has('state'))
                                                            <p class="m-1 text-danger">{{ $errors->first('state') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">{{ __('City') }}</label>
                                                        <input type="text" class="form-control" name="city"
                                                            value="{{ Auth::user()->city }}">
                                                        @if ($errors->has('city'))
                                                            <p class="m-1 text-danger">{{ $errors->first('city') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="">{{ __('Zip Code') }}</label>
                                                        <input type="number" class="form-control" name="zipcode"
                                                            value="{{ Auth::user()->zipcode }}">
                                                        @if ($errors->has('zipcode'))
                                                            <p class="m-1 text-danger">{{ $errors->first('zipcode') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <button type="submit" class="os-btn os-btn-black">{{ __('Update') }} <i
                                                            class="far fa-paper-plane"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- User Dashboard End -->

    </main>
@endsection
