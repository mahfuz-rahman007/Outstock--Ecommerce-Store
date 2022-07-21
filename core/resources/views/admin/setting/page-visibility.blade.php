@extends('admin.layout')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Page Visibility') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a> </li>
                        <li class="breadcrumb-item">{{ __('Page Visibility') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <form  class="form-horizontal col-12" action="{{ route('admin.updatePagevisibility') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Home Page Section Visibility') }}</h3>
                                </div>
                                <div class="card-body">

                                        <div class="form-group row">
                                            <label for="" class="col-sm-5 control-label">{{ __('Home Section') }}<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                                <input type="checkbox" {{ $commonsetting->is_hero_section == '1' ? 'checked':'' }} name="is_hero_section" data-size="large"  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible" >
                                                @if ($errors->has('is_hero_section'))
                                                <p class="text-danger"> {{ $errors->first('is_hero_section') }} </p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-5 control-label">{{ __('Trending Section') }}<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                                <input type="checkbox" {{ $commonsetting->is_trending_section == '1' ? 'checked':'' }} name="is_trending_section" data-size="large"  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible" >
                                                @if ($errors->has('is_trending_section'))
                                                <p class="text-danger"> {{ $errors->first('is_trending_section') }} </p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-5 control-label">{{ __('Product Section') }}<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                                <input type="checkbox" {{ $commonsetting->is_product_section == '1' ? 'checked':'' }} name="is_product_section" data-size="large"  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible" >
                                                @if ($errors->has('is_product_section'))
                                                <p class="text-danger"> {{ $errors->first('is_product_section') }} </p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-5 control-label">{{ __('Client Section') }}<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                                <input type="checkbox" {{ $commonsetting->is_client_section == '1' ? 'checked':'' }} name="is_client_section" data-size="large"  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible" >
                                                @if ($errors->has('is_client_section'))
                                                <p class="text-danger"> {{ $errors->first('is_client_section') }} </p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-5 control-label">{{ __('Blog Section') }}<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                                <input type="checkbox" {{ $commonsetting->is_blog_section == '1' ? 'checked':'' }} name="is_blog_section" data-size="large"  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible" >
                                                @if ($errors->has('is_blog_section'))
                                                <p class="text-danger"> {{ $errors->first('is_blog_section') }} </p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-5 control-label">{{ __('Newsletter Section') }}<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                                <input type="checkbox" {{ $commonsetting->is_newsletter_section == '1' ? 'checked':'' }} name="is_newsletter_section" data-size="large"  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible" >
                                                @if ($errors->has('is_newsletter_section'))
                                                <p class="text-danger"> {{ $errors->first('is_newsletter_section') }} </p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-5 control-label">{{ __('Shop Page') }}<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                                <input type="checkbox" {{ $commonsetting->is_shop_page == '1' ? 'checked':'' }} name="is_shop_page" data-size="large"  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible" >
                                                @if ($errors->has('is_shop_page'))
                                                <p class="text-danger"> {{ $errors->first('is_shop_page') }} </p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-5 control-label">{{ __('Blog Page') }}<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                                <input type="checkbox" {{ $commonsetting->is_blog_page == '1' ? 'checked':'' }} name="is_blog_page" data-size="large"  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible" >
                                                @if ($errors->has('is_blog_page'))
                                                <p class="text-danger"> {{ $errors->first('is_blog_page') }} </p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-5 control-label">{{ __('Contact Page') }}<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                                <input type="checkbox" {{ $commonsetting->is_contact_page == '1' ? 'checked':'' }} name="is_contact_page" data-size="large"  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible" >
                                                @if ($errors->has('is_contact_page'))
                                                <p class="text-danger"> {{ $errors->first('is_contact_page') }} </p>
                                                @endif
                                            </div>
                                        </div>


                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Page Visibility') }}</h3>
                                </div>
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label for="" class="col-sm-5 control-label">{{ __('Cooki Alert') }}<span
                                        class="text-danger">*</span></label>
                                        <div class="col-sm-7">
                                            <input type="checkbox" {{ $commonsetting->is_cooki_alert == '1' ? 'checked':'' }} name="is_cooki_alert" data-size="large"  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Visible" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Invisible" >
                                            @if ($errors->has('is_cooki_alert'))
                                            <p class="text-danger"> {{ $errors->first('is_cooki_alert') }} </p>
                                            @endif
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mt-4">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-block">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
