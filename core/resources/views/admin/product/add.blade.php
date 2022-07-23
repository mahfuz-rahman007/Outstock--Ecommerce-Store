@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Product') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Product') }}</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title mt-1">{{ __('Add Product') }}</h3>
                                <div class="card-tools">
                                    <a href="{{ route('admin.product'). '?language=' . $currentLang->code }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <form class="form-horizontal" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label">{{ __('Image') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <img class="mw-400 mb-3 show-img img-demo" src="{{ asset('assets/admin/img/img-demo.jpg') }}" alt="">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="image">{{ __('Choose Image') }}</label>
                                                <input type="file" class="custom-file-input up-img" name="image" id="image">
                                            </div>
                                            @if ($errors->has('image'))
                                                <p class="text-danger"> {{ $errors->first('image') }} </p>
                                            @endif
                                            <p class="help-block text-info">{{ __('Upload 270X290 (Pixel) Size image for best quality.
                                                Only jpg, jpeg, png image is allowed.') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="language_id" class="col-sm-2 control-label">{{ __('Language') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <select name="language_id" class="form-control" id="select_language" data-href="{{ route('admin.helper.category') . '?table=product_categories'}}">
                                                <option value="" selected disabled>{{__('Select a language')}}</option>
                                                @foreach ($langs as $lang)
                                                    <option value="{{$lang->id}}" {{ old('language_id') == $lang->id ? 'selected' : '' }} >{{$lang->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('language_id'))
                                                <p class="text-danger"> {{ $errors->first('language_id') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="title" class="col-sm-2 control-label">{{ __('Title') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="title" placeholder="{{ __('Title') }}" value="{{ old('title') }}">
                                            @if ($errors->has('title'))
                                                <p class="text-danger"> {{ $errors->first('title') }} </p>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="category_id" class="col-sm-2 control-label">{{ __('Category') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <select class="form-control" name="category_id" id="select_category"  data-href="{{ route('admin.helper.subcategory') . '?table=product_sub_categories'}}">

                                            </select>
                                            @if ($errors->has('category_id'))
                                                <p class="text-danger"> {{ $errors->first('category_id') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="category_id" class="col-sm-2 control-label">{{ __('Sub-Category') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <select class="form-control" name="subcategory_id" id="select_sub_category">

                                            </select>
                                            @if ($errors->has('subcategory_id'))
                                                <p class="text-danger"> {{ $errors->first('subcategory_id') }} </p>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="current_price" class="col-sm-2 control-label">{{ __('Current Price') }} ($)<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <input type="number"  step="any"class="form-control" name="current_price" placeholder="{{ __('Current Price') }}" value="{{ old('current_price') }}">
                                            @if ($errors->has('current_price'))
                                                <p class="text-danger"> {{ $errors->first('current_price') }} </p>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label for="previous_price" class="col-sm-2 control-label">{{ __('Previous Price') }} ($)<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <input type="number" step="any" class="form-control" name="previous_price" placeholder="{{ __('Previous Price') }}" value="{{ old('previous_price') }}">
                                            @if ($errors->has('previous_price'))
                                                <p class="text-danger"> {{ $errors->first('previous_price') }} </p>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label for="stock" class="col-sm-2 control-label">{{ __('Product Stock Quantity') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <input type="number" min="1"  class="form-control" name="stock" placeholder="{{ __('Product Stock Quantity') }}" value="{{ old('stock') }}">
                                            @if ($errors->has('stock'))
                                                <p class="text-danger"> {{ $errors->first('stock') }} </p>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="short_description" class="col-sm-2 control-label">{{ __('Short Description') }} <span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="short_description" placeholder="{{ __('Short Description') }}"  rows="2">{{ old('short_description') }}</textarea>
                                            @if ($errors->has('short_description'))
                                                <p class="text-danger"> {{ $errors->first('short_description') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-sm-2 control-label">{{ __('Description') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                                <textarea name="description" rows="4" class="form-control summernote" id="ck" placeholder="{{ __('Description') }}">{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <p class="text-danger"> {{ $errors->first('description') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                        <div class="form-group row">
                                            <label for="file" class="col-sm-2 control-label">{{ __('Product Gallery Images') }}</label>
                                            <div class="col-sm-10">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#setgallery">
                                                    <i class="fas fa-cloud-upload-alt"></i> {{ __('Upload Gallery Images') }}
                                                </a>
                                                <p class="help-block text-info">{{ __('Upload 540X540 (Pixel) Size image for best quality.
                                                    Only jpg, jpeg, png image is allowed.') }}
                                                </p>
                                            </div>
                                        </div>

                                    <input type="file" name="gallery[]" class="d-none" id="uploadgallery" accept="image/*" multiple>


                                    <div class="form-group row">
                                        <label for="meta_tags" class="col-sm-2 control-label">{{ __('Meta Tags') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" data-role="tagsinput" name="meta_tags" placeholder="{{ __('Meta Tags') }}" value="{{ old('meta_tags') }}">
                                            @if ($errors->has('meta_tags'))
                                                <p class="text-danger"> {{ $errors->first('meta_tags') }} </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="meta_description" class="col-sm-2 control-label">{{ __('Meta Description') }}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="meta_description" placeholder="{{ __('Meta Description') }}"  rows="4">{{ old('meta_description') }}</textarea>
                                            @if ($errors->has('meta_description'))
                                                <p class="text-danger"> {{ $errors->first('meta_description') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-2 control-label">{{ __('Status') }}<span class="text-danger">*</span></label>

                                        <div class="col-sm-10">
                                            <select class="form-control" name="status">
                                            <option value="0"  >{{ __('Unpublish') }}</option>
                                            <option value="1" selected>{{ __('Publish') }}</option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <p class="text-danger"> {{ $errors->first('status') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
<div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Upload Gallery Images') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="top-area">
					<div class="row">
						<div class="col-sm-6 text-right">
							<div class="upload-img-btn btn btn-primary ">
								<label for="image-upload mb-0" id="prod_gallery">
                                    <i class="fas fa-cloud-upload-alt mr-1"></i>{{ __('Upload File') }}</label>
							</div>
						</div>
						<div class="col-sm-6">
							<a href="javascript:;" class="upload-done btn btn-success" data-dismiss="modal">
                                <i class="fas fa-check-circle mr-1"></i> {{ __('Done') }}</a>
						</div>
						<div class="col-sm-12 text-center mt-4">( <small>{{ __('You can upload multiple Images.') }}</small>
							)</div>
					</div>
				</div>
				<div class="gallery-images">
					<div class="selected-image">
						<div class="row">


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

