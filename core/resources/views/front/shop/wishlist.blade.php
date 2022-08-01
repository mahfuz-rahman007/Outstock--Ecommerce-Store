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
                            <h1>{{ __('Wishlist') }}</h1>
                            <div class="page__title-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ __('Wishlist') }}</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page title area end -->

        <!-- Cart Area Strat-->
        <section class="cart-area pt-100 pb-100">
            @if ($wishlist != null)
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="remove_before"></div>
                        <div class="card-table">
                            <form action="#">
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">{{ __('Images') }}</th>
                                                <th class="cart-product-name">{{ __('Product') }}</th>
                                                <th class="product-price">{{ __('Unit Price') }}</th>
                                                <th class="product-quantity">{{ __('Add To Cart') }}</th>
                                                <th class="product-remove">{{ __('Remove') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($wishlist as $id => $item)
                                            @php
                                                $product = App\Model\Product::findOrFail($item['id']);
                                            @endphp
                                            <tr  class="remove{{$id}}">
                                                <td class="product-thumbnail"><a href="product-details.html"><img src="{{ asset('assets/front/img/'.$product->image) }}" alt=""></a></td>
                                                <td class="product-name"><a href="{{ route('front.product_details', $product->slug) }}">{{ $product->title }}</a></td>
                                                <td class="product-price"><span class="amount">{{ Helper::showCurrencyPrice($product->current_price) }}</span></td>
                                                <td class="product-quantity">
                                                    <button class="os-btn os-btn-black" data-href="{{ route('front.product.add_cart',$product->id) }}" id="add_cart">Add TO Cart</button>
                                                </td>
                                                <td class="product-remove"><a href="javascript:;" id="remove_wishlist" data-href="{{ route('front.product.remove.wishlist',  $product->slug) }}"  rel="{{$id}}"><i class="fa fa-times"></i></a></td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            @else
            <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="bg-light py-5 text-center">
                      <h3 class="text-uppercase">{{__('Wishlist is empty!')}}</h3>
                    </div>
                  </div>
                </div>
              </div>
            @endif

        </section>
        <!-- Cart Area End-->


    </main>
@endsection
