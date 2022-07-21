@extends('admin.layout')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Social Links') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a> </li>
                        <li class="breadcrumb-item">{{ __('Social Links') }}</li>
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
                            <h3 class="card-title">{{ __('Add Social Link') }}</h3>
                        </div>

                        <div class="card-body">
                            <form id="slink" class="form-horizontal" action="{{ route('admin.storeSlinks') }}" method="POST" onsubmit="store(event)" >
                                @csrf

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 control-label">{{ __('Social Icon') }}<span
                                    class="text-danger">*</span></label>


                                    <div class="col-sm-10">
                                        <button class="btn btn-secondary biconpicker" data-iconset="fontawesome5" data-icon="fab fa-facebook-f" role="iconpicker"></button>
                                        <input id="inputIcon" type="hidden" name="icon"  value="">
                                        @if ($errors->has('icon'))
                                        <p class="text-danger"> {{ $errors->first('icon') }} </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="url" class="col-sm-2 control-label">{{ __('Social Url') }}<span
                                    class="text-danger">*</span></label>

                                    <div class="col-sm-10">
                                        <input type="text" name="url" id="url" class="form-control" value="" placeholder="{{ __('Social Url') }}">
                                        @if($errors->has('url'))
                                        <p class="text-danger">{{ $errors->first('url') }}</p>
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
                            <h3 class="card-title">{{ __('Social Links List') }}</h3>
                        </div>

                        <div class="card-body">
                            @if (count($socials) == 0)
                                <h3 class="text-center">No Social Links Found</h3>
                            @else
                                <table class="table table-striped table-bordered data_table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Icon') }}</th>
                                            <th>{{ __('Url') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($socials as $id => $social)
                                            <tr>
                                                <td>{{ ++$id }}</td>
                                                <td>{{ $social->icon }}</td>
                                                <td>{{ $social->url }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.editSlinks',$social->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>{{ __('Edit') }}
                                                    </a>
                                                    <form id="deleteform" class="deleteform d-inline-block" action="{{ route('admin.deleteSlinks', $social->id) }}"
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
