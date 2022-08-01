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
                        <div class="col-xl-5 col-lg-5">
                            <div class="product__modal-box d-flex">
                                <div class="product__modal-nav mr-20">
                                    <nav>
                                        <div class="nav nav-tabs" id="product-details" role="tablist">
                                            <a class="nav-item nav-link active" id="pro-one-tab" data-toggle="tab"
                                                href="#pro-one" role="tab" aria-controls="pro-one" aria-selected="true">
                                                <div class="product__nav-img w-img">
                                                    <img src="{{ asset('assets/front/img/' . $product->image) }}"
                                                        alt="">
                                                </div>
                                            </a>
                                            <a class="nav-item nav-link" id="pro-two-tab" data-toggle="tab" href="#pro-two"
                                                role="tab" aria-controls="pro-two" aria-selected="false">
                                                <div class="product__nav-img w-img">
                                                    <img src="{{ asset('assets/front/img/shop/product/details/details-sm-1.jpg') }}"
                                                        alt="">
                                                </div>
                                            </a>
                                            <a class="nav-item nav-link" id="pro-three-tab" data-toggle="tab"
                                                href="#pro-three" role="tab" aria-controls="pro-three"
                                                aria-selected="false">
                                                <div class="product__nav-img w-img">
                                                    <img src="{{ asset('assets/front/img/shop/product/details/details-sm-1.jpg') }}"
                                                        alt="">
                                                </div>
                                            </a>
                                        </div>
                                    </nav>
                                </div>
                                <div class="tab-content mb-20" id="product-detailsContent">
                                    <div class="tab-pane fade show active" id="pro-one" role="tabpanel"
                                        aria-labelledby="pro-one-tab">
                                        <div class="product__modal-img product__thumb ">
                                            <img src="{{ asset('assets/front/img/' . $product->image) }}" alt="">
                                            @if ($product->is_featured == 1)
                                                <div class="product__featured">
                                                    <span>Featured</span>
                                                </div>
                                            @endif
                                            <div class="product__sale">
                                                @if (Helper::newProduct($product->created_at))
                                                    <span class="new">new</span>
                                                @endif
                                                @if ($product->previous_price != '0')
                                                    <span
                                                        class="percent">{{ Helper::discountPercentage($product->current_price, $product->previous_price) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pro-two" role="tabpanel" aria-labelledby="pro-two-tab">
                                        <div class="product__modal-img product__thumb w-img">
                                            <img src="{{ asset('assets/front/img/shop/product/details/details-big-2.jpg') }}"
                                                alt="">
                                            <div class="product__sale ">
                                                <span class="new">new</span>
                                                <span class="percent">-16%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pro-three" role="tabpanel"
                                        aria-labelledby="pro-three-tab">
                                        <div class="product__modal-img product__thumb w-img">
                                            <img src="{{ asset('assets/front/img/shop/product/details/details-big-3.jpg') }}"
                                                alt="">
                                            <div class="product__sale ">
                                                <span class="new">new</span>
                                                <span class="percent">-16%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7">
                            <div class="product__modal-content product__modal-content-2">
                                <h4><a href="product-details.html">{{ $product->title }}</a></h4>
                                <div class="rating rating-shop mb-15">
                                    @if ($avgrating)
                                        <ul class="text-center">
                                            @for ($i = 0; $i < $avgrating; $i++)
                                                <li><span><i class="fas fa-star"></i></span></li>
                                            @endfor
                                        </ul>
                                    @endif
                                    <span class="rating-no ml-10 rating-left">
                                        @if ($rating_count)
                                            {{ $rating_count }} rating ({{ $rating_count > 1 ? 's' : '' }})
                                        @else
                                            No rating(s)
                                        @endif
                                    </span>
                                    @if ($product->stock > 0)
                                    <span class="review rating-left"><strong class="text-success">In Stock <i class="fas fa-check-circle"></i></strong></span>

                                    @else
                                    <span class="review rating-left"><strong class="text-danger">Out Of Stock <i class="fas fa-times-circle"></i></strong></span>
                                    @endif
                                </div>
                                <div class="product__price-2 mb-25">
                                    <span>{{ Helper::showCurrencyPrice($product->current_price) }}</span>
                                    @if ($product->previous_price != '0')
                                        <span
                                            class="old-price">{{ Helper::showCurrencyPrice($product->previous_price) }}</span>
                                    @endif
                                </div>
                                <div class="product__modal-des mb-30">
                                    <p>{{ $product->short_description }}</p>
                                </div>
                                <div class="product__modal-form mb-30">
                                    <form action="{{ route('front.product.checkout', $product->slug) }}" method="GET">
                                        @csrf
                                        <div class="pro-quan-area d-sm-flex align-items-center">
                                            <div class="product-quantity-title">
                                                <label>{{ __('Quantity') }}</label>
                                            </div>
                                            <div class="product-quantity mr-20 mb-20">
                                                <div class="cart-plus-minus">
                                                    <input type="number" name="qty" data-href=" {{ $product->stock }} " value="1" />
                                                </div>
                                            </div>
                                            {{-- <input type="hidden" id="stock" value="{{ $product->stock }}"> --}}
                                            <div class="pro-cart-btn mr-3">
                                                @if(Auth::user())
                                                <a href="javascript:;" data-href="{{ route('front.product.add_cart',$product->id) }}" class=" add-cart-btn mb-20" id="add_cart">{{ __('+ Add to Cart') }}</a>

                                                @else
                                                <a href="{{ route('user.login') }}"class="add-cart-btn mb-20" >{{ __('+ Add to Cart') }}</a>
                                                @endif

                                            </div>
                                            <div class="pro-cart-btn">
                                                @if(Auth::user())
                                                <input type="submit" class=" buy-now-btn mb-20" value="{{ __('Buy Now') }}" ></input>
                                                @else
                                                <button href="{{ route('user.login') }}"class="buy-now-btn mb-20" >{{ __('Buy Now') }}</button>

                                                @endif

                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="product__tag mb-25">
                                    <span>{{ __('Category') }} :</span>
                                    <span><a
                                            href="{{ route('front.products', ['pcategory' => $product->productcategory->slug, 'psubcategory' => $product->productsubcategory->slug]) }}">{{ $product->productcategory->name }}
                                            , </a></span>

                                    <span><a
                                            href="{{ route('front.products', ['pcategory' => $product->productcategory->slug, 'psubcategory' => $product->productsubcategory->slug]) }}">{{ $product->productsubcategory->name }}</a></span>
                                </div>
                                <div class="product__share">
                                    <span>{{ __('Share') }} :</span>
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
                                        <div class="nav nav-tabs justify-content-start justify-content-sm-center"
                                            id="pro-details" role="tablist">
                                            <a class="nav-item nav-link active" id="des-tab" data-toggle="tab"
                                                href="#des" role="tab" aria-controls="des"
                                                aria-selected="true">{{ __('Description') }}</a>
                                            <a class="nav-item nav-link" id="review-tab" data-toggle="tab"
                                                href="#review" role="tab" aria-controls="review"
                                                aria-selected="false">{{ __('Reviews ') }} ({{ count($reviews) }})</a>
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
                                                    <h3>Reviews ({{ count($reviews) }})</h3>
                                                </div>
                                                <div class="latest-comments mb-30">
                                                    <ul>
                                                        @foreach ($reviews as $review)
                                                            <li>
                                                                <div class="comments-box">
                                                                    <div class="comments-avatar">
                                                                        <img src="
                                                                    @if ($review->user->image) {{ asset('assets/front/img/' . $review->user->image) }}
                                                                    @else
                                                                        {{ asset('assets/admin/img/img-demo.jpg') }} @endif"
                                                                            alt="">
                                                                    </div>
                                                                    <div class="comments-text">
                                                                        <div class="avatar-name">
                                                                            <h5>{{ $review->user->name }}</h5>
                                                                            <span> -
                                                                                {{ $review->created_at->diffForHumans() }}</span>
                                                                        </div>
                                                                        <div class="user-rating">
                                                                            <ul>
                                                                                @for ($i = 0; $i < $review->rating; $i++)
                                                                                    <li><a><i class="fas fa-star"></i></a>
                                                                                    </li>
                                                                                @endfor
                                                                            </ul>
                                                                        </div>
                                                                        <p>{!! $review->comment !!}</p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="post-comments-form mb-100">
                                                <div class="post-comments-title mb-30">
                                                    <h3>Your Rating</h3>
                                                    <form class="rating"
                                                        action="{{ route('front.product.review', $product->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <div id="full-stars-example-two">
                                                            <div class="rating-group">
                                                                <label class="rating__label" for="rating1">
                                                                    <i
                                                                        class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="rating"
                                                                    id="rating1" value="1" type="radio"
                                                                    @if ($user_rating == '1') checked @endif>

                                                                <label class="rating__label" for="rating2">
                                                                    <i
                                                                        class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="rating"
                                                                    id="rating2" value="2" type="radio"
                                                                    @if ($user_rating == '2') checked @endif>

                                                                <label class="rating__label"for="rating3">
                                                                    <i
                                                                        class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="rating"
                                                                    id="rating3" value="3" type="radio"
                                                                    @if ($user_rating == '3') checked @endif>

                                                                <label class="rating__label" for="rating4">
                                                                    <i
                                                                        class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="rating"
                                                                    id="rating4" value="4" type="radio"
                                                                    @if ($user_rating == '4') checked @endif>

                                                                <label class="rating__label" for="rating5">
                                                                    <i
                                                                        class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="rating"
                                                                    id="rating5" value="5" type="radio"
                                                                    @if ($user_rating == '5') checked @endif>
                                                            </div>
                                                            @if ($errors->has('rating'))
                                                                <p class="text-danger">{{ $errors->first('rating') }}</p>
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                                <form class="conatct-post-form"
                                                    action="{{ route('front.product.review', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="contact-icon p-relative contacts-message">
                                                                <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Comments"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <button class="os-btn os-btn-black" type="submit">Post
                                                                comment</button>
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
                                    <a href="{{ route('front.product_details', $popular_product->slug) }}"
                                        class="w-img">
                                        <img src="{{ asset('assets/front/img/' . $popular_product->image) }}"
                                            alt="product-img">
                                    </a>
                                    <div class="product__action transition-3">
                                        @if (Auth::user())
                                            @if ( Helper::isWishlist($product->id) )
                                                <a href="javascript:;" class="active"  id="remove_wishlist" data-add="{{ route('front.product.add.wishlist', $product->slug) }}" data-remove="{{ route('front.product.remove.wishlist',  $product->slug) }}" data-href="{{ route('front.product.remove.wishlist',  $product->slug) }}" data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('Remove From Wishlist') }}">
                                                    <i class="fas fa-heart"></i>
                                                </a>
                                            @else
                                                <a href="javascript:;" data-href="{{ route('front.product.add.wishlist', $product->slug) }}" data-remove="{{ route('front.product.remove.wishlist',  $product->slug) }}" data-add="{{ route('front.product.add.wishlist', $product->slug) }}" id="add_wishlist" data-toggle="tooltip" data-placement="top"
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

                                        <a href="{{ route('front.product.checkout', $product->slug) }}" data-toggle="tooltip" data-placement="top"
                                            title="{{ __('Buy Now') }}">
                                            <i class="fal fa-shopping-cart"></i>
                                        </a>

                                    </div>
                                    @if ($popular_product->is_featured == 1)
                                        <div class="product__featured">
                                            <span>Featured</span>
                                        </div>
                                    @endif
                                    <div class="product__sale">
                                        @if (Helper::newProduct($popular_product->created_at))
                                            <span class="new">new</span>
                                        @endif
                                        @if ($popular_product->previous_price != '0')
                                            <span
                                                class="percent">{{ Helper::discountPercentage($popular_product->current_price, $popular_product->previous_price) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="product__content p-relative">
                                    <div class="product__content-inner">
                                        <h4><a
                                                href="{{ route('front.product_details', $popular_product->slug) }}">{{ $popular_product->title }}</a>
                                        </h4>
                                        <div class="product__price transition-3">
                                            <span>{{ Helper::showCurrencyPrice($popular_product->current_price) }}</span>
                                            @if ($popular_product->previous_price != '0')
                                                <span
                                                    class="old-price">{{ Helper::showCurrencyPrice($popular_product->previous_price) }}</span>
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
        </section>
        <!-- related products area end -->


    </main>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.rating__input', function() {
            $('.rating').submit();
        })
    </script>
@endsection
