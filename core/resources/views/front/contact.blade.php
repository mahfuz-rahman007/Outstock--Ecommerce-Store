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
                            <h1>{{ __('Contact') }}</h1>
                            <div class="page__title-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                                        </li>

                                        <li class="breadcrumb-item" aria-current="page">
                                            {{ __('Contact') }}
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

            <!-- contact area start -->
            <section class="contact__area pb-100 pt-95">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="contact__info">
                                <h3>Find us here.</h3>
                                <ul class="mb-55">
                                    <li class="d-flex mb-35">
                                        <div class="contact__info-icon mr-20">
                                            <i class="fal fa-map-marker-alt"></i>
                                        </div>
                                        <div class="contact__info-content">
                                            <h6>Address:</h6>
                                            <span>{{ $commonsetting->address }}</span>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-35">
                                        <div class="contact__info-icon mr-20">
                                            <i class="fal fa-envelope-open-text"></i>
                                        </div>
                                        <div class="contact__info-content">
                                            <h6>Email:</h6>
                                            @php
                                                $email = explode( ',', $commonsetting->email );
                                                for ($i=0; $i < count($email); $i++) {
                                                    echo '<span><a href="mailto:'.$email[$i].'">'.$email[$i].' , '.'</a></span>';
                                                }
                                            @endphp
                                        </div>
                                    </li>
                                    <li class="d-flex mb-35">
                                        <div class="contact__info-icon mr-20">
                                            <i class="fal fa-phone-alt"></i>
                                        </div>
                                        <div class="contact__info-content">
                                            <h6>Number Phone:</h6>
                                            @php
                                                $number = explode( ',', $commonsetting->number );
                                                for ($i=0; $i < count($number); $i++) {
                                                    echo '<span><a href="tel:'.$number[$i].'">'.$number[$i].' , '.'</a></span>';
                                                }
                                            @endphp
                                        </div>
                                    </li>
                                </ul>

                                <div class="contact__social">
                                    <ul>
                                        @foreach ($socials as $social)
                                            <li><a href="{{ $social->url }}"  target="_blank"><i class="fab {{ $social->icon }}"></i></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="contact__form">
                                <h3>Contact Us.</h3>
                                <form action="{{ route('front.contact.submit') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="contact__input">
                                                <label>Name <span class="required">*</span></label>
                                                <input type="text" name="name" placeholder="Name">
                                            </div>
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="contact__input">
                                                <label>Email <span class="required">*</span></label>
                                                <input type="email" name="email" placeholder="Email">
                                            </div>
                                            @if ($errors->has('email'))
                                                <p class="text-danger">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="contact__input">
                                                <label>Subject <span class="required">*</span></label>
                                                <input type="text" name="subject" placeholder="Subject">
                                            </div>
                                            @if ($errors->has('subject'))
                                                <p class="text-danger">{{ $errors->first('subject') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="contact__input">
                                                <label>Message <span class="required">*</span></label>
                                                <textarea cols="30" rows="5" name="message" placeholder="Message"></textarea>
                                            </div>
                                            @if ($errors->has('message'))
                                                <p class="text-danger">{{ $errors->first('message') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="contact__submit">
                                                <button type="submit" class="os-btn os-btn-black">Send Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- contact area end -->

            <!-- contact map area start -->
            <section class="contact__map">
                <div class="container-fluid p-0">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="contact__map-wrapper p-relative">
                                <iframe src="https://maps.google.com/maps?hl=en&amp;q=Dhaka+()&amp;ie=UTF8&amp;t=&amp;z=10&amp;iwloc=B&amp;output=embed"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- contact map area end -->

            <!-- subscribe area start -->
            <section class="subscribe__area pb-100">
                <div class="container">
                    <div class="subscribe__inner subscribe__inner-2 pt-95">
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                <div class="subscribe__content text-center">
                                    <h2>Get Discount Info</h2>
                                    <p>Subscribe to the Outstock mailing list to receive updates on new arrivals, special offers and other discount information.</p>
                                    <div class="subscribe__form">
                                        <form action="{{ route('front.newsletter.store') }}" method="POST">
                                            @csrf
                                            <input type="email" name="newsletter" placeholder="Subscribe to our newsletter...">
                                            <button type="submit" class="os-btn os-btn-2 os-btn-3">subscribe</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- subscribe area end -->
    </main>
@endsection

