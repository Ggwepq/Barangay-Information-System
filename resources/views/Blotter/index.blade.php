@extends('adminlte::page')

@section('title', 'Blotter')

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
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header with-border d-inline-flex">
            <h6 class="mr-auto mt-2"><i class="fa fa-list"></i> List of Blotter Records</h6>
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
                        <th>Status</th>
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
                            <td>
                                @if ($posts->status == 1)
                                    Pending
                                @elseif($posts->status == 2)
                                    Ongoing
                                @elseif($posts->status == 3)
                                    Resolved Issue
                                @else
                                    File to Action
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#editModal-{{ $posts->id }}">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deactivateModal-{{ $posts->id }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                                @if ($posts->status == 4)
                                    <a href="{{ url('/admin/FiletoAction/Print/' . $posts->id) }}" target="_blank"
                                        type="button" class="btn btn-success btn-sm" data-toggle="tooltip"
                                        data-placement="top" title="File to Action">
                                        <i class="fas fa-print"></i>
                                    </a>
                                @endif

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
                                                <a href="{{ url('admin/Blotter/Edit/' . $posts->id) }}"
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
                                                <a href="{{ url('admin/Blotter/Deactivate/' . $posts->id) }}"
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
            <div class="form-group pull-right">
                <label class="checkbox-inline"><input type="checkbox"
                        onclick="document.location='{{ url('/admin/Blotter/Soft') }}';" id="showDeactivated"> Show
                    deactivated records</label>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function updateForm() {
            var x = confirm("Are you sure you want to modify this record?");
            if (x)
                return true;
            else
                return false;
        }

        function deleteForm() {
            var x = confirm(
                "Are you sure you want to deactivate this record? All items included in this record will also be deactivated."
            );
            if (x)
                return true;
            else
                return false;
        }
    </script>
@stop
