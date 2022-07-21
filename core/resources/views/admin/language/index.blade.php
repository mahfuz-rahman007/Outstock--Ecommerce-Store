
@extends('admin.layout')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Languages') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                <li class="breadcrumb-item">{{ __('Languages') }}</li>
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
                            <h3 class="card-title mt-1">{{ __('Languages List') }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.language.add') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> {{ __('Add Language') }}
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (count($languages) == 0)
                                <h3 class="text-center">NO LANGUAGE FOUND</h3>
                            @else
                            <table class="table table-striped table-bordered data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Code') }}</th>
                                        <th>{{ __('Direction') }}</th>
                                        <th>{{ __('Default') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($languages as $id=>$language)
                                    <tr>
                                        <td>{{ ++$id }}</td>
                                        <td>{{$language->name}}</td>
                                        <td>{{$language->code}}</td>
                                        <td class="text-uppercase">{{$language->direction}}</td>
                                        <td>
                                            @if ($language->is_default == 1)
                                            <strong class="btn btn-success btn-xs">Default</strong>
                                            @else
                                            <form class="d-inline-block" action="{{route('admin.language.default', $language->id)}}" method="post">
                                                @csrf
                                                <button class="btn btn-primary btn-xs" type="submit" name="button">Make Default</button>
                                            </form>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{route('admin.language.editKeyword', $language->id)}}">
                                            <i class="fas fa-edit"></i>
                                            {{ __('Edit Keyword') }}
                                            </a>
                                            <a class="btn btn-primary btn-sm" href="{{route('admin.language.edit', $language->id)}}">
                                                <i class="fas fa-pencil-alt"></i>{{ __('Edit') }}
                                            </a>
                                            <form class="deleteform d-inline-block" action="{{route('admin.language.delete', $language->id)}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm deletebtn">
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
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
@endsection
