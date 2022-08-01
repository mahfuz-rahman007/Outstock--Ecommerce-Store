
@php
$user = json_decode($order->user_info,true);
$cart = json_decode($order->cart,true);
$shipping_charge_info = json_decode($order->shipping_charge_info,true);
@endphp

<div class="progress-area-step pt-4">
<ul class="progress-steps">
    <li class="{{$order->order_status == '0' ? 'pending' : ''}}">
        <div class="icon"><i class="fas fa-arrow-alt-circle-right"></i></div>
        <div class="progress-title">{{__('Pending')}}</div>
    </li>
    <li class="{{$order->order_status == '1' ? 'processing' : ''}}">
        <div class="icon"><i class="fas fa-arrow-alt-circle-right"></i></div>
        <div class="progress-title">{{__('Processing')}}</div>
    </li>
    <li class="{{$order->order_status == '2' ? 'completed' : ''}}">
        <div class="icon"><i class="fas fa-check-circle"></i></div>
        <div class="progress-title">{{__('Completed')}}</div>
    </li>
    <li class="{{$order->order_status == '3' ? 'rejected' : ''}}">
        <div class="icon"><i class="fas fa-times-circle"></i></div>
        <div class="progress-title">{{__('Rejected')}}</div>
    </li>
</ul>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <b>{{ __('Order Details') }}</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table  table-bordered">
                        <tr>
                            <th>{{ __('Order Id') }}</th>
                            <td>
                                {{ $order->order_number }}
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('Invoice') }}</th>
                            <td>
                                <a class="btn btn-success btn-sm" href="{{asset('assets/front/invoices/product/'.$order->invoice_number)}}" target="_blank">{{ __('Download Invoice') }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th>{{__('Payment Status')}} :</th>
                            <td>
                                @if($order->payment_status =='0')
                                <span class="badge badge-danger">Pending </span>
                                @else
                                <span class="badge badge-success">Completed  </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{__('Order Status')}} :</th>
                            <td>
                                @if ($order->order_status == '0')
                                <span class="badge badge-warning"> Pending </span>
                                @elseif ($order->order_status == '1')
                                <span class="badge badge-primary">Processing </span>
                                @elseif ($order->order_status == '2')
                                <span class="badge badge-success"> Completed </span>
                                @elseif ($order->order_status == '3')
                                <span class="badge badge-danger"> Rejected  </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{__('Paid amount')}} :</th>
                            @php
                                $total = round($order->total, 2);
                                $total = number_format($total , 2);
                            @endphp
                            <td>{{$order->currency_sign}} {{$total}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Shipping Info')}} :</th>
                            <td>
                                <strong>Title :</strong> {{ $shipping_charge_info['title'] }} <br>
                                <strong>Duration :</strong> {{ $shipping_charge_info['subtitle'] }} <br>
                                <strong>Cost :</strong> {{$order->currency_sign}} {{ Helper::showPrice($shipping_charge_info['cost']) }} <br>
                            </td>
                        </tr>
                        <tr>
                            <th>{{__('Payment Method')}} :</th>
                            <td>{{Helper::convertUtf8($order->method)}}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Transaction Id') }}</th>
                            <td>{{$order->txn_id}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Order Date')}} :</th>
                            <td>{{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
            <div class="card card-primary card-outline">
                    <div class="card-header">
                        <b>{{ __('Billing Details') }}</b>
                    </div>

                    <div class="card-body">
                        <table class="table  table-bordered">
                            <tr>
                                <th>{{__('Email')}} :</th>
                                <td>{{Helper::convertUtf8($order->billing_email)}}</td>
                            </tr>
                            <tr>
                                <th>{{__('Phone')}} :</th>
                                <td> {{$order->billing_number}}</td>
                            </tr>
                            <tr>
                                <th>{{__('State')}} :</th>
                                <td>{{Helper::convertUtf8($order->billing_state)}}</td>
                            </tr>
                            <tr>
                                <th>{{__('Address')}} :</th>
                                <td>{{Helper::convertUtf8($order->billing_address)}}</td>
                            </tr>
                            <tr>
                                <th>{{__('Country')}} :</th>
                                <td>{{Helper::convertUtf8($order->billing_country)}}</td>
                            </tr>
                            <tr>
                                <th>{{__('Zip Code')}} :</th>
                                <td>{{Helper::convertUtf8($order->billing_zip)}}</td>
                            </tr>
                        </table>
                </div>
            </div>
    </div>

</div>

<div class="row mt-4">
 <div class="col-lg-12">
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>{{__('Image')}}</th>
            <th>{{__('Product')}}</th>
            <th>{{__('Quintity')}}</th>
            <th>{{__('Price')}}</th>
            <th>{{__('Total')}}</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($cart as $key => $item)
            <tr>
               <td>{{$key+1}}</td>
               <td>
                   <img  width="80" src="{{asset('assets/front/img/'.$item['image'])}}" alt="product" >
            </td>
               <td>{{Helper::convertUtf8($item['title'])}}</td>
               <td>
                  <b>{{__('Quantity')}}:</b> <span>{{$item['qty']}}</span><br>
               </td>
               <td><span>{{ $order->currency_sign }} {{  Helper::showPrice($item['price']) }} </span></td>

               <td><span>{{ $order->currency_sign }} {{  Helper::showPrice($item['price'] * $item['qty'])  }} </span></td>

            </tr>
            @endforeach
        </tbody>
      </table>
 </div>
</div>
