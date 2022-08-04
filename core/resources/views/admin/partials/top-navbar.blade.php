<nav class="main-header navbar navbar-expand navbar-light navbar-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <div class="nav-link">
         <a class="btn btn-primary btn-sm d-block mybtn9" href="{{ route('front.index') }}" target="_blank"> <i class="far fa-eye"></i>{{ __('Visite Site') }}</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link pt-0 pr-3" data-toggle="dropdown" href="#">
            <img class="user-image w-40 img-circle" src="{{ asset('assets/admin/img/admin-user/'.Auth::guard('admin')->user()->image) }} "  alt="User Image">
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right border-none">
              <div class="card card-widget widget-user-2 mb-0 shadow-none">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-primary">
                  <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="{{ asset('assets/admin/img/admin-user/'.Auth::guard('admin')->user()->image) }}" alt="User Avatar">
                  </div>
                  <!-- /.widget-user-image -->
                  <h6 class="widget-user-username mt-2">{{ Auth::guard('admin')->user()->name }} </h6>
                  <h6 class="widget-user-desc">{{ Auth::guard('admin')->user()->email }} </h6>
                </div>
                <div class="card-footer p-0 bg-white">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a href="{{ route('admin.editProfile') }}" class="nav-link">
                          <i class="fas fa-edit mr-1"></i> {{ __('Edit Profile') }}
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('admin.editPassword') }}" class="nav-link">
                          <i class="fas fa-unlock-alt mr-1"></i> {{ __('Change Password') }}
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('admin.logout') }}" class="nav-link">
                          <i class="fas fa-sign-out-alt mr-1"></i> {{ __('Logout') }}
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
        </div>
      </li>
    </ul>
  </nav>
