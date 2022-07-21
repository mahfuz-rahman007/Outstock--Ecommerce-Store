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
                            <h1>{{ Auth::user()->name }}</h1>
                            <div class="page__title-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                                        </li>

                                        <li class="breadcrumb-item" aria-current="page">
                                            {{ Auth::user()->name }}
                                        </li>

                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page title area end -->
    <!-- User Dashboard Start -->
	<section class="user-dashboard-area pt-100 pb-100">
		<div class="container">
		  <div class="row">
			<div class="col-lg-3">
				@includeif('user.side-dashboard')
			</div>
			<div class="col-lg-9 ">
			  {{-- <div class="dashboard-inner">
				@if( $visibility->is_shop == 1)
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
							  <p>{{ __('Total Product Order') }}</p>
							  <h5 class="card-title">{{ $orders->count() }}</h5>
							</div>
						  </div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="user-table-wrapper">
							<div class="user-table">
								<table class="table table-bordered table-striped data_table">
									<thead>
										<tr>
											<th>{{ __('Order Number') }}</th>
											<th>{{ __('Total') }}</th>
											<th>{{ __('Quintity') }}</th>
											<th>{{ __('Payment Status') }}</th>
											<th>{{ __('Action') }}</th>
										</tr>
									</thead>
									<tbody>

										@foreach ($orders as $id=>$order)

										<tr>

										  <td>{{$order->order_number}}</td>
											<td>

												{{$order->currency_sign}} {{$order->total}}
											</td>
											<td>
											   {{ $order->qty }}
											</td>

											<td>
												@if($order->payment_status == 0)
													<span class="badge badge-info">{{ __('Pending') }}</span>
												@elseif($order->payment_status == 1)
													<span class="badge badge-success">{{ __('Paid') }}</span>
												@endif

											</td>


											<td>
												<button type="button" data-href="{{ route('user.order.details', $order->id) }}"  class="btn btn-primary view_order_details btn-sm" data-toggle="modal" data-target="#view_order_details_modal">
												{{ __('Details') }}
												  </button>
											</td>
										</tr>
										@endforeach

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				@endif
			  </div> --}}
			</div>
		  </div>
		</div>

	</section>
    <!-- User Dashboard End -->

    </main>
@endsection

