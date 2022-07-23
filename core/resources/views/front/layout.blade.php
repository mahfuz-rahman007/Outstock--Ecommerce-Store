<!doctype html>
<html class="no-js" lang="zxx">

<!-- Mirrored from themepure.net/template/outstock-prv/outstock/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 Jun 2022 14:49:45 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $setting->website_title }} </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href=" {{ asset('assets/front/img/'.$commonsetting->fav_icon) }}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/fontAwesome5Pro.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/ui-range-slider.css') }}">
     <!-- Sweetalert2 css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
</head>

<body {{ Session::has('notification') ? 'data-notification' : '' }} @if(Session::has('notification')) data-notification-message='{{ json_encode(Session::get('notification')) }} @endif'>

    <!-- Add your site or application content here -->

    <!-- prealoder area start -->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="first_object"></div>
                <div class="object" id="second_object"></div>
                <div class="object" id="third_object"></div>
            </div>
        </div>
    </div>
    <!-- prealoder area end -->

    <!-- header area start -->
    <header>
        <div id="header-sticky" class="header__area grey-bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4">
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('assets/front/img/'.$commonsetting->header_logo) }}"
                                    alt="logo"></a>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8">
                        <div class="header__right p-relative d-flex justify-content-between align-items-center">
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul>
                                        <li class="active">
                                            <a href="{{ route('front.index') }}">Home</a>
                                        </li>
                                        <li class="mega-menu">
                                            <a href="{{ route('front.products') }}">Shop</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('front.contact') }}">Contact</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="mobile-menu-btn d-lg-none">
                                <a href="javascript:void(0);" class="mobile-menu-toggle"><i class="fas fa-bars"></i></a>
                            </div>
                            <div class="header__action">
                                <ul>
                                    <li><a href="#" class="search-toggle"><i class="ion-ios-search-strong"></i>
                                            Search</a></li>
                                    <li><a href="javascript:void(0);" class="cart"><i class="ion-bag"></i> Cart
                                            <span>(01)</span></a>
                                        <div class="mini-cart">
                                            <div class="mini-cart-inner">
                                                <ul class="mini-cart-list">
                                                    <li>
                                                        <div class="cart-img f-left">
                                                            <a href="product-details.html">
                                                                <img src="{{ asset('assets/front/img/shop/product/cart-sm/16.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="cart-content f-left text-left">
                                                            <h5>
                                                                <a href="product-details.html">Consectetur adi </a>
                                                            </h5>
                                                            <div class="cart-price">
                                                                <span class="ammount">1 <i
                                                                        class="fal fa-times"></i></span>
                                                                <span class="price">$ 400</span>
                                                            </div>
                                                        </div>
                                                        <div class="del-icon f-right mt-30">
                                                            <a href="#">
                                                                <i class="fal fa-times"></i>
                                                            </a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="cart-img f-left">
                                                            <a href="product-details.html">
                                                                <img src="{{ asset('assets/front/img/shop/product/cart-sm/17.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="cart-content f-left text-left">
                                                            <h5>
                                                                <a href="product-details.html">Wooden container Bowl
                                                                </a>
                                                            </h5>
                                                            <div class="cart-price">
                                                                <span class="ammount">1 <i
                                                                        class="fal fa-times"></i></span>
                                                                <span class="price">$ 400</span>
                                                            </div>
                                                        </div>
                                                        <div class="del-icon f-right mt-30">
                                                            <a href="#">
                                                                <i class="fal fa-times"></i>
                                                            </a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="cart-img f-left">
                                                            <a href="product-details.html">
                                                                <img src="{{ asset('assets/front/img/shop/product/cart-sm/18.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="cart-content f-left text-left">
                                                            <h5>
                                                                <a href="product-details.html">Black White Towel </a>
                                                            </h5>
                                                            <div class="cart-price">
                                                                <span class="ammount">1 <i
                                                                        class="fal fa-times"></i></span>
                                                                <span class="price">$ 400</span>
                                                            </div>
                                                        </div>
                                                        <div class="del-icon f-right mt-30">
                                                            <a href="#">
                                                                <i class="fal fa-times"></i>
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="total-price d-flex justify-content-between mb-30">
                                                    <span>Subtotal:</span>
                                                    <span>$400.0</span>
                                                </div>
                                                <div class="checkout-link">
                                                    <a href="cart.html" class="os-btn">view Cart</a>
                                                    <a class="os-btn os-btn-black" href="checkout.html">Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li> <a href="javascript:void(0);"><i class="far fa-bars"></i></a>
                                        <ul class="extra-info">
                                            <li>
                                                <div class="my-account">
                                                    <div class="extra-title">
                                                        <h5>My Account</h5>
                                                    </div>
                                                    <ul>
                                                        @if(Auth::user())
                                                            <li><a href="{{ route('user.dashboard') }}">{{ Auth::user()->name }}</a></li>
                                                            <li><a href="wishlist.html">Wishlist</a></li>
                                                            <li><a href="cart.html">Cart</a></li>
                                                            <li><a href="checkout.html">Checkout</a></li>
                                                            <li><a href="{{ route('user.logout') }}">Logout</a></li>
                                                        @else
                                                            <li><a href="{{ route('user.login') }}">My Account</a></li>
                                                            <li><a href="{{ route('user.login') }}">Wishlist</a></li>
                                                            <li><a href="{{ route('user.login') }}">Cart</a></li>
                                                            <li><a href="{{ route('user.login') }}">Checkout</a></li>
                                                            <li><a href="{{ route('user.register') }}">Create Account</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="lang">
                                                    <div class="extra-title">
                                                        <h5>Language</h5>
                                                    </div>
                                                    <ul>
                                                        @foreach ($langs as $lang)
                                                        <li><a href="{{ route('changeLanguage',$lang->code) }}">{{ $lang->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="currency">
                                                    <div class="extra-title">
                                                        <h5>currency</h5>
                                                    </div>
                                                    <ul>
                                                        <li><a href="#">USD - US Dollar</a></li>
                                                        <li><a href="#">EUR - Ruro</a></li>
                                                        <li><a href="#">GBP - Britis Pound</a></li>
                                                        <li><a href="#">INR - Indian Rupee</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->

    <!-- scroll up area start -->
    <div class="scroll-up" id="scroll" style="display: none;">
        <a href="javascript:void(0);"><i class="fas fa-level-up-alt"></i></a>
    </div>
    <!-- scroll up area end -->

    <!-- search area start -->
    <section class="header__search white-bg transition-3">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="header__search-inner text-center">
                        <form action="#">
                            <div class="header__search-btn">
                                <a href="javascript:void(0);" class="header__search-btn-close"><i
                                        class="fal fa-times"></i></a>
                            </div>
                            <div class="header__search-header">
                                <h3>Search</h3>
                            </div>
                            <div class="header__search-input p-relative">
                                <input type="text" placeholder="Search for products... ">
                                <button type="submit"><i class="far fa-search"></i></button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="body-overlay transition-3"></div>
    <!-- search area end -->

    {{-- main Area --}}
    @yield('content')

    <!-- footer area start -->
    <section class="footer__area footer-bg">
        <div class="footer__top pt-100 pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <div class="footer__widget mb-30">
                            <div class="footer__widget-title mb-25">
                                <a href="index.html"><img src="{{ asset('assets/front/img/logo/logo-2.png') }}"
                                        alt="logo"></a>
                            </div>
                            <div class="footer__widget-content">
                                <p>{{ $commonsetting->footer_text }}</p>
                                <div class="footer__contact">
                                    <ul>
                                        <li>
                                            <div class="icon">
                                                <i class="fal fa-map-marker-alt"></i>
                                            </div>
                                            <div class="text">
                                                <span>Add: {{ $commonsetting->address }}</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <i class="fal fa-envelope-open-text"></i>
                                            </div>
                                            <div class="text">
                                                <span>Email:
                                                    @php
                                                        $email = explode( ',', $commonsetting->email );
                                                        for ($i=0; $i < count($email); $i++) {
                                                            echo '<span><a href="mailto:'.$email[$i].'">'.$email[$i].' , '.'</a></span>';
                                                        }
                                                    @endphp
                                                </span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <i class="fal fa-phone-alt"></i>
                                            </div>
                                            <div class="text">
                                                <span>Phone:
                                                @php
                                                    $number = explode( ',', $commonsetting->number );
                                                    for ($i=0; $i < count($number); $i++) {
                                                        echo '<span><a href="tel:'.$number[$i].'">'.$number[$i].' , '.'</a></span>';
                                                    }
                                                @endphp
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                        <div class="footer__widget mb-30">
                            <div class="footer__widget-title">
                                <h5>information</h5>
                            </div>
                            <div class="footer__widget-content">
                                <div class="footer__links">
                                    <ul>
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Careers</a></li>
                                        <li><a href="#">Delivery Inforamtion</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">Terms & Condition</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                        <div class="footer__widget mb-30">
                            <div class="footer__widget-title mb-25">
                                <h5>Customer Service</h5>
                            </div>
                            <div class="footer__widget-content">
                                <div class="footer__links">
                                    <ul>
                                        @foreach ($front_dynamic_pages as $page)
                                            <li><a href="{{ route('front.front_dynamic_page', $page->slug) }}">{{ $page->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-7">
                        <div class="footer__copyright">
                            <p>{!! $commonsetting->copyright_text !!}</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-5">
                        <div class="footer__social f-right">
                            <ul>
                                @foreach ($socials as $social)
                                    <li><a href="{{ $social->url }}" target="_blank"><i class="fab {{ $social->icon }}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer area end -->

    <!-- JS here -->
    <script src="{{ asset('assets/front/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/vendor/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery-ui-slider-range.js') }}"></script>
    <script src="{{ asset('assets/front/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/front/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- Sweetalert2 js -->
    <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/main.js') }}"></script>

    @yield('scripts')
</body>

<!-- Mirrored from themepure.net/template/outstock-prv/outstock/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 Jun 2022 14:50:16 GMT -->

</html>
