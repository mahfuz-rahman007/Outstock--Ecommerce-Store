<div class="user-info">
    <img class="mb-3 show-img img-demo"
        src="
    @if (Auth::user()->image)
    {{ asset('assets/front/img/' . Auth::user()->image) }}
    @else
    {{ asset('assets/admin/img/img-demo.jpg') }}
    @endif"
        alt="">
    <h4>{{ Auth::user()->name }}</h4>
</div>
<div class="user-menu">
    <ul>
        <li>
            <a class="@if (request()->path() == 'user/dashboard') active @endif" href="{{ route('user.dashboard') }}">
                {{ __('Dashboard') }} </a>
        </li>
        @if ($commonsetting->is_shop_page == 1)
            <li>
                <a class="
            @if (request()->path() == 'user/product-orders') active
            @elseif(request()->is('user/product-order/*')) active
            @endif"
                    href=""> {{ __('Product Order') }} </a>
            </li>
        @endif
        <li>
            <a class="@if (request()->path() == 'user/edit-profile') active @endif" href="{{ route('user.editProfile') }}">
                {{ __('Edite Profile') }} </a>
        </li>
        <li>
            <a class="@if (request()->path() == 'user/change-password') active @endif" href="{{ route('user.changePassword') }}">
                {{ __('Change Password') }} </a>
        </li>
        <li>
            <a class="" href="{{ route('user.logout') }}"> {{ __('Logout') }} </a>
        </li>
    </ul>
</div>
