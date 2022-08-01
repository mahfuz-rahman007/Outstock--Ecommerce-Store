@extends('admin.layout')

@section('content')
{{-- profile Header --}}
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
              <h1 class="m-0 text-dark">{{ __('Section Title') }}</h1>
            </div>
            <div class="col-md-6">
              <div class="breadcrumb float-sm-right">
                  <div class="breadcrumb-item"> <a href="{{ route('admin.dashboard') }}"> <i class="fas fa-home"></i>{{ __('Home') }}</a> </div>
                  <div class="breadcrumb-item">{{ __('Section Title') }}</div>
              </div>
            </div>
        </div>
    </div>
</div>

{{-- profile information --}}
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <div class="card card-primary card-outline">

                  <div class="card-header">
                      <div class="card-title">{{ __('Update Section Title') }}</div>
                      <div class="card-tools d-flex">
                            <div class="d-inline-block mr-4">
                                <select class="form-control lang languageSelect" data="{{ url()->current(). '?language='}}">
                                    @foreach ($langs as $lang)
                                    <option value="{{ $lang->code }}" {{ $lang->code == request()->input('language') ? 'selected':'' }}>{{ $lang->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                  </div>

                  <div class="card-body">
                      <form class="form-horizontal" action="{{ route('admin.updateSectiontitle', $sectiontitle->language_id) }}" method="post" enctype="multipart/form-data">
                          @csrf


                          <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">{{ __('Trending Product Title') }} <span class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="trending_product_title" class="form-control" value="{{ $sectiontitle->trending_product_title }}" placeholder="{{ __('Trending Product Title') }}">
                                @if($errors->has('trending_product_title'))
                                  <p class="text-danger">{{ $errors->first('trending_product_title') }}</p>
                                @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">{{ __('Trending Product Subtitle') }} <span class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="trending_product_sub_title" class="form-control" value="{{ $sectiontitle->trending_product_sub_title }}" placeholder="{{ __('Trending Product Subtitle') }}">
                                @if($errors->has('trending_product_sub_title'))
                                  <p class="text-danger">{{ $errors->first('trending_product_sub_title') }}</p>
                                @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">{{ __('Discount Product Title') }} <span class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="product_title" class="form-control" value="{{ $sectiontitle->product_title }}" placeholder="{{ __('Discount Product Title') }}">
                                @if($errors->has('product_title'))
                                  <p class="text-danger">{{ $errors->first('product_title') }}</p>
                                @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">{{ __('Discount Product Subtitle') }} <span class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="product_sub_title" class="form-control" value="{{ $sectiontitle->product_sub_title }}" placeholder="{{ __('Discount Product Subtitle') }}">
                                @if($errors->has('product_sub_title'))
                                  <p class="text-danger">{{ $errors->first('product_sub_title') }}</p>
                                @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">{{ __('Blog Title') }} <span class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="blog_title" class="form-control" value="{{ $sectiontitle->blog_title }}" placeholder="{{ __('Blog Title') }}">
                                @if($errors->has('blog_title'))
                                  <p class="text-danger">{{ $errors->first('blog_title') }}</p>
                                @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">{{ __('Blog Subtitle') }} <span class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="blog_sub_title" class="form-control" value="{{ $sectiontitle->blog_sub_title }}" placeholder="{{ __('Blog Subtitle') }}">
                                @if($errors->has('blog_sub_title'))
                                  <p class="text-danger">{{ $errors->first('blog_sub_title') }}</p>
                                @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">{{ __('Newsletter Title') }} <span class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="newsletter_title" class="form-control" value="{{ $sectiontitle->newsletter_title }}" placeholder="{{ __('Newsletter Title') }}">
                                @if($errors->has('newsletter_title'))
                                  <p class="text-danger">{{ $errors->first('newsletter_title') }}</p>
                                @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="" class="col-sm-3 control-label">{{ __('Newsletter Subtitle') }} <span class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="newsletter_sub_title" class="form-control" value="{{ $sectiontitle->newsletter_sub_title }}" placeholder="{{ __('Newsletter Subtitle') }}">
                                @if($errors->has('newsletter_sub_title'))
                                  <p class="text-danger">{{ $errors->first('newsletter_sub_title') }}</p>
                                @endif
                            </div>
                          </div>

                          <div class="form-group row">
                              <div class="offset-sm-3 col-sm-10">
                                  <input type="submit" class="btn btn-primary" value="Update">
                              </div>
                          </div>

                      </form>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection
