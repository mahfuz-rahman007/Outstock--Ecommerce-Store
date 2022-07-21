@extends('front.layout')

@section('content')
    <main>

        <!-- page title area start -->
        <section class="page__title p-relative d-flex align-items-center"
            data-background="{{ asset('assets/front/img/' . $commonsetting->breadcrumb_image) }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page__title-inner text-center">
                            <h1>{{ __('Change Password') }}</h1>
                            <div class="page__title-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                                        </li>

                                        <li class="breadcrumb-item" aria-current="page">
                                            {{ __('Change Password') }}
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
                                        <form action="{{ route('user.updatePassword', Auth::user()->id) }}" method="POST"
                                            >
                                            @csrf

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="">{{ __('Old Password') }}</label>
                                                        <input type="password" class="form-control" name="old_password"
                                                            value="" placeholder="Old Password">
                                                        @if ($errors->has('old_password'))
                                                            <p class="m-1 text-danger">{{ $errors->first('old_password') }}</p>
                                                        @else
                                                        @if ($errors->first('oldPassMatch'))
                                                            <span class="text-danger">
                                                                {{"Old password doesn't match with the existing password!"}}
                                                            </span>
                                                        @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="">{{ __('New Password') }}</label>
                                                        <input type="password" class="form-control" name="password"
                                                            value=""  placeholder="New Password">
                                                        @if ($errors->has('password'))
                                                            <p class="m-1 text-danger">{{ $errors->first('password') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="">{{ __('Confirm Password') }}</label>
                                                        <input type="password" class="form-control" name="password_confirmation"
                                                            value=""  placeholder="Confirm Password">
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
