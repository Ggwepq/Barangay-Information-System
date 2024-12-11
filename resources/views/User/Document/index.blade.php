@extends('adminlte::page')

@section('title', 'Document Request')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Requested Documents</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/user/home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Requested Document</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-navy">
        <div class="card-header with-border d-inline-flex">
            <h6 class="mr-auto mt-2"><i class="fa fa-list"></i> List of Requested Documents</h6>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped dataTable dtr-inline">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Document Type</th>
                        <th>Purpose</th>
                        <th>Requested At</th>
                        <th>Approved At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $posts)
                        <tr>
                            <td>#</td>
                            <td>{{ $posts->document_type }}</td>
                            <td>{{ $posts->purpose }}</td>
                            <td>{{ Carbon\Carbon::parse($posts->requested_at)->toFormattedDateString() }}</td>
                            @if ($posts->status == 'Pending' || $posts->status == 'Rejected')
                                <td>-</td>
                            @elseif($posts->status == 'Approved')
                                <td>{{ Carbon\Carbon::parse($posts->approved_at)->toFormattedDateString() }}</td>
                            @endif
                            @if ($posts->status == 'Pending')
                                <td><span class="badge bg-warning p-2">{{ $posts->status }}</span></td>
                            @elseif($posts->status == 'Approved')
                                <td><span class="badge bg-success p-2">{{ $posts->status }}</span></td>
                            @else
                                <td><span class="badge bg-danger p-2">{{ $posts->status }}</span></td>
                            @endif
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deactivateModal-{{ $posts->id }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                                @if ($posts->status == 'Approved')
                                    @if ($posts->document_type == 'Barangay Clearance')
                                        <a href="{{ url('/user/document/barangay-clearance/' . $posts->resident_id) }}"
                                            target="_blank" type="button" class="btn btn-success btn-sm"
                                            data-toggle="tooltip" data-placement="top" title="Barangay Certification">
                                            <i class="fa fa-print" aria-hidden="true"></i>
                                        </a>
                                    @elseif ($posts->document_type == 'Certificate of Indigency')
                                        <a href="{{ url('/user/document/certificate-of-indigency/' . $posts->resident_id) }}"
                                            target="_blank" type="button" class="btn btn-success btn-sm"
                                            data-toggle="tooltip" data-placement="top" title="Certificate of Indigency">
                                            <i class="fa fa-print" aria-hidden="true"></i>
                                        </a>
                                    @elseif ($posts->document_type == 'Certificate of Residency')
                                        <a href="{{ url('/user/document/certificate-of-residency/' . $posts->resident_id) }}"
                                            target="_blank" type="button" class="btn btn-success btn-sm"
                                            data-toggle="tooltip" data-placement="top" title="Certificate of Indigency">
                                            <i class="fa fa-print" aria-hidden="true"></i>
                                        </a>
                                    @elseif ($posts->document_type == 'Certificate of Good Moral Character')
                                        <a href="{{ url('/user/document/certificate-of-good-moral/' . $posts->resident_id) }}"
                                            target="_blank" type="button" class="btn btn-success btn-sm"
                                            data-toggle="tooltip" data-placement="top" title="Certificate of Indigency">
                                            <i class="fa fa-print" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                @endif

                                <!-- Deactivate Modal -->
                                <div class="modal fade" id="deactivateModal-{{ $posts->id }}" tabindex="-1"
                                    aria-labelledby="deactivateModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deactivateModalLabel">Cancel Request</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to cancel this request?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <a href="{{ url('/user/document/delete/' . $posts->id) }}"
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
                <!-- <label class="checkbox-inline"><input type="checkbox" -->
                <!--         onclick="document.location='{{ url('admin/Resident/Soft') }}';" id="showDeactivated"> Show Expired -->
                <!--     Documents</label> -->
            </div>
        </div>
    </div>
@stop


@section('js')
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
    </script>

    @if (session('success'))
        <script type="text/javascript">
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            })
        </script>
    @endif
    @if (session('error'))
        <script type="text/javascript">
            Toast.fire({
                icon: 'success',
                title: '{{ session('error') }}'
            })
        </script>
    @endif
@stop
