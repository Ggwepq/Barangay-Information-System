@extends('adminlte::page')

@section('title', 'Position')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Positions</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Position</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header with-border d-inline-flex">
            <h6 class="mr-auto mt-2"><i class="fa fa-list"></i> List of Availabe Positions</h6>
            <div class="card-tools ml-auto ">
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createModal">
                    <i class="fa fa-plus" aria-hidden="true"></i> New Position
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped dataTable dtr-inline">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Limit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $posts)
                        <tr>
                            <td>{{ $posts->position_name }}</td>
                            <td>{{ $posts->position_limit }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#editModal-{{ $posts->id }}">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deactivateModal-{{ $posts->id }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>

                                <!-- Create Modal -->
                                <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createModalLabel">Edit Record</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form action="{{ url('/admin/Position/Store') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <label>Position<span style="color:Red;">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ old('position_name') }}" name="position_name"
                                                                    id="position_name" placeholder="Position Name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Limit<span style="color:Red;">*</span></label>
                                                                <input type="number" class="form-control"
                                                                    value="{{ old('position_limit') }}"
                                                                    name="position_limit" id="position_limit"
                                                                    placeholder="Limit">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</a>
                                                    <button type="submit" class="btn btn-primary">Create</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Modal -->
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
                                            <form action="{{ url('/admin/Position/Update/' . $posts->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <label>Position<span style="color:Red;">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $posts->position_name }}"
                                                                    name="position_name" id="position_name"
                                                                    placeholder="Position Name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Limit<span style="color:Red;">*</span></label>
                                                                <input type="number" class="form-control"
                                                                    value="{{ $posts->position_limit }}"
                                                                    name="position_limit" id="position_limit"
                                                                    placeholder="Limit">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</a>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
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
                                                <a href="{{ url('admin/Position/Deactivate/' . $posts->id) }}"
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
                        onclick="document.location='{{ url('/admin/Position/Soft') }}';" id="showDeactivated"> Show
                    deactivated records</label>
            </div>
        </div>
    </div>
@endsection

@section('js')
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
