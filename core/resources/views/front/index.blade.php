@extends('front.layout')

@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")

@section('content')


<main>
    @if ($commonsetting->is_hero_section == 1)
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
    @endif

    @if ($commonsetting->is_trending_section == 1)
    <!-- product area start -->
    <section class="product__area pt-60 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section__title-wrapper text-center mb-55">
                        <div class="section__title mb-10">
                            <h2>{{ $sectiontitle->trending_product_title }}</h2>
                        </div>
                        <div class="section__sub-title">
                            <p>{{ $sectiontitle->trending_product_sub_title }}</p>
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
                                            @if (Auth::user())
                                                @if ( Helper::isWishlist($popular_product->id) )
                                                    <a href="javascript:;" class="active"  id="remove_wishlist" data-add="{{ route('front.product.add.wishlist', $popular_product->slug) }}" data-remove="{{ route('front.product.remove.wishlist',  $product->slug) }}" data-href="{{ route('front.product.remove.wishlist',  $popular_product->slug) }}" data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('Remove From Wishlist') }}">
                                                        <i class="fas fa-heart"></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:;" data-href="{{ route('front.product.add.wishlist', $popular_product->slug) }}" data-remove="{{ route('front.product.remove.wishlist',  $popular_product->slug) }}" data-add="{{ route('front.product.add.wishlist', $popular_product->slug) }}" id="add_wishlist" data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('Add to Wishlist') }}">
                                                        <i class="fas fa-heart"></i>
                                                    </a>
                                                @endif

                                            @else
                                                <a href="{{ route('user.login') }}"data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('Add to Wishlist') }}">
                                                    <i class="fal fa-heart"></i>
                                                </a>
                                            @endif

                                            <a href="{{ route('front.product.checkout', $popular_product->slug) }}" data-toggle="tooltip" data-placement="top"
                                                title="{{ __("Buy Now") }}">
                                                <i class="fal fa-shopping-cart"></i>
                                            </a>

                                        </div>
                                        @if($popular_product->is_featured == 1)
                                        <div class="product__featured">
                                            <span>Featured</span>
                                        </div>
                                        @endif
                                        <div class="product__sale">
                                            @if(Helper::newProduct($popular_product->created_at))
                                            <span class="new">{{ __('New') }}</span>
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
                                            @if(Auth::user())
                                            <a href="javascript:;" data-href="{{ route('front.product.add_cart',$popular_product->id) }}" id="add_cart">{{ __('+ Add to Cart') }}</a>
                                            @else
                                            <a href="{{ route('user.login') }}" >{{ __('+ Add to Cart') }}</a>
                                            @endif
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
                        <a href="{{ route('front.products') }}" class="os-btn os-btn-3">{{ __('Load More') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product area end -->
    @endif

    @if ($commonsetting->is_ebanner_section == 1)
    <!-- banner area start -->
    <div class="banner__area-2 pb-60">
        <div class="container-fluid p-0">
            <div class="row no-gutters">

                @foreach ($ebanners as $ebanner)
                    <div class="col-xl-6 col-lg-6">
                        <div class="banner__item-2 banner-right p-relative mb-30 pr-15">
                            <div class="banner__thumb fix">
                                <a href="{{ route('front.products') }}" class="w-img"><img
                                        src="{{ asset('assets/front/img/slider/'.$ebanner->image) }}"
                                        alt="banner"></a>
                            </div>
                            <div class="banner__content-2 p-absolute transition-3">
                                <span>{{ $ebanner->productcategory->name }}</span>
                                <h4><a href="{{ route('front.products') }}">{{ $ebanner->title }}</a></h4>

                                <a href="{{ route('front.products') }}" class="os-btn os-btn-2">{{ $ebanner->button_text }} /
                                    {{ Helper::showCurrencyPrice($ebanner->price) }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- banner area end -->
    @endif


    @if ($commonsetting->is_product_section == 1)
    <!-- sale off area start -->
    <section class="sale__area pb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section__title-wrapper text-center mb-55">
                        <div class="section__title mb-10">
                            <h2>{{  $sectiontitle->product_title }}</h2>
                        </div>
                        <div class="section__sub-title">
                            <p>{{ $sectiontitle->product_sub_title }}</p>
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
                                            @if (Auth::user())
                                                @if ( Helper::isWishlist($discount_product->id) )
                                                    <a href="javascript:;" class="active"  id="remove_wishlist" data-add="{{ route('front.product.add.wishlist', $discount_product->slug) }}" data-remove="{{ route('front.product.remove.wishlist',  $discount_product->slug) }}" data-href="{{ route('front.product.remove.wishlist',  $discount_product->slug) }}" data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('Remove From Wishlist') }}">
                                                        <i class="fas fa-heart"></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:;" data-href="{{ route('front.product.add.wishlist', $discount_product->slug) }}" data-remove="{{ route('front.product.remove.wishlist',  $discount_product->slug) }}" data-add="{{ route('front.product.add.wishlist', $discount_product->slug) }}" id="add_wishlist" data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('Add to Wishlist') }}">
                                                        <i class="fas fa-heart"></i>
                                                    </a>
                                                @endif

                                            @else
                                                <a href="{{ route('user.login') }}"data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('Add to Wishlist') }}">
                                                    <i class="fal fa-heart"></i>
                                                </a>
                                            @endif

                                            <a href="{{ route('front.product.checkout', $discount_product->slug) }}" data-toggle="tooltip" data-placement="top"
                                                title="{{ __("Buy Now") }}">
                                                <i class="fal fa-shopping-cart"></i>
                                            </a>

                                        </div>
                                        @if($discount_product->is_featured == 1)
                                        <div class="product__featured">
                                            <span>Featured</span>
                                        </div>
                                        @endif
                                        <div class="product__sale">
                                            @if(Helper::newProduct($discount_product->created_at))
                                            <span class="new">{{ __('New') }}</span>
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
                                            @if(Auth::user())
                                            <a href="javascript:;" data-href="{{ route('front.product.add_cart',$discount_product->id) }}" id="add_cart">{{ __('+ Add to Cart') }}</a>
                                            @else
                                            <a href="{{ route('user.login') }}" >{{ __('+ Add to Cart') }}</a>
                                            @endif
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
    @endif


    @if ($commonsetting->is_client_section == 1)
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
    @endif


    @if ($commonsetting->is_newsletter_section == 1)
        <!-- subscribe area start -->
        <section class="subscribe__area pb-100">
                <div class="container">
                    <div class="subscribe__inner subscribe__inner-2 pt-95">
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                <div class="subscribe__content text-center">
                                    <h2>{{ $sectiontitle->newsletter_title }}</h2>
                                    <p>{{ $sectiontitle->newsletter_sub_title }}</p>
                                    <div class="subscribe__form">
                                        <form action="{{ route('front.newsletter.store') }}" method="POST">
                                            @csrf
                                            <input type="email" name="newsletter" placeholder="{{ __('Subscribe to our newsletter...') }}">
                                            <button type="submit" class="os-btn os-btn-2 os-btn-3">{{ __('Subscribe') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- subscribe area end -->
    @endif



    <!-- shop modal start -->
</main>

@endsection
