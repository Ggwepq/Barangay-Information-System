@extends('adminlte::page')

@section('title', 'Officers')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Officer Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Officers</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')



    <div class="card card-danger">
        <div class="card-header with-border d-inline-flex">
            <h6 class="mr-auto mt-2"><i class="fa fa-list"></i> List of Deactivated Barangay Officers</h6>
        </div>
        <div class="card-body"> {{-- Updated box-body to card-body --}}
            <table id="datatable" class="table table-bordered table-striped dataTable dtr-inline">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $posts)
                        <tr>
                            <td>{{ $posts->position }}</td>
                            <td>{{ $posts->Resident->firstName }} {{ $posts->Resident->middleName }}
                                {{ $posts->Resident->lastName }}</td>
                            <td>
                                @if ($posts->Resident->gender == 1)
                                    Male
                                @else
                                    Female
                                @endif
                            </td>
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
                                                <a href="{{ url('admin/Officer/Reactivate/' . $posts->id) }}"
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
                                                <a href="{{ url('admin/Officer/Remove/' . $posts->id) }}"
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
            <div class="form-group pull-right"> {{-- Consider using a more modern approach for alignment --}}
                <div class="custom-control custom-checkbox"> {{-- Updated checkbox styling --}}
                    <input class="custom-control-input" type="checkbox" id="showDeactivated"
                        onclick="document.location='{{ url('/admin/Officer') }}';"> {{-- Updated route URL --}}
                    <label for="showDeactivated" class="custom-control-label">Show active records</label>
                </div>
            </div>

        </div>
    </div>

@stop

@section('js') {{-- Updated script section to js --}}
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
