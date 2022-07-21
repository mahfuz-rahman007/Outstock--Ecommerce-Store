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
                            <h1>{{ $product->title }}</h1>
                            <div class="page__title-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                                        </li>

                                        <li class="breadcrumb-item" aria-current="page">
                                            <a href="{{ route('front.products') }}">{{ __('Shop') }}</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>

                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page title area end -->

        <!-- shop details area start -->
        <section class="shop__area pb-65">
                        <div class="shop__top grey-bg-6 pt-100 pb-90">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="product__modal-box d-flex">
                                            <div class="product__modal-nav mr-20">
                                                <nav>
                                                    <div class="nav nav-tabs" id="product-details" role="tablist">
                                                        <a class="nav-item nav-link active" id="pro-one-tab" data-toggle="tab" href="#pro-one" role="tab" aria-controls="pro-one" aria-selected="true">
                                                        <div class="product__nav-img w-img">
                                                            <img src="{{ asset('assets/front/img/shop/product/details/details-sm-1.jpg') }}" alt="">
                                                        </div>
                                                        </a>
                                                        <a class="nav-item nav-link" id="pro-two-tab" data-toggle="tab" href="#pro-two" role="tab" aria-controls="pro-two" aria-selected="false">
                                                        <div class="product__nav-img w-img">
                                                            <img src="{{ asset('assets/front/img/shop/product/details/details-sm-2.jpg') }}" alt="">
                                                        </div>
                                                        </a>
                                                        <a class="nav-item nav-link" id="pro-three-tab" data-toggle="tab" href="#pro-three" role="tab" aria-controls="pro-three" aria-selected="false">
                                                        <div class="product__nav-img w-img">
                                                            <img src="{{ asset('assets/front/img/shop/product/details/details-sm-3.jpg') }}" alt="">
                                                        </div>
                                                        </a>
                                                    </div>
                                                </nav>
                                            </div>
                                            <div class="tab-content mb-20" id="product-detailsContent">
                                                <div class="tab-pane fade show active" id="pro-one" role="tabpanel" aria-labelledby="pro-one-tab">
                                                    <div class="product__modal-img product__thumb w-img">
                                                        <img src="{{ asset('assets/front/img/shop/product/details/details-big-1.jpg') }}" alt="">
                                                        <div class="product__sale ">
                                                            <span class="new">new</span>
                                                            <span class="percent">-16%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pro-two" role="tabpanel" aria-labelledby="pro-two-tab">
                                                    <div class="product__modal-img product__thumb w-img">
                                                        <img src="{{ asset('assets/front/img/shop/product/details/details-big-2.jpg') }}" alt="">
                                                        <div class="product__sale ">
                                                            <span class="new">new</span>
                                                            <span class="percent">-16%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pro-three" role="tabpanel" aria-labelledby="pro-three-tab">
                                                    <div class="product__modal-img product__thumb w-img">
                                                        <img src="{{ asset('assets/front/img/shop/product/details/details-big-3.jpg') }}" alt="">
                                                        <div class="product__sale ">
                                                            <span class="new">new</span>
                                                            <span class="percent">-16%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="product__modal-content product__modal-content-2">
                                            <h4><a href="product-details.html">{{ $product->title }}</a></h4>
                                            <div class="rating rating-shop mb-15">
                                                <ul>
                                                    <li><span><i class="fas fa-star"></i></span></li>
                                                    <li><span><i class="fas fa-star"></i></span></li>
                                                    <li><span><i class="fas fa-star"></i></span></li>
                                                    <li><span><i class="fas fa-star"></i></span></li>
                                                    <li><span><i class="fal fa-star"></i></span></li>
                                                </ul>
                                                <span class="rating-no ml-10 rating-left">
                                                    3 rating(s)
                                                </span>
                                                <span class="review rating-left"><a href="#">Add your Review</a></span>
                                            </div>
                                            <div class="product__price-2 mb-25">
                                                <span>{{ Helper::showCurrencyPrice($product->current_price) }}</span>
                                                @if($product->previous_price != '0')
                                                <span class="old-price">{{ Helper::showCurrencyPrice($product->previous_price) }}</span>
                                                @endif
                                            </div>
                                            <div class="product__modal-des mb-30">
                                                <p>{{ $product->short_description }}</p>
                                            </div>
                                            <div class="product__modal-form mb-30">
                                                <form action="#">
                                                    <div class="pro-quan-area d-sm-flex align-items-center">
                                                        <div class="product-quantity-title">
                                                            <label>Quantity</label>
                                                        </div>
                                                        <div class="product-quantity mr-20 mb-20">
                                                            <div class="cart-plus-minus"><input type="text" value="1" /></div>
                                                        </div>
                                                        <div class="pro-cart-btn">
                                                            <a href="#" class="add-cart-btn mb-20">+ Add to Cart</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="product__tag mb-25">
                                                <span>Category :</span>
                                                <span><a href="{{ route('front.products',['pcategory'=> $product->productcategory->slug , 'psubcategory'=>$product->productsubcategory->slug]) }}">{{ $product->productcategory->name }} , </a></span>

                                                <span><a href="{{ route('front.products',['pcategory'=> $product->productcategory->slug , 'psubcategory'=>$product->productsubcategory->slug]) }}">{{ $product->productsubcategory->name }}</a></span>
                                            </div>
                                            <div class="product__share">
                                                <span>Share :</span>
                                                <ul>
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shop__bottom">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="product__details-tab">
                                            <div class="product__details-tab-nav text-center mb-45">
                                                <nav>
                                                    <div class="nav nav-tabs justify-content-start justify-content-sm-center" id="pro-details" role="tablist">
                                                        <a class="nav-item nav-link active" id="des-tab" data-toggle="tab" href="#des" role="tab" aria-controls="des" aria-selected="true">{{ __('Description') }}</a>
                                                        <a class="nav-item nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">{{ __("Reviews ") }} (4)</a>
                                                    </div>
                                                </nav>
                                            </div>
                                            <div class="tab-content" id="pro-detailsContent">
                                                <div class="tab-pane fade show active" id="des" role="tabpanel">
                                                    {!! $product->description !!}
                                                </div>
                                                <div class="tab-pane fade" id="review" role="tabpanel">
                                                    <div class="product__details-review">
                                                        <div class="postbox__comments">
                                                            <div class="postbox__comment-title mb-30">
                                                                <h3>Reviews (32)</h3>
                                                            </div>
                                                            <div class="latest-comments mb-30">
                                                                <ul>
                                                                    <li>
                                                                        <div class="comments-box">
                                                                            <div class="comments-avatar">
                                                                                <img src="{{ asset('assets/front/img/blog/comments/avater-1.png') }}" alt="">
                                                                            </div>
                                                                            <div class="comments-text">
                                                                                <div class="avatar-name">
                                                                                    <h5>Siarhei Dzenisenka</h5>
                                                                                    <span> - 3 months ago </span>
                                                                                    <a class="reply" href="#">Leave Reply</a>
                                                                                </div>
                                                                                <div class="user-rating">
                                                                                    <ul>
                                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                                    </ul>
                                                                                </div>
                                                                                <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for <span>“lorem ipsum”</span> will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose.</p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="children">
                                                                        <div class="comments-box">
                                                                            <div class="comments-avatar">
                                                                                <img src="{{ asset('assets/front/img/blog/comments/avater-2.png') }}" alt="">
                                                                            </div>
                                                                            <div class="comments-text">
                                                                                <div class="avatar-name">
                                                                                    <h5>Julias Roy</h5>
                                                                                    <span> - 6 months ago </span>
                                                                                    <a class="reply" href="#">Leave Reply</a>
                                                                                </div>
                                                                                <div class="user-rating">
                                                                                    <ul>
                                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                                    </ul>
                                                                                </div>
                                                                                <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for <span>“lorem ipsum”</span> will uncover many web sites still in their infancy. </p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="comments-box">
                                                                            <div class="comments-avatar">
                                                                                <img src="{{ asset('assets/front/img/blog/comments/avater-3.png') }}" alt="">
                                                                            </div>
                                                                            <div class="comments-text">
                                                                                <div class="avatar-name">
                                                                                    <h5>Arista Williamson</h5>
                                                                                    <span> - 6 months ago </span>
                                                                                    <a class="reply" href="#">Leave Reply</a>
                                                                                </div>
                                                                                <div class="user-rating">
                                                                                    <ul>
                                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                                        <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                                    </ul>
                                                                                </div>
                                                                                <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for <span>“lorem ipsum”</span> will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose.</p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="post-comments-form mb-100">
                                                            <div class="post-comments-title mb-30">
                                                                <h3>Your Review</h3>
                                                                <div class="post-rating">
                                                                    <span>Your Rating :</span>
                                                                    <ul>
                                                                        <li>
                                                                            <a href="#">
                                                                                <i class="fal fa-star"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#">
                                                                                <i class="fal fa-star"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#">
                                                                                <i class="fal fa-star"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#">
                                                                                <i class="fal fa-star"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#">
                                                                                <i class="fal fa-star"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <form id="contacts-form" class="conatct-post-form" action="#">
                                                                <div class="row">
                                                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                                                        <div class="contact-icon p-relative contacts-name">
                                                                            <input type="text" placeholder="Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                                                        <div class="contact-icon p-relative contacts-name">
                                                                            <input type="email" placeholder="Email">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-12">
                                                                        <div class="contact-icon p-relative contacts-email">
                                                                            <input type="text" placeholder="Subject">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-12">
                                                                        <div class="contact-icon p-relative contacts-message">
                                                                            <textarea name="comments" id="comments" cols="30" rows="10"
                                                                                placeholder="Comments"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-12">
                                                                        <button class="os-btn os-btn-black" type="submit">Post comment</button>
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
        </section>
        <!-- shop details area end -->

        <!-- related products area start -->
        <section class="related__product pb-60">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="section__title-wrapper text-center mb-55">
                                        <div class="section__title mb-10">
                                            <h2>Trending Products</h2>
                                        </div>
                                        <div class="section__sub-title">
                                            <p>Mirum est notare quam littera gothica quam nunc putamus parum claram!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($popular_products as $popular_product)
                                    <div class="col-md-3 col-sm-2 product__item">
                                        <div class="product__wrapper mb-60">
                                            <div class="product__thumb">
                                                <a href="{{ route('front.product_details', $product->slug) }}" class="w-img">
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
                                                    <h4><a href="{{ route('front.product_details', $product->slug) }}">{{ $popular_product->title }}</a></h4>
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
        </section>
        <!-- related products area end -->


    </main>
@endsection

