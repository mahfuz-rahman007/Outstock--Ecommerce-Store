@extends('admin.layout')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ $pcategory->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a> </li>
                        <li class="breadcrumb-item">{{ $pcategory->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Add Sub Category') }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.product.category'). '?language=' . $currentLang->code }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                </a>
                            </div>
                        </div>


                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('admin.product.subcategory.store') }}" method="POST" >
                                @csrf
                                <input type="hidden" name="category_id" value="{{ $pcategory->id }}">

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 control-label">{{ __('Name') }}<span class="text-danger">*</span></label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <p class="text-danger"> {{ $errors->first('name') }} </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 control-label">{{ __('Status') }}<span class="text-danger">*</span></label>

                                    <div class="col-sm-10">
                                        <select class="form-control" name="status">
                                           <option value="1">{{ __('Publish') }}</option>
                                           <option value="0">{{ __('Unpublish') }}</option>
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


                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Sub-Category List For') }} {{ $pcategory->name }}</h3>
                        </div>

                        <div class="card-body">
                            @if (count($psubcategories) == 0)
                                <h3 class="text-center">No Sub-Category Found</h3>
                            @else
                                <table class="table table-striped table-bordered data_table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Name(Product)') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($psubcategories as $id => $psubcategory)
                                            <tr>
                                                <td>{{ ++$id }}</td>
                                                <td>{{ $psubcategory->name }}( {{ count($psubcategory->products) }} )</td>
                                                <td>
                                                    @if($psubcategory->status == 1)
                                                        <span class="badge badge-success">{{ __('Publish') }}</span>
                                                    @else
                                                        <span class="badge badge-warning">{{ __('Unpublish') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.product.subcategory.edit',$psubcategory->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>{{ __('Edit') }}
                                                    </a>
                                                    <form id="deleteform" class="deleteform d-inline-block" action="{{ route('admin.product.subcategory.delete', $psubcategory->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm deletebtn"
                                                            id="delete">
                                                            <i class="fas fa-trash"></i>{{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
