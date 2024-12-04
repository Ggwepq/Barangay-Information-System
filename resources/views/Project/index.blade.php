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
    <div class="card card-outline card-navy">
        <div class="card-header with-border d-inline-flex">
            <h6 class="mr-auto mt-2"><i class="fa fa-list"></i> List of Barangay Projects</h6>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped dataTable dtr-inline">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Developer</th>
                        <th>Project Started</th>
                        <th>Project Ended</th>
                        <th>Status</th>
                        <th>Officer in Charge</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $posts)
                        <tr>
                            <td>{{ $posts->projectName }}</td>
                            <td>{{ $posts->resident->firstName }}</td>
                            <td>{{ Carbon\Carbon::parse($posts->dateStarted)->toFormattedDateString() }}</td>
                            <td>{{ Carbon\Carbon::parse($posts->dateEnded)->toFormattedDateString() }}</td>
                            @if ($posts->status == 1)
                                <td><span class="badge bg-warning p-2">{{ $posts->status }}</span></td>
                            @elseif($posts->status == 2)
                                <td><span class="badge bg-primary p-2">{{ $posts->status }}</span></td>
                            @else
                                <td><span class="badge bg-success p-2">{{ $posts->status }}</span></td>
                            @endif
                            <td>{{ $posts->officer->resident->firstName }}</td>
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
