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
                            <h1>{{ __('Checkout') }}</h1>
                            <div class="page__title-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                                        </li>

                                        <li class="breadcrumb-item" aria-current="page">
                                            <a href="{{ route('front.products') }}">{{ __('Shop') }}</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ __('Checkout') }}</li>

                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page title area end -->


        <!-- checkout-area start -->
        <section class="checkout-area pt-100 pb-100">
            <div class="container">
                <form action="javascript:;" id="payment_gateway_check" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="checkbox-form">
                                <h3>Billing Details</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Name <span class="required">*</span></label>
                                            <input type="text" placeholder="Name" name="billing_name"  value="{{ Auth::user()->name }}"/>
                                            @if ($errors->has('billing_name'))
                                            <p class="text-danger"> {{ $errors->first('billing_name') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label>
                                            <input type="text" placeholder="Street address" name="billing_address" value="{{ Auth::user()->address }}"/>
                                            @if ($errors->has('billing_address'))
                                            <p class="text-danger"> {{ $errors->first('billing_address') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input type="email" placeholder="Email" name="billing_email" value="{{ Auth::user()->email }}" />
                                            @if ($errors->has('billing_email'))
                                            <p class="text-danger"> {{ $errors->first('billing_email') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Phone <span class="required">*</span></label>
                                            <input type="text" placeholder="Phone No" name="billing_number" value="{{ Auth::user()->phone }}"/>
                                            @if ($errors->has('billing_number'))
                                            <p class="text-danger"> {{ $errors->first('billing_number') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Country <span class="required">*</span></label>
                                            <input type="text" placeholder="Country" name="billing_country" value="{{ Auth::user()->country }}"/>
                                            @if ($errors->has('billing_country'))
                                            <p class="text-danger"> {{ $errors->first('billing_country') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>City <span class="required">*</span></label>
                                            <input type="text" placeholder="City" name="billing_city" value="{{ Auth::user()->city }}"/>
                                            @if ($errors->has('billing_city'))
                                            <p class="text-danger"> {{ $errors->first('billing_city') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>State<span class="required">*</span></label>
                                            <input type="text" placeholder="State" name="billing_state" value="{{ Auth::user()->state }}" />
                                            @if ($errors->has('billing_state'))
                                            <p class="text-danger"> {{ $errors->first('billing_state') }} </p>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Postcode / Zipcode <span class="required">*</span></label>
                                            <input type="text" placeholder="Postcode / Zipcode" name="billing_zip" value="{{ Auth::user()->zipcode }}" />
                                            @if ($errors->has('billing_zip'))
                                            <p class="text-danger"> {{ $errors->first('billing_zip') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="your-order mb-30 ">
                                <h3>Your order</h3>
                                <div class="your-order-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
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

                                                <tr class="cart_item">
                                                    <td class="product-name row" >
                                                        <div class="col-3 checkout_img">
                                                            <img src="{{ asset('assets/front/img/'.$item['image']) }}"
                                                            alt="" />
                                                        </div>
                                                        <div class="col-9">
                                                            <p class="mb-0"><a href="{{ route('front.product_details', $product->slug) }}">{{ $product->title }}</a> </p>
                                                            <p>{{ Helper::showCurrencyPrice($item['price']) }}  × {{ $item['qty'] }}</p>
                                                        </div>
                                                    </td>
                                                    <td class="product-total">
                                                       <span class="amount">{{ Helper::showCurrency() }} <span class="cart_price">{{ Helper::showPrice( $item['price']  * $item['qty'] ) }}</span></span>
                                                    </td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                        <tfoot>

                                            <tr class="shipping">
                                                <th>{{ __('Shipping') }}</th>
                                                <td>
                                                    <ul>

                                                        @foreach ($shippings as $shipping)
                                                        <li>
                                                            <input type="radio" class="shipping_charge" @if($shipping->cost == 0) checked @endif name="shipping_charge" value="{{ $shipping->id }}" data-href="{{ Helper::showPrice($shipping->cost) }}" />
                                                            <span>
                                                                {{ $shipping->title }} : <span class="amount">{{ Helper::showCurrencyPrice($shipping->cost) }}</span>
                                                            </span>
                                                            <p class="ml-3 text-muted"><small>{{ $shipping->subtitle }}</small> </p>

                                                        </li>

                                                        @endforeach
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr class="cart-subtotal">
                                                @php
                                                    $shipping_charge = 0;
                                                @endphp
                                                <th>
                                                   <p>{{ __('Total Item') }} :</p>
                                                   <p>{{ __('Cart Subtotal') }} :</p>
                                                   <p>{{ __('Shipping Charge') }} :</p>

                                                </th>
                                                <td>
                                                    <p class="amount"><h5>{{ $countItem }}</h5> </p>
                                                    <p class="amount">
                                                            <h5>
                                                                {{ Helper::showCurrency() }}
                                                                <span class="cart_subtotal" data-href="{{ Helper::showPrice($cartTotal) }}">{{ Helper::showPrice($cartTotal) }}</span>
                                                            </h5>
                                                    </p>
                                                    <p class="amount">
                                                            <h5>
                                                                + {{ Helper::showCurrency() }}
                                                                <span class="shipping_cost">{{ $shipping_charge }}</span>
                                                            </h5>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>{{ __('Order Total') }}</th>
                                                <td>
                                                    <strong>
                                                        <span class="amount ">{{ Helper::showCurrency() }}
                                                            <span class="cart_grandtotal">{{ Helper::showPrice($cartTotal) }}</span>
                                                        </span>
                                                    </strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="payment-method">
                                    <h4>{{ __('Select Payment Gateway') }}</h4>

                                    <div class="payment-gateway">
                                        <ul class="p-0 mt-3">

                                            @foreach ($payment_gateways as $gateway)
                                            <li class="product_payment_gateway_check" data-href="{{ $gateway->id }}" id="{{ $gateway->type == 'automatic' ? $gateway->title : $gateway->title }}">
                                                <img src="{{ asset('assets/front/img/'.$gateway->image) }}" title="{{ $gateway->type == 'automatic' ? $gateway->title : $gateway->title }}" id="{{ $gateway->type == 'automatic' ? $gateway->title : $gateway->title }}" alt="">
                                            </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <input type="hidden" name="payment_gateway" id="payment_gateway">
                                    <div class="payment_show_check mt-4 d-none">
                                        <div class="row">

                                          <div class="col-md-6 mb-3">
                                            <label for="cc-number">{{ __('Credit Card Number') }}</label>
                                            <input type="text" class="form-control" name="card_number" value="" id="cc-number" placeholder="{{ __('Credit Card Number') }}">
                                          </div>
                                          <div class="col-md-6 mb-3">
                                            <label for="cc-month">{{ __('Month') }}</label>
                                            <input type="text" class="form-control" name="month" value="" id="cc-month" placeholder="{{ __('Month') }}">
                                          </div>
                                          <div class="col-md-6 mb-3">
                                              <label for="cc-expiration">{{ __('Expaire Year') }}</label>
                                              <input type="text" class="form-control" name="year" value="" id="cc-expiration" placeholder="{{ __('Expaire') }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                              <label for="cc-cvv">{{ __('CVC') }}</label>
                                              <input type="text" class="form-control" name="cvc" value="" id="cc-cvv" placeholder="{{ __('CVC') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="currency_code" value="{{ Helper::showCurrencyCode() }}">
                                    <input type="hidden" name="currency_sign" value="{{ Helper::showCurrency() }}">
                                    <input type="hidden" name="currency_value" value="{{ Helper::showCurrencyValue() }}">
                                    <div class="order-button-payment mt-20">
                                        <button type="submit" class="os-btn os-btn-black">Place order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- checkout-area end -->

        <input type="hidden" id="product_paypal" value="{{route('product.paypal.submit')}}">
        <input type="hidden" id="product_stripe" value="{{route('product.stripe.submit')}}">
        <input type="hidden" id="product_cash_on_delivery" value="{{route('product.cash_on_delivery.submit')}}">





    </main>
@endsection

