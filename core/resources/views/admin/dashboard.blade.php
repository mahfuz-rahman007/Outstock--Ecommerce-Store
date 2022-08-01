 @extends('admin.layout')

 @section('content')

   <!-- Content Header (Page header) -->

   <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Welcome back,') }} {{ Auth::guard('admin')->user()->name }} !</h1>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
           <div class="row">
            <div class="col-md-4 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-star"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">{{ __('Product') }}</span>
                  <h4 class="info-box-number font-weight-normal">{{\App\Model\Product::count()}}</h4>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-4 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-star"></i></span>
                @php
                    $porder = App\Model\Order::where('order_status', '0')->orderBy('id', 'DESC')->get();
                @endphp
                <div class="info-box-content">
                  <span class="info-box-text">{{ __('Pending Product Order') }}</span>
                  <h4 class="info-box-number font-weight-normal">{{$porder->count()}}</h4>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>

                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-star"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">{{ __('Subscribers') }}</span>
                      <h4 class="info-box-number font-weight-normal">{{\App\Model\Newsletter::count()}}</h4>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-star"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">{{ __('User') }}</span>
                      <h4 class="info-box-number font-weight-normal">{{\App\User::count()}}</h4>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
          </div>
          <div class="row">

          </div>
        <!-- Main row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
 @endsection
