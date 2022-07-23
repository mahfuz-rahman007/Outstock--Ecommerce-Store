@extends('admin.layout')

@section('content')

<div class="content-header">
        <div class="container-fluid">
            <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Message') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                <li class="breadcrumb-item">{{ __('Message') }}</li>
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
                    <h3 class="card-title mt-1">{{ __('Message List') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                    <table id="idtable" class="table table-bordered table-striped data_table">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Subject') }}</th>
                                <th>{{ __('Message') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($messages as $id=>$message)
                        <tr>

                            <td>{{ ++$id }}</td>
                            <td>{{ $message->email }}</td>

                            <td>{{ $message->subject }}</td>
                            <td>{{ $message->message }}</td>
                            <td width="18%">
                                <a href="{{ route('admin.message.send', $message->id) }}" class="btn btn-info btn-sm"><i class="fas fa-paper-plane"></i>{{ __('Send') }}</a>
                                <form id="deleteform" class="deleteform d-inline-block" action="{{ route('admin.message.delete', $message->id) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm deletebtn"
                                        id="delete">
                                        <i class="fas fa-trash"></i>Delete
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
