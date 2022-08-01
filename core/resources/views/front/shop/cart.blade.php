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
                            <h1>{{ __('Cart') }}</h1>
                            <div class="page__title-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                                        </li>

                                        <li class="breadcrumb-item" aria-current="page">
                                            <a href="{{ route('front.products') }}">{{ __('Shop') }}</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ __('Cart') }}</li>

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
                @if($cart != null)
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="remove_before"></div>
                            <div class="cart-table">
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">{{ __('Images') }}</th>
                                                <th class="cart-product-name">{{ __('Product') }}</th>
                                                <th class="product-price">{{ __('Unit Price') }}</th>
                                                <th class="product-quantity">{{ __('Quantity') }}</th>
                                                <th class="product-subtotal">{{ __('Total') }}</th>
                                                <th class="product-remove">{{ __('Remove') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                                $cartTotal = 0;
                                                $countItem = 0;
                                            @endphp

                                            @foreach ($cart as $pid => $item)
                                                @php
                                                $countItem += $item['qty'];
                                                $cartTotal += (double)$item['price'] * (int)$item['qty'];
                                                $product = App\Model\Product::findOrFail($pid);
                                            @endphp
                                                <input type="hidden" value="{{ $pid }}" class="product_id">
                                                <input type="hidden" value="{{ $product->stock }}" id="stock">
                                                <tr  class="remove{{$pid}}">
                                                    <td class="product-thumbnail">
                                                        <a href="product-details.html"><img src="{{ asset('assets/front/img/'.$item['image']) }}" alt=""></a>
                                                    </td>

                                                    <td class="product-name">
                                                        <a href="{{ route('front.product_details', $product->slug) }}">{{ $item['title'] }}</a>
                                                    </td>

                                                    <td class="product-price">
                                                        <span class="amount"> {{ Helper::showCurrency() }} <span class="product_price">{{Helper::showPrice($item['price'])}}</span> </span>
                                                    </td>

                                                    <td class="product-quantity">
                                                        <div class="cart-plus-minus">
                                                            <input type="number" class="quantity"  data-href=" {{ $product->stock }}" value="{{ $item['qty'] }}" />
                                                        </div>
                                                    </td>

                                                    <td class="product-subtotal">
                                                        <span class="amount"> {{ Helper::showCurrency() }} <span class="cart_price">{{ Helper::showPrice( $item['price']  * $item['qty'] ) }}</span></span>
                                                    </td>

                                                    <td class="product-remove">
                                                        <a href="javascript:;"  class="item-remove"  rel="{{$pid}}" data-href="{{route('cart.item.remove',$pid)}}" ><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="coupon-all">
                                            <div class="coupon2">
                                                <button class="os-btn os-btn-black" id="cart_update" data-href="{{ route('cart.update') }}" >{{ __('Update Cart') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 ml-auto">
                                        <div class="cart-page-total">
                                            <h2>Cart totals</h2>
                                            <ul class="mb-20">
                                                <li>{{ __('Total Item') }} <span class="product_count" >{{ $countItem }}</span></li>
                                                <li>{{ __('Total') }} <span class="product_totalPrice">{{ Helper::showCurrencyPrice($cartTotal) }}</span></li>
                                            </ul>
                                            <a class="os-btn" href="{{ route('front.checkout') }}">{{ __('Proceed to checkout') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="bg-light py-5 text-center">
                          <h3 class="text-uppercase">{{__('Cart is empty!')}}</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif

            </section>
            <!-- Cart Area End-->

    </main>
@endsection
