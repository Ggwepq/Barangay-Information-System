@extends('adminlte::page')

@section('title', 'Court Scheduling')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Court Scheduling</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li> {{-- Assuming your admin dashboard route is /admin/dashboard --}}
                    <li class="breadcrumb-item active">Basketball Court Scheduling</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header with-border d-inline-flex">
            <h6 class="mr-auto mt-2"><i class="fa fa-list"></i> List of Court Schedules</h6>
        </div>
        <div class="card-body"> {{-- Changed box-body to card-body --}}
            <table id="datatable" class="table table-bordered table-striped dataTable dtr-inline">
                {{-- Updated table classes for AdminLTE --}}
                <thead>
                    <tr>
                        <th>Resident</th>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Officer-in-Charge</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $posts)
                        <tr>
                            <td>{{ $posts->Resident->firstName }} {{ $posts->Resident->middleName }}
                                {{ $posts->Resident->lastName }}</td>
                            <td>{{ \Carbon\Carbon::parse($posts->date)->format('F j, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($posts->start)->format('g:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($posts->end)->format('g:i A') }}</td>
                            <td>{{ $posts->Officer->Resident->firstName }} {{ $posts->Officer->Resident->middleName }}
                                {{ $posts->Officer->Resident->lastName }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#editModal-{{ $posts->id }}">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deactivateModal-{{ $posts->id }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>

                                <!-- Update Modal -->
                                <div class="modal fade" id="editModal-{{ $posts->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to edit this record?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <a href="{{ url('/admin/Schedule/Edit/' . $posts->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deactivate Modal -->
                                <div class="modal fade" id="deactivateModal-{{ $posts->id }}" tabindex="-1"
                                    aria-labelledby="deactivateModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deactivateModalLabel">Deactivate Record</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to deactivate this record?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <a href="{{ url('admin/Schedule/Deactivate/' . $posts->id) }}"
                                                    class="btn btn-danger">Deactivate</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group float-left mt-3">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="showDeactivated"
                        onclick="document.location='{{ url('/admin/Schedule/Soft') }}';">
                    <label for="showDeactivated" class="custom-control-label">Show deactivated records</label>
                </div>
            </div>
        </div>
    </div>
@stop


@section('js')
    <script></script>
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success!');
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error('{{ session('error') }}', "There's something wrong!");
        </script>
    @endif
@stop
