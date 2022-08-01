
@php
$lang_code = $currentLang->code;
@endphp
<aside class="main-sidebar elevation-4 main-sidebar elevation-4 sidebar-light-primary">
    <!-- Sidebar -->
    <div class="sidebar pt-0 mt-0">
      <!-- Sidebar user panel (optional) -->
    <div class=" header-logo mx-auto py-4 text-center">
        <img src="{{ asset('assets/front/img/'.$commonsetting->header_logo) }}" alt="User Image">
    </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
              <a href="{{ route('admin.dashboard') }}" class="nav-link @if(request()->path() == 'admin/dashboard') active @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    {{ __('Dashboard') }}
                </p>
              </a>
            </li>

            <li class="nav-item has-treeview
              @if(request()->path() == 'admin/basicinfo') menu-open
              @elseif(request()->path() == 'admin/email-config') menu-open
              @elseif(request()->path() == 'admin/sectiontitle') menu-open
              @elseif(request()->path() == 'admin/seoinfo') menu-open
              @elseif(request()->path() == 'admin/scripts') menu-open
              @elseif(request()->path() == 'admin/page-visibility') menu-open
              @elseif (request()->path() == 'admin/cookie-alert') menu-open
              @elseif (request()->path() == 'admin/custom-css') menu-open

              @elseif(request()->path() == 'admin/slinks') menu-open
              @elseif(request()->is('admin/slinks/edit/*')) menu-open
              @endif">
              <a href="#" class="nav-link
                @if(request()->path() == 'admin/basicinfo') active
                @elseif(request()->path() == 'admin/email-config') active
                @elseif(request()->path() == 'admin/sectiontitle') active
                @elseif(request()->path() == 'admin/seoinfo') active
                @elseif(request()->path() == 'admin/scripts') active
                @elseif (request()->path() == 'admin/cookie-alert') active
                @elseif (request()->path() == 'admin/custom-css') active
                @elseif(request()->path() == 'admin/page-visibility') active

                @elseif(request()->path() == 'admin/slinks') active
                @elseif(request()->is('admin/slinks/edit/*')) active
                @endif">
                <i class="nav-icon fas fas fa-cog"></i>
                <p>
                    {{ __('Settings') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{ route('admin.setting.basicinfo') . '?language=' . $lang_code }}"
                        class="nav-link @if (request()->path() == 'admin/basicinfo') active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Basic Information') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.mail.config') }}" class="nav-link @if (request()->path() == 'admin/email-config') active @endif">

                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Email Configuration') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.Slinks') }}"
                        class="nav-link @if (request()->path() == 'admin/slinks') active
                    @elseif(request()->is('admin/slinks/edit/*')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Social Links') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.sectiontitle') . '?language=' . $lang_code }}" class="nav-link @if(request()->path() == 'admin/sectiontitle') active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{ __('Section Title') }}</p>
                    </a>
                  </li>
                <li class="nav-item">
                    <a href="{{ route('admin.seoinfo') . '?language=' . $lang_code }} "
                        class="nav-link @if (request()->path() == 'admin/seoinfo') active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('SEO Information') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.scripts') }}"
                        class="nav-link @if (request()->path() == 'admin/scripts') active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Scripts') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pagevisibility') }}"
                        class="nav-link  @if (request()->path() == 'admin/page-visibility') active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Pages Visibility') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.cookiealert') . '?language=' . $lang_code }}"
                        class="nav-link  @if (request()->path() == 'admin/cookie-alert') active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Cookie Alert') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.customcss') }}"
                        class="nav-link  @if (request()->path() == 'admin/custom-css') active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Custom CSS') }}</p>
                    </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.slider') . '?language=' . $lang_code }}" class="nav-link
                 @if(request()->path() == 'admin/slider') active
                 @elseif(request()->path() == 'admin/slider/add') active
                 @elseif(request()->is('admin/slider/edit/*')) active
                 @endif">
                  <i class="far fa-sliders-h"></i>
                  <p>{{ __('Slider') }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.ebanner') . '?language=' . $lang_code }}" class="nav-link
                 @if(request()->path() == 'admin/ebanner') active
                 @elseif(request()->path() == 'admin/ebanner/add') active
                 @elseif(request()->is('admin/ebanner/edit/*')) active
                 @endif">
                  <i class="far fa-image-polaroid"></i>
                  <p>{{ __('E-Banner') }}</p>
                </a>
            </li>

            <li class="nav-item has-treeview
                @if(request()->path() == 'admin/currency') menu-open
                @elseif(request()->path() == 'admin/payment/gateways') menu-open
                @elseif(request()->path() == 'admin/shipping/methods') menu-open
                @elseif(request()->path() == 'admin/currency/add') menu-open
                @elseif(request()->path() == 'admin/shipping/method/add') menu-open
                @elseif(request()->is('admin/currency/edit/*')) menu-open
                @elseif(request()->is('admin/payment/gateway/edit/*')) menu-open
                @elseif(request()->is('admin/shipping/method/edit/*')) menu-open
                @endif">
                <a href="#" class="nav-link
                @if(request()->path() == 'admin/currency') active
                @elseif(request()->path() == 'admin/payment/gateways') active
                @elseif(request()->path() == 'admin/shipping/methods') active
                @elseif(request()->path() == 'admin/currency/add') active
                @elseif(request()->path() == 'admin/shipping/method/add') active
                @elseif(request()->is('admin/currency/edit/*')) active
                @elseif(request()->is('admin/payment/gateway/edit/*')) active
                @elseif(request()->is('admin/shipping/method/edit/*')) active
                @endif">
                <i class="nav-icon far fa-credit-card"></i>
                <p>
                    {{ __('Payment Settings') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.currency') }}" class="nav-link
                        @if(request()->path() == 'admin/currency') active
                        @elseif(request()->path() == 'admin/currency/add') active
                        @elseif(request()->is('admin/currency/edit/*')) active
                        @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Currencies') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.payment') }}" class="nav-link
                        @if(request()->path() == 'admin/payment/gateways') active
                        @elseif(request()->is('admin/payment/gateway/edit/*')) active
                        @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Payment Gateway') }}</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.shipping') . '?language=' . $lang_code }}" class="nav-link
                        @if(request()->path() == 'admin/shipping/methods') active
                        @elseif(request()->path() == 'admin/shipping/method/add') active
                        @elseif(request()->is('admin/shipping/method/edit/*')) active
                        @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Shipping Method') }}</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview
                @if(request()->path() == 'admin/product') menu-open
                @elseif(request()->path() == 'admin/product/product-category') menu-open
                @elseif(request()->path() == 'admin/product/product-category/add') menu-open
                @elseif(request()->path() == 'admin/product/add') menu-open
                @elseif(request()->path() == 'admin/product/all/orders') menu-open
                @elseif(request()->path() == 'admin/product/pending/orders') menu-open
                @elseif(request()->path() == 'admin/product/processing/orders') menu-open
                @elseif(request()->path() == 'admin/product/completed/orders') menu-open
                @elseif(request()->path() == 'admin/product/rejected/orders') menu-open
                @elseif(request()->is('admin/product/product-category/edit/*')) menu-open
                @elseif(request()->is('admin/product/product-category/subcategory/*')) menu-open
                @elseif(request()->is('admin/product/product-category/subcategory/edit/*')) menu-open
                @elseif(request()->is('admin/product/edit/*')) menu-open
                @elseif(request()->is('admin/product/orders/detais/*')) menu-open
                @endif">
                <a href="#" class="nav-link
                    @if(request()->path() == 'admin/product') active
                    @elseif(request()->path() == 'admin/product/product-category') active
                    @elseif(request()->path() == 'admin/product/product-category/add') active
                    @elseif(request()->path() == 'admin/product/add') active
                    @elseif(request()->path() == 'admin/product/pending/orders') active
                    @elseif(request()->path() == 'admin/product/all/orders') active
                    @elseif(request()->path() == 'admin/product/processing/orders') active
                    @elseif(request()->path() == 'admin/product/completed/orders') active
                    @elseif(request()->path() == 'admin/product/rejected/orders') active
                    @elseif(request()->is('admin/product/product-category/edit/*')) active
                    @elseif(request()->is('admin/product/product-category/subcategory/*')) active
                    @elseif(request()->is('admin/product/product-category/subcategory/edit/*')) active
                    @elseif(request()->is('admin/product/edit/*')) active
                    @elseif(request()->is('admin/product/orders/detais/*')) active
                    @endif">
                    <i class="nav-icon fab fa-product-hunt"></i>
                    <p>
                        {{ __('Products') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.product.category') . '?language=' . $lang_code }}" class="nav-link
                        @if(request()->path() == 'admin/product/product-category') active
                        @elseif(request()->path() == 'admin/product/product-category/add') active
                        @elseif(request()->is('admin/product/product-category/subcategory/*')) active
                        @elseif(request()->is('admin/product/product-category/subcategory/edit/*')) active
                        @elseif(request()->is('admin/product/product-category/edit/*')) active
                        @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Product Categories') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.product') . '?language=' . $lang_code }}" class="nav-link
                        @if(request()->path() == 'admin/product') active
                        @elseif(request()->path() == 'admin/product/add') active
                        @elseif(request()->is('admin/product/edit/*')) active
                        @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Products') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.all.product.orders') }}"
                        class="nav-link @if(request()->path() == 'admin/product/all/orders') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('All Order') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pending.product.orders') }}"
                        class="nav-link @if(request()->path() == 'admin/product/pending/orders') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Pending Order') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.processing.product.orders') }}" class="nav-link
                            @if(request()->path() == 'admin/product/processing/orders') active
                            @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('In Progress Order') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.completed.product.orders') }} " class="nav-link
                            @if(request()->path() == 'admin/product/completed/orders') active
                            @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Completed Order') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href=" {{ route('admin.rejected.product.orders') }}" class="nav-link
                            @if(request()->path() == 'admin/product/rejected/orders') active
                            @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Rejected Order') }}</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.message')}}" class="nav-link
                @if(request()->path() == 'admin/messages') active
                @endif">
                  <i class="nav-icon fas fa-envelope"></i>
                  <p>
                    {{ __('Messages') }}
                  </p>
                </a>
            </li>

        <li class="nav-item has-treeview
            @if(request()->path() == 'admin/subscriber') menu-open
            @elseif(request()->path() == 'admin/mailsubscriber') menu-open
            @elseif(request()->path() == 'admin/subscriber/add') menu-open
            @elseif(request()->is('admin/subscriber/edit/*')) menu-open
            @endif">
            <a href="#" class="nav-link
                @if(request()->path() == 'admin/subscriber') active
                @elseif(request()->path() == 'admin/subscriber/add') active
                @elseif(request()->path() == 'admin/mailsubscriber') active
                @elseif(request()->is('admin/subscriber/edit/*')) active
                @endif">
                <i class="nav-icon fas fa-envelope-open-text"></i>
                <p>
                    {{ __('Newsletters') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.newsletter') }}" class="nav-link
                    @if(request()->path() == 'admin/subscriber') active
                    @elseif(request()->path() == 'admin/subscriber/add') active
                    @elseif(request()->is('admin/subscriber/edit/*')) active
                    @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('Subscribers') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.mailsubscriber') }}"
                    class="nav-link @if(request()->path() == 'admin/mailsubscriber') active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Mail To Subscribers') }}</p>
                    </a>
                </li>
            </ul>
        </li>

            <li class="nav-item">
            <a href="{{ route('admin.client')}}" class="nav-link
            @if(request()->path() == 'admin/client') active
            @elseif(request()->path() == 'admin/client/add') active
            @elseif(request()->is('admin/client/edit/*')) active
            @endif">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                {{ __('Client') }}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.dynamic_page'). '?language=' . $lang_code }}"
                class="nav-link @if(request()->path() == 'admin/dynamic-page') active @endif">

                <i class="nav-icon  fab fa-sith"></i>
                <p>
                    {{ __('Dynamic Page') }}
                </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.language.index') }}" class="nav-link
            @if(request()->path() == 'admin/languages') active
            @elseif(request()->path() == 'admin/language/add') active
            @elseif(request()->is('admin/language/edit/*')) active
            @elseif(request()->is('admin/language/edit/keyword/*')) active
            @endif">
              <i class="nav-icon fas fa-language"></i>
              <p>
                {{ __('Language') }}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.footer.index') . '?language=' . $lang_code }}" class="nav-link @if(request()->path() == 'admin/footer') active @endif">
              <i class="nav-icon fas fa-feather-alt"></i>
              <p>
                {{ __('Footer') }}
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
