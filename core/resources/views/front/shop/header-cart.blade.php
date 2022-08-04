

    @if (count($cart) != 0)
        <div class="mini-cart-inner">
            <ul class="mini-cart-list">
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

                <li  class="remove{{$pid}}">
                    <div class="cart-img f-left">
                        <a href="{{ route('front.product_details', $product->slug) }}">
                            <img src="{{ asset('assets/front/img/'.$item['image']) }}"
                                alt="" />
                        </a>
                    </div>
                    <div class="cart-content f-left text-left">
                        <h5>
                            <a href="{{ route('front.product_details', $product->slug) }}">{{ $item['title'] }}</a>
                        </h5>
                        <div class="cart-price">
                            <span class="ammount">{{ $item['qty'] }} <i
                                    class="fal fa-times"></i></span>
                            <span class="price">{{ Helper::showCurrency() }} <span class="product_price">{{Helper::showPrice($item['price'])}}</span></span>
                        </div>
                    </div>
                    <div class="del-icon f-right mt-30">
                        <a href="javascript:;"  class="item-remove"  rel="{{$pid}}" data-href="{{route('cart.item.remove',$pid)}}" ><i class="fal fa-times"></i></a>
                    </div>
                </li>

                @endforeach
            </ul>

            <div class="total-price  mb-30">
                <div class="d-flex justify-content-between mb-2">
                    <span>Product Item :</span>
                    <span>{{ $countItem }}</span>
                </div>
                <div class="d-flex justify-content-between">
                        <span>Subtotal:</span>
                        <span>{{ Helper::showCurrencyPrice($cartTotal) }}</span>
                </div>
            </div>
            <div class="checkout-link">
                <a class="os-btn" href="{{ route('front.cart') }}">{{ __('View Cart') }}</a>
                <a class="os-btn os-btn-black" href="{{ route('front.checkout') }}">{{ __('Checkout') }}</a>
            </div>
        </div>
    @else
        <p class="cart-empty">{{ __('Cart is Empty') }}</p>
    @endif

