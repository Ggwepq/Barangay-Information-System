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
            <h6 class="mr-auto mt-2"><i class="fa fa-list"></i> List of Deactivated Barangay Projects</h6>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped dataTable dtr-inline">
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
                            <td>{{ $posts->resident->firstName }}</td>
                            <td>{{ $posts->description }}</td>
                            <td>{{ Carbon\Carbon::parse($posts->dateStarted)->toFormattedDateString() }}</td>
                            <td>{{ Carbon\Carbon::parse($posts->dateEnded)->toFormattedDateString() }}</td>
                            <td>{{ $posts->officer->resident->firstName }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                    data-target="#reactivateModal-{{ $posts->id }}">
                                    <i class="fas fa-recycle"></i> Reactivate
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deleteModal-{{ $posts->id }}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>

                                <!-- Reactivate Modal -->
                                <div class="modal fade" id="reactivateModal-{{ $posts->id }}" tabindex="-1"
                                    aria-labelledby="reactivateModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="reactivateModalLabel">Reactivate Record</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to reactivate this record?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <a href="{{ url('admin/Project/Reactivate/' . $posts->id) }}"
                                                    class="btn btn-primary">Reactivate</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal-{{ $posts->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Delete Record</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this record?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <a href="{{ url('admin/Project/Remove/' . $posts->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <label class="checkbox-inline"><input type="checkbox"
                        onclick="document.location='{{ url('admin/Project') }}';" id="showDeactivated"> Show
                    Active Records</label>
            </div>
        </div>
    </div>
@stop


@section('js')
@stop
