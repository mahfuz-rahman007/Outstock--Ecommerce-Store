@extends('front.layout')

@section('content')


<main>
    <!-- slider area start -->
    <section class="slider__area p-relative">
        <div class="slider-active">
            @foreach ($sliders as $slider)
                <div class="single-slider slider__height d-flex align-items-center"
                    data-background="{{ asset('assets/front/img/slider/'.$slider->image) }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10 col-12">
                                <div class="slider__content">
                                    <h2 data-animation="fadeInUp" data-delay=".2s">{{ $slider->title }}
                                    </h2>
                                    <p data-animation="fadeInUp" data-delay=".4s">{{ $slider->text }} </p>
                                    <a href="{{ route('front.products') }}" class="os-btn os-btn-2" data-animation="fadeInUp"
                                        data-delay=".6s">{{ $slider->button_text }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </section>
    <!-- slider area end -->

    <!-- product area start -->
    <section class="product__area pt-60 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section__title-wrapper text-center mb-55">
                        <div class="section__title mb-10">
                            <h2>{{ __('Teanding Products') }}</h2>
                        </div>
                        <div class="section__sub-title">
                            <p>{{ __('Mirum est notare quam littera gothica quam nunc putamus parum claram!') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        @foreach ($popular_products as $popular_product)
                            <div class="col-md-3 col-sm-2 product__item">
                                <div class="product__wrapper mb-60">
                                    <div class="product__thumb">
                                        <a href="{{ route('front.product_details', $popular_product->slug) }}" class="w-img">
                                            <img src="{{ asset('assets/front/img/'.$popular_product->image) }}"
                                                alt="product-img">
                                        </a>
                                        <div class="product__action transition-3">
                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                title="Add to Wishlist">
                                                <i class="fal fa-heart"></i>
                                            </a>
                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                title="Compare">
                                                <i class="fal fa-sliders-h"></i>
                                            </a>
                                            <!-- Button trigger modal -->
                                            <a href="#" data-toggle="modal" data-target="#productModalId">
                                                <i class="fal fa-search"></i>
                                            </a>
                                        </div>
                                        @if($popular_product->is_featured == 1)
                                        <div class="product__featured">
                                            <span>Featured</span>
                                        </div>
                                        @endif
                                        <div class="product__sale">
                                            @if(Helper::newProduct($popular_product->created_at))
                                            <span class="new">new</span>
                                            @endif
                                            @if($popular_product->previous_price != '0')
                                            <span class="percent">{{ Helper::discountPercentage($popular_product->current_price , $popular_product->previous_price) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product__content p-relative">
                                        <div class="product__content-inner">
                                            <h4><a href="{{ route('front.product_details', $popular_product->slug) }}">{{ $popular_product->title }}</a></h4>
                                            <div class="product__price transition-3">
                                                <span>{{ Helper::showCurrencyPrice($popular_product->current_price) }}</span>
                                                @if($popular_product->previous_price != '0')
                                                <span class="old-price">{{ Helper::showCurrencyPrice($popular_product->previous_price) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="add-cart p-absolute transition-3">
                                            <a href="#">{{ __('+ Add to Cart') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="product__load-btn text-center mt-25">
                        <a href="{{ route('front.products') }}" class="os-btn os-btn-3">Load More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product area end -->

    <!-- banner area start -->
    <div class="banner__area-2 pb-60">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-xl-6 col-lg-6">
                    <div class="banner__item-2 banner-right p-relative mb-30 pr-15">
                        <div class="banner__thumb fix">
                            <a href="product-details.html" class="w-img"><img
                                    src="{{ asset('assets/front/img/shop/banner/banner-big-1.jpg') }}"
                                    alt="banner"></a>
                        </div>
                        <div class="banner__content-2 p-absolute transition-3">
                            <span>Products Essentials</span>
                            <h4><a href="product-details.html">Bottle With Wooden Cork</a></h4>
                            <p>Mirum est notare quam littera gothica, quam nunc putamus <br> parum claram,
                                anteposuerit litterarum formas.</p>
                            <a href="product-details.html" class="os-btn os-btn-2">buy now /
                                <span>$59.25</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class=" banner__item-2 banner-left p-relative mb-30 pl-15">
                        <div class="banner__thumb fix">
                            <a href="product-details.html" class="w-img"><img
                                    src="{{ asset('assets/front/img/shop/banner/banner-big-2.jpg') }}"
                                    alt="banner"></a>
                        </div>
                        <div class="banner__content-2 banner__content-2-right p-absolute transition-3">
                            <span>Products Furniture</span>
                            <h4><a href="product-details.html">Hauteville Plywood Chair</a></h4>
                            <p>Mirum est notare quam littera gothica, quam nunc putamus <br> parum claram,
                                anteposuerit litterarum formas.</p>
                            <a href="product-details.html" class="os-btn os-btn-2">buy now /
                                <span>$396.99</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner area end -->

    <!-- sale off area start -->
    <section class="sale__area pb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section__title-wrapper text-center mb-55">
                        <div class="section__title mb-10">
                            <h2>{{ __('Sale Off') }}</h2>
                        </div>
                        <div class="section__sub-title">
                            <p>{{ __('Mirum est notare quam littera gothica quam nunc putamus parum claram!') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="sale__area-slider owl-carousel">
                        @foreach ($discount_products as $discount_product)
                            <div class="sale__item">
                                <div class="product__wrapper mb-60">
                                    <div class="product__thumb">
                                        <a href="{{ route('front.product_details', $discount_product->slug) }}" class="w-img">
                                            <img src="{{ asset('assets/front/img/'.$discount_product->image) }}"
                                                alt="product-img">
                                        </a>
                                        <div class="product__action transition-3">
                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                title="Add to Wishlist">
                                                <i class="fal fa-heart"></i>
                                            </a>
                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                title="Compare">
                                                <i class="fal fa-sliders-h"></i>
                                            </a>
                                        </div>
                                        @if($discount_product->is_featured == 1)
                                        <div class="product__featured">
                                            <span>Featured</span>
                                        </div>
                                        @endif
                                        <div class="product__sale">
                                            @if(Helper::newProduct($discount_product->created_at))
                                            <span class="new">new</span>
                                            @endif
                                            @if($discount_product->previous_price != '0')
                                            <span class="percent">{{ Helper::discountPercentage($discount_product->current_price , $discount_product->previous_price) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product__content p-relative">
                                        <div class="product__content-inner">
                                            <h4><a href="{{ route('front.product_details', $discount_product->slug) }}">{{ $discount_product->title }}</a></h4>
                                            <div class="product__price transition-3">
                                                <span>{{ Helper::showCurrencyPrice($discount_product->current_price) }}</span>
                                                @if($discount_product->previous_price != '0')
                                                <span class="old-price">{{ Helper::showCurrencyPrice($discount_product->previous_price) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="add-cart p-absolute transition-3">
                                            <a href="#">{{ __('+ Add to Cart') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sale off area end -->

    <!-- client slider area start -->
    <section class="client__area pt-15 pb-140">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="client__slider owl-carousel text-center">
                        @foreach ($clients as $client)
                        <div class="client__thumb">
                            <a href="#"><img src="{{ asset('assets/front/img/'.$client->image) }}"
                                    alt="client"></a>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- client slider area end -->


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


    <!-- shop modal start -->
    <!-- Modal -->
    <div class="modal fade" id="productModalId" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered product-modal" role="document">
            <div class="modal-content">
                <div class="product__modal-wrapper p-relative">
                    <div class="product__modal-close p-absolute">
                        <button data-dismiss="modal"><i class="fal fa-times"></i></button>
                    </div>
                    <div class="product__modal-inner">
                        <div class="row">
                            <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                <div class="product__modal-box">
                                    <div class="tab-content mb-20" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                            aria-labelledby="nav-home-tab">
                                            <div class="product__modal-img w-img">
                                                <img src="{{ asset('assets/front/img/shop/product/quick-view/quick-big-1.jpg') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                            aria-labelledby="nav-profile-tab">
                                            <div class="product__modal-img w-img">
                                                <img src="{{ asset('assets/front/img/shop/product/quick-view/quick-big-2.jpg') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                            aria-labelledby="nav-contact-tab">
                                            <div class="product__modal-img w-img">
                                                <img src="{{ asset('assets/front/img/shop/product/quick-view/quick-big-3.jpg') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <nav>
                                        <div class="nav nav-tabs justify-content-between" id="nav-tab"
                                            role="tablist">
                                            <a class="nav-item nav-link active" id="nav-home-tab"
                                                data-toggle="tab" href="#nav-home" role="tab"
                                                aria-controls="nav-home" aria-selected="true">
                                                <div class="product__nav-img w-img">
                                                    <img src="{{ asset('assets/front/img/shop/product/quick-view/quick-sm-1.jpg') }}"
                                                        alt="">
                                                </div>
                                            </a>
                                            <a class="nav-item nav-link" id="nav-profile-tab"
                                                data-toggle="tab" href="#nav-profile" role="tab"
                                                aria-controls="nav-profile" aria-selected="false">
                                                <div class="product__nav-img w-img">
                                                    <img src="{{ asset('assets/front/img/shop/product/quick-view/quick-sm-2.jpg') }}"
                                                        alt="">
                                                </div>
                                            </a>
                                            <a class="nav-item nav-link" id="nav-contact-tab"
                                                data-toggle="tab" href="#nav-contact" role="tab"
                                                aria-controls="nav-contact" aria-selected="false">
                                                <div class="product__nav-img w-img">
                                                    <img src="{{ asset('assets/front/img/shop/product/quick-view/quick-sm-3.jpg') }}"
                                                        alt="">
                                                </div>
                                            </a>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12 col-12">
                                <div class="product__modal-content">
                                    <h4><a href="product-details.html">Wooden container Bowl</a></h4>
                                    <div class="rating rating-shop mb-15">
                                        <ul>
                                            <li><span><i class="fas fa-star"></i></span></li>
                                            <li><span><i class="fas fa-star"></i></span></li>
                                            <li><span><i class="fas fa-star"></i></span></li>
                                            <li><span><i class="fas fa-star"></i></span></li>
                                            <li><span><i class="fal fa-star"></i></span></li>
                                        </ul>
                                        <span class="rating-no ml-10">
                                            3 rating(s)
                                        </span>
                                    </div>
                                    <div class="product__price-2 mb-25">
                                        <span>$96.00</span>
                                        <span class="old-price">$96.00</span>
                                    </div>
                                    <div class="product__modal-des mb-30">
                                        <p>Claritas est etiam processus dynamicus, qui sequitur mutationem
                                            consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc
                                            putamus parum claram.</p>
                                    </div>
                                    <div class="product__modal-form">
                                        <form action="#">
                                            <div class="product__modal-input size mb-20">
                                                <label>Size <i class="fas fa-star-of-life"></i></label>
                                                <select>
                                                    <option>- Please select -</option>
                                                    <option> S</option>
                                                    <option> M</option>
                                                    <option> L</option>
                                                    <option> XL</option>
                                                    <option> XXL</option>
                                                </select>
                                            </div>
                                            <div class="product__modal-input color mb-20">
                                                <label>Color <i class="fas fa-star-of-life"></i></label>
                                                <select>
                                                    <option>- Please select -</option>
                                                    <option> Black</option>
                                                    <option> Yellow</option>
                                                    <option> Blue</option>
                                                    <option> White</option>
                                                    <option> Ocean Blue</option>
                                                </select>
                                            </div>
                                            <div class="product__modal-required mb-5">
                                                <span>Repuired Fiields *</span>
                                            </div>
                                            <div class="pro-quan-area d-lg-flex align-items-center">
                                                <div class="product-quantity-title">
                                                    <label>Quantity</label>
                                                </div>
                                                <div class="product-quantity">
                                                    <div class="cart-plus-minus"><input type="text"
                                                            value="1" /></div>
                                                </div>
                                                <div class="pro-cart-btn ml-20">
                                                    <a href="#"
                                                        class="os-btn os-btn-black os-btn-3 mr-10">+ Add to
                                                        Cart</a>
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
        </div>
    </div>
    <!-- shop modal end -->
</main>

@endsection
