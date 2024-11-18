@extends('adminlte::page')

@section('title', 'Business')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Business</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Business</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Business Management</h3>
            <div class="card-tools">
                <a href="{{ url('/admin/Business/Create') }}" class="btn btn-success btn-sm">New Business</a>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Business</th>
                        <th>Address</th>
                        <th>Owner</th>
                        <th>Date of Registration</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $posts)
                        <tr>
                            <td>{{ $posts->name }}</td>
                            <td>{{ $posts->street }} {{ $posts->brgy }} {{ $posts->city }}</td>
                            <td>{{ $posts->Resident->firstName }} {{ $posts->Resident->lastName }}</td>
                            <td>{{ Carbon\Carbon::parse($posts->created_at)->toFormattedDateString() }}</td>
                            <td>
                                <a href="{{ url('/admin/Business/Reactivate/' . $posts->id) }}"
                                    onclick="return confirm('Are you sure you want to reactivate this record?')"
                                    class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"
                                    title="Reactivate record">
                                    <i class="fas fa-recycle"></i>
                                </a>
                                <a href="{{ url('/admin/Business/Remove/' . $posts->id) }}"
                                    onclick="return confirm('Are you sure you want to delete this record?')"
                                    class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                    title="Delete record">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="showDeactivated">
                    <label class="custom-control-label" onclick="document.location='{{ url('/admin/Business') }}';"
                        for="showDeactivated">Show active records</label>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
@stop
