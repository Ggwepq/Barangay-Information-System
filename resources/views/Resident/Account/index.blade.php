@extends('adminlte::page')

@section('title', 'Resident Accounts')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Resident Accounts</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/Resident') }}">Home</a></li>
                    <li class="breadcrumb-item active">Resident Accounts</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')

    <div class="card card-outline card-navy">
        <div class="card-header with-border d-inline-flex">
            <h6 class="mr-auto mt-2"><i class="fa fa-list"></i> List of Resident Accounts</h6>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped dataTable dtr-inline">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $posts)
                        <tr>
                            <td><img src="{{ asset($posts->Resident->image) }}" width="100px" style="max-width:100px;">
                            </td>
                            <td>{{ $posts->Resident->firstName }} {{ $posts->Resident->middleName }}
                                {{ $posts->Resident->lastName }}</td>
                            <td>{{ $posts->email }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#editModal-{{ $posts->id }}">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deactivateModal-{{ $posts->id }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>

                                <!-- Reactivate Modal -->
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
                                                <a href="{{ url('admin/Resident/Edit/' . $posts->residentId) }}"
                                                    class="btn btn-primary">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
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
                                                <a href="{{ url('admin/Resident/Deactivate/' . $posts->id) }}"
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
            <div class="form-group float-left">
                <label class="checkbox-inline"><input type="checkbox"
                        onclick="document.location='{{ url('/admin/Resident/Soft') }}';" id="showDeactivated"> Show
                    deactivated records</label>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();
        })
    </script>

    @if (session('success'))
        <script type="text/javascript">
            toastr.success('{{ session('success') }}', 'Success!');
        </script>
    @endif
    @if (session('error'))
        <script type="text/javascript">
            toastr.error('{{ session('error') }}', "There's something wrong!");
        </script>
    @endif
@stop
