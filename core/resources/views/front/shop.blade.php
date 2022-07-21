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
                            <h1>{{ __('Shop') }}</h1>
                            <div class="page__title-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item"><a
                                                href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"> {{ __('Shop') }}</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page title area end -->

        <!-- shop area start -->
        <section class="shop__area pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-4">
                        <div class="shop__sidebar">
                            <div class="sidebar__widget mb-55">
                                <div class="sidebar__widget-title mb-25">
                                    <h3>Product Categories</h3>
                                </div>
                                <div class="sidebar__widget-content">
                                    <div class="categories">
                                        <div id="accordion">
                                            @foreach ($categories as $category)
                                                <div class="card">
                                                    <div class="card-header white-bg">
                                                        <h5 class="mb-0">
                                                            <button
                                                                class="shop-accordion-btn {{ request()->input('pcategory') == $category->slug ? '' : 'collapsed' }} {{ request()->input('pcategory') == $category->slug ? 'active' : '' }}"
                                                                data-toggle="collapse"
                                                                data-target="#collapse{{ $category->slug }}"
                                                                aria-expanded="true"
                                                                aria-controls="collapse{{ $category->slug }}">
                                                                {{ $category->name }}
                                                            </button>
                                                        </h5>
                                                    </div>

                                                    <div id="collapse{{ $category->slug }}"
                                                        class="collapse {{ request()->input('pcategory') == $category->slug ? 'show' : '' }}"
                                                        aria-labelledby="{{ $category->slug }}" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="categories__list">
                                                                <ul>
                                                                    @foreach ($category->productsubcategories as $psubcategory)
                                                                        <li><a class="{{ request()->input('psubcategory') == $psubcategory->slug ? 'active' : '' }}"
                                                                                href="javascript:;" data="{{ $category->slug.'_'.$psubcategory->slug}}" id="category">{{ $psubcategory->name }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar__widget mb-55">
                                <div class="sidebar__widget-title mb-30">
                                    <h3>Filter By Price</h3>
                                </div>
                                <div class="sidebar__widget-content">
                                    <div class="price__slider">
                                        <div id="slider-range"></div>
                                        <div>
                                                <button type="submit" id="filter_price">Filter</button>
                                                <label for="amount">Price :</label>
                                                <input type="text" id="amount" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar__widget">
                                <div class="sidebar__widget-title mb-30">
                                    <h3>{{ __('Featured Products') }}</h3>
                                </div>
                                <div class="sidebar__widget-content">
                                    <div class="features__product">
                                        <ul>
                                            @foreach ($featured_products as $featured_product)
                                                <li class="mb-20">
                                                    <div class="featires__product-wrapper d-flex">
                                                        <div class="features__product-thumb mr-15">
                                                            <a href="product-details.html"><img
                                                                    src="{{ asset('assets/front/img/' . $featured_product->image) }}"
                                                                    alt="pro-sm-1"></a>
                                                        </div>
                                                        <div class="features__product-content">
                                                            <h5><a
                                                                    href="product-details.html">{{ $featured_product->title }}</a>
                                                            </h5>
                                                            <div class="price">
                                                                <span>{{ Helper::showCurrencyPrice($featured_product->current_price) }}</span>
                                                                @if ($featured_product->previous_price != '0')
                                                                    <span
                                                                        class="price-old">{{ Helper::showCurrencyPrice($featured_product->previous_price) }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach


                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-8">
                        <div class="shop__content-area">
                            <div class="shop__header d-sm-flex justify-content-between align-items-center mb-40">
                                <div class="shop__header-left">
                                    <div class="search-box">
                                        <input type="text" class="form-control px-4 py-4" id="searchProductInput" value="{{ request()->input('search') }}" placeholder="{{ __('Search Product') }}">
                                        <button class="searchproduct" > <i class="fas fa-search"></i> </button>

                                    </div>
                                </div>
                                <div
                                    class="shop__header-right d-flex align-items-center justify-content-between justify-content-sm-end">
                                    <div class="sort-wrapper">
                                        <select class="form-control" id="sortingProduct">
                                            <option value="new" {{ request()->input('type') == 'new' ? 'selected' : '' }}>{{ __("Newest") }}</option>
                                            <option value="old" {{ request()->input('type') == 'low' ? 'selected' : '' }}>{{ __("Oldest") }}</option>
                                            <option value="high_low" {{ request()->input('type') == 'high_low' ? 'selected' : '' }}>{{ __("Highest To Lowest") }}</option>
                                            <option value="low_high" {{ request()->input('type') == 'low_high' ? 'selected' : '' }}>{{ __("Lowest To Highest") }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-grid" role="tabpanel"
                                    aria-labelledby="pills-grid-tab">
                                    @if(count($products) == 0)
                                        <h1 class="text-center text-secondary my-5">{{ __('No Products Found') }}</h1>
                                    @else
                                        <div class="row custom-row-10">
                                            @foreach ($products as $product)
                                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 custom-col-10">
                                                    <div class="product__wrapper mb-60">
                                                        <div class="product__thumb">
                                                            <a href="{{ route('front.product_details', $product->slug) }}" class="w-img">
                                                                <img src="{{ asset('assets/front/img/' . $product->image) }}"
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
                                                        <div class="product__content p-relative">
                                                            <div class="product__content-inner">
                                                                <h4><a href="{{ route('front.product_details', $product->slug) }}">{{ $product->title }}</a>
                                                                </h4>
                                                                <div class="product__price transition-3">
                                                                    <span>{{ Helper::showCurrencyPrice($product->current_price) }}</span>
                                                                    @if ($product->previous_price != '0')
                                                                        <span
                                                                            class="old-price">{{ Helper::showCurrencyPrice($product->previous_price) }}</span>
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
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-40">
                                <div class="col-xl-12">
                                    <div class="shop-pagination-wrapper d-md-flex justify-content-center align-items-center">
                                        {{ $products->links() }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- shop area end -->

        <!-- Product Area End -->
        <form action="{{route('front.products')}}" method="GET" id="search_product">
            <input type="hidden" name="pcategory" value="{{request()->input('pcategory')}}" id="pcategory">
            <input type="hidden" name="psubcategory" value="{{request()->input('psubcategory')}}" id="psubcategory">
            <input type="hidden" name="search" value="{{request()->input('search')}}" id="search">
            <input type="hidden" name="max" value="{{request()->input('max')}}" id="maxprice">
            <input type="hidden" name="min" value="{{request()->input('min')}}" id="minprice">
            <input type="hidden" name="type" value="{{request()->input('type')}}" id="type">
            <input type="hidden" name="rating" value="{{request()->input('rating')}}" id="rating">
            <button type="submit" id="search_submit" class="d-none"></button>
        </form>


        <!-- shop modal start -->
        {{-- <!-- Modal -->
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
                                                    <img src="assets/img/shop/product/quick-view/quick-big-1.jpg"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                                aria-labelledby="nav-profile-tab">
                                                <div class="product__modal-img w-img">
                                                    <img src="assets/img/shop/product/quick-view/quick-big-2.jpg"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                                aria-labelledby="nav-contact-tab">
                                                <div class="product__modal-img w-img">
                                                    <img src="assets/img/shop/product/quick-view/quick-big-3.jpg"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <nav>
                                            <div class="nav nav-tabs justify-content-between" id="nav-tab"
                                                role="tablist">
                                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                                    href="#nav-home" role="tab" aria-controls="nav-home"
                                                    aria-selected="true">
                                                    <div class="product__nav-img w-img">
                                                        <img src="assets/img/shop/product/quick-view/quick-sm-1.jpg"
                                                            alt="">
                                                    </div>
                                                </a>
                                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                                    href="#nav-profile" role="tab" aria-controls="nav-profile"
                                                    aria-selected="false">
                                                    <div class="product__nav-img w-img">
                                                        <img src="assets/img/shop/product/quick-view/quick-sm-2.jpg"
                                                            alt="">
                                                    </div>
                                                </a>
                                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                                    href="#nav-contact" role="tab" aria-controls="nav-contact"
                                                    aria-selected="false">
                                                    <div class="product__nav-img w-img">
                                                        <img src="assets/img/shop/product/quick-view/quick-sm-3.jpg"
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
                                            <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium
                                                lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum
                                                claram.</p>
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
                                                        <a href="#" class="add-cart-btn mr-10">+ Add to Cart</a>
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
        <!-- shop modal end --> --}}


    </main>
@endsection

@section('scripts')
    <script>

            $(document).on('change', '#sortingProduct',function(){
                let sort = $(this).val();

                $('#type').val(sort);
                submit();
            })

            $(document).on('click','.searchproduct', function(){
                let searchproduct = $('#searchProductInput').val();

                $('#search').val(searchproduct);
                submit();
            });

            $(document).on('click','#filter_price', function(){
                submit();
            });

            $(document).on('click','#category', function(){
                let category = $(this).attr('data');
                let cate = category.split("_");

                $('#pcategory').val(cate[0]);
                $('#psubcategory').val(cate[1]);

                submit();
            });

            function submit(){
                $('#search_product').submit();
            }

        // // Fetch Url value
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 1200,
                values: ['{{request()->input('min') ? request()->input('min') : 0 }}', '{{request()->input('max') ? request()->input('max') : '' }}'],
                slide: function (event, ui) {
                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);

                    $('#minprice').val(ui.values[0]);
                    $('#maxprice').val(ui.values[1]);

                }
            });

            $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                " - $" + $("#slider-range").slider("values", 1));

    </script>
@endsection
