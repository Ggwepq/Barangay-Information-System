@extends('adminlte::page')

@section('title', 'Blotter Records')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Blotter Records</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Blotter Records</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
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

    <div class="card card-danger">
        <div class="card-header with-border d-inline-flex">
            <h6 class="mr-auto mt-2"><i class="fa fa-list"></i> List of Deactivated Blotter Records</h6>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped dataTable dtr-inline">
                <thead>
                    <tr>
                        <th>Case No.</th>
                        <th>Complainant</th>
                        <th>Complained Resident</th>
                        <th>Date of Filing</th>
                        <th>Person-in-charge</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $posts)
                        <tr>
                            <?php $caseNo = str_pad($posts->id, 5, '0', STR_PAD_LEFT); ?>
                            <td><span style="color:red;">{{ $caseNo }}</span></td>
                            <td>{{ $posts->com->firstName }} {{ $posts->com->middleName }} {{ $posts->com->lastName }}</td>
                            <td>{{ $posts->comRes->firstName }} {{ $posts->comRes->middleName }}
                                {{ $posts->comRes->lastName }}</td>
                            <td>{{ Carbon\Carbon::parse($posts->created_at)->toFormattedDateString() }}</td>
                            <td>{{ $posts->officerCharge }}</td>
                            <td>{{ $posts->description }}</td>
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
                                                <a href="{{ url('admin/Blotter/Reactivate/' . $posts->id) }}"
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
                                                <a href="{{ url('admin/Blotter/Remove/' . $posts->id) }}"
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
            <div class="form-group float-left">
                <label class="checkbox-inline">
                    <input type="checkbox" onclick="location.href='{{ url('admin/Blotter') }}';" id="showDeactivated"> Show
                    active records
                </label>
            </div>
        </div>
    </div>
@stop

@section('js')
@stop
