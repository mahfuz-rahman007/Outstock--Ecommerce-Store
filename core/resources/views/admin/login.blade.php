<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portfolio</title>
     <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css') }}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition login-page">
    
    <div class="login-box">
        <div class="login-logo">
            <img src="" alt="">
        </div>

        <div class="card">
            <div class="card-body login-card-body text-center">
                @if(session()->has('alert'))
                  <p class="text-danger">{{ session('alert') }}</p>
                @endif

                <p class="login-box-msg">{{ __('Login To Go Dashboard') }}</p>

                <form action="{{ route('admin.auth') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" value="" placeholder="{{ __('Username') }}">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <i class="fas fa-user"></i>
                          </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="" class="form-control" value="" placeholder="{{ __('Password') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('LOGIN') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
    </div>

        <!-- jQuery 3 -->
        <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/admin/js/adminlte.min.js') }}"></script>

</body>
</html>