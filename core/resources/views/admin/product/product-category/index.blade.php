@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Product Categories') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Products') }}</li>
            <li class="breadcrumb-item">{{ __('Categories') }}</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Product Categories List') }}</h3>
                        <div class="card-tools d-flex">
                            <div class="d-inline-block mr-4">
                                <select class="form-control lang" id="languageSelect" data="{{url()->current() . '?language='}}">
                                    @foreach($langs as $lang)
                                        <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <a href="{{ route('admin.product.category.add') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> {{ __('Add Category') }}
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                    <table id="idtable" class="table table-bordered table-striped data_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name(Product)') }}</th>
                                <th>{{ __('Popular') }}</th>
                                <th>{{ __('Sub-Categories') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pcategory as $id=>$category)
                            <tr>
                                <td>
                                    {{ ++$id }}
                                </td>
                                <td>
                                    {{ $category->name }}( {{ count($category->products) }} )
                                </td>
                                <td>
                                    <form id="popularStatusForm{{$category->id}}" class="d-inline-block" action="{{route('admin.product.category.makePopular')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="category_id" value="{{$category->id}}">
                                        <select class="form-control form-control-sm
                                        @if ($category->is_popular == 1)
                                          bg-warning
                                        @else
                                          bg-info
                                        @endif
                                        " name="is_popular" onchange="document.getElementById('popularStatusForm{{$category->id}}').submit();">
                                          <option value="0" {{$category->is_popular == '0' ? 'selected' : ''}}>Disable</option>
                                          <option value="1" {{$category->is_popular == '1' ? 'selected' : ''}}>Enable</option>
                                        </select>
                                      </form>
                                </td>
                                <td>
                                   <a href="{{ route('admin.product.subcategory',$category->id) }}"><button type="button" class="btn btn-primary btn-sm">{{ __('Sub Categories ') }}  ({{count($category->productsubcategories) }})</button></a>
                                </td>
                                <td>
                                    @if($category->status == 1)
                                        <span class="badge badge-success">{{ __('Publish') }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ __('Unpublish') }}</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.product.category.edit', $category->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>

                                    <form  id="deleteform" class="d-inline-block" action="{{ route('admin.product.category.delete', $category->id ) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $category->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                        <i class="fas fa-trash"></i>{{ __('Delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>



@endsection
