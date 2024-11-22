@extends('adminlte::page')

@section('title', 'Project Records')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Projects</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Project</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header with-border">
            <h3 class="card-title text-lg">Project</h3>
            <div class="card-tools float-right">
                <a href="{{ url('/admin/Project/Create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> New Project
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Developer</th>
                        <th>Description</th>
                        <th>Project Started</th>
                        <th>Project Ended</th>
                        <th>Officer in Charge</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $posts)
                        <tr>
                            <td>{{ $posts->projectName }}</td>
                            <td>{{ $posts->projectDev }}</td>
                            <td>{{ $posts->description }}</td>
                            <td>{{ Carbon\Carbon::parse($posts->dateStarted)->toFormattedDateString() }}</td>
                            <td>{{ Carbon\Carbon::parse($posts->dateEnded)->toFormattedDateString() }}</td>
                            <td>{{ $posts->officerCharge }}</td>
                            <td>
                                <a href="{{ url('admin/Project/Edit/' . $posts->id) }}" class="btn btn-primary btn-sm"
                                    title="Update record">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ url('admin/Project/Deactivate/' . $posts->id) }}" class="btn btn-danger btn-sm"
                                    title="Deactivate record">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <label class="checkbox-inline"><input type="checkbox"
                        onclick="document.location='{{ url('admin/Project/Soft') }}';" id="showDeactivated"> Show
                    deactivated records</label>
            </div>
        </div>
    </div>
@stop


@section('js')
@stop
