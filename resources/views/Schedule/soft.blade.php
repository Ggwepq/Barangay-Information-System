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
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Court Scheduling</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')


    <div class="card card-danger">
        <div class="card-header with-border d-inline-flex">
            <h6 class="mr-auto mt-2"><i class="fa fa-list"></i> List of Deactivated Court Schedules</h6>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped dataTable dtr-inline">
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
                                                <a href="{{ url('/admin/Schedule/Reactivate/' . $posts->id) }}"
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
                                                <a href="{{ url('/admin/Schedule/Remove/' . $posts->id) }}"
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
            <div class="form-group float-left mt-3"> {{-- Added mt-3 for spacing --}}
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="showDeactivated"
                        onclick="document.location='{{ url('/admin/Schedule') }}';">
                    <label class="custom-control-label" for="showDeactivated">Show active records</label>
                </div>
            </div>

        </div>
    </div>

@stop



@section('js')
    <script>
        function reacForm() {
            return confirm("Are you sure you want to reactivate this record?");
        }

        function deleteForm() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>

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
