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
                            <h1>{{ __('Login') }}</h1>
                            <div class="page__title-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                                        </li>

                                        <li class="breadcrumb-item" aria-current="page">
                                            {{ __('Login') }}
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

            <!-- login Area Strat-->
            <section class="login-area pt-100 pb-100">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="basic-login">
                                    <h3 class="text-center mb-60">Login From Here</h3>
                                    @if(Session::has('error'))
                                    <p class="mb-3 text-danger">{{ Session::get('error') }}</p>
                                    @endif

                                    @if(Session::has('success'))
                                    <p  class="mb-3 text-success">{{ Session::get('success') }}</p>
                                    @endif
                                    <form action="{{ route('user.login.submit') }}" method="POST">
                                        @csrf
                                        <label for="name">Email Address <span>**</span></label>
                                        <input id="name" type="email" name="email" placeholder="Email address..." />
                                        <label for="pass">Password <span>**</span></label>
                                        <input id="pass" type="password" name="password" placeholder="Enter password..." />
                                        <div class="login-action mb-20 fix">
                                            <span class="forgot-login f-right">
                                                <a href="#">Lost your password?</a>
                                            </span>
                                        </div>
                                        @if ($commonsetting->is_recaptcha == 1)
                                            <div class="d-block my-4">
                                                {!! NoCaptcha::renderJs() !!}
                                                {!! NoCaptcha::display() !!}
                                                @if ($errors->has('g-recaptcha-response'))
                                                @php
                                                    $errmsg = $errors->first('g-recaptcha-response');
                                                @endphp
                                                <p class="text-danger mb-0">{{__("$errmsg")}}</p>
                                                @endif
                                            </div>
                                        @endif
                                        <button class="os-btn w-100" type="submit">Login Now</button>
                                        <div class="or-divide"><span>or</span></div>
                                        <a href="{{ route('user.register') }}" class="os-btn os-btn-black w-100">Register Now</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <!-- login Area End-->

    </main>
@endsection
