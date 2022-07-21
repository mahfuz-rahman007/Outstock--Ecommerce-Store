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
                            <h1>{{ __('Register') }}</h1>
                            <div class="page__title-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                                        </li>

                                        <li class="breadcrumb-item" aria-current="page">
                                            {{ __('Register') }}
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
                                    <h3 class="text-center mb-60">Signup From Here</h3>
                                    <form action="{{ route('user.register.submit') }}" method="POST">
                                        @csrf
                                        <input id="name" type="text" name="name" placeholder="Enter Full Name" />
                                        @if($errors->has('name'))
                                            <p class="text-danger m-1">{{ $errors->first('name') }}</p>
                                        @endif

                                        <input id="username" type="text" name="username" placeholder="Enter Username" />
                                        @if($errors->has('username'))
                                            <p class="text-danger m-1">{{ $errors->first('username') }}</p>
                                        @endif

                                        <input id="email" type="mail" name="email" placeholder="Email address..." />
                                        @if($errors->has('email'))
                                            <p class="text-danger m-1">{{ $errors->first('email') }}</p>
                                        @endif

                                        <input id="phone" type="number" name="phone" placeholder="Phone Number" />
                                        @if($errors->has('phone'))
                                            <p class="text-danger m-1">{{ $errors->first('phone') }}</p>
                                        @endif

                                        <input id="address" type="text" name="address" placeholder="Enter Address" />
                                        @if($errors->has('address'))
                                            <p class="text-danger m-1">{{ $errors->first('zipaddresscode') }}</p>
                                        @endif

                                        <input id="country" type="text" name="country" placeholder="Enter Country" />
                                        @if($errors->has('country'))
                                            <p class="text-danger m-1">{{ $errors->first('country') }}</p>
                                        @endif

                                        <input id="state" type="text" name="state" placeholder="Enter State" />
                                        @if($errors->has('state'))
                                            <p class="text-danger m-1">{{ $errors->first('state') }}</p>
                                        @endif

                                        <input id="city" type="text" name="city" placeholder="Enter City" />
                                        @if($errors->has('city'))
                                            <p class="text-danger m-1">{{ $errors->first('city') }}</p>
                                        @endif

                                        <input id="zipcode" type="number" name="zipcode" placeholder="Enter Zipcode" />
                                        @if($errors->has('zipcode'))
                                            <p class="text-danger m-1">{{ $errors->first('zipcode') }}</p>
                                        @endif

                                        <input id="password" type="password" name="password" placeholder="Enter password..." />
                                        @if($errors->has('password'))
                                            <p class="text-danger m-1">{{ $errors->first('password') }}</p>
                                        @endif

                                        <input id="password" type="password" name="password_confirmation" placeholder="Confirm password..." />

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

                                        <div class="mt-10"></div>
                                        <button class="os-btn w-100" type="submit">Register Now</button>
                                        <div class="or-divide"><span>or</span></div>
                                        <a href="{{ route('user.login') }}" class="os-btn os-btn-black w-100">login Now</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>
        <!-- login Area End-->


    </main>
@endsection
