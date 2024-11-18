@extends('adminlte::page')

@section('title', 'Residents')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Resident</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Resident</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    @if (session('success'))
        <script type="text/javascript">
            toastr.success(' <?php echo session('success'); ?>', 'Success!')
        </script>
    @endif
    @if (session('error'))
        <script type="text/javascript">
            toastr.error(' <?php echo session('error'); ?>', "There's something wrong!")
        </script>
    @endif
    <div class="card card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">Constituent Management</h3>
            <div class="card-tools float-right">
                <a href="{{ url('admin/Resident/Create') }}" class="btn btn-xs btn-success">New Resident</a>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="display table" cellspacing="0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Civil Status</th>
                        <th>Religion</th>
                        <th>Date Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $posts)
                        @if ($posts->isDerogatory == 1)
                            <tr>
                            @else
                            <tr style="" class="danger">
                        @endif
                        <td><img src="{{ asset($posts->image) }}" width="100px" style="max-width:100px;"></td>
                        <td>{{ $posts->firstName }} {{ $posts->middleName }} {{ $posts->lastName }}</td>
                        <td>
                            @if ($posts->gender == 1)
                                Male
                            @else
                                Female
                            @endif
                        </td>
                        <td>{{ $posts->civilStatus }}</td>
                        <td>{{ $posts->religion }}</td>
                        <td>{{ Carbon\Carbon::parse($posts->created_at)->toFormattedDateString() }}</td>
                        <td>
                            <a href="{{ url('admin/Resident/Edit/' . $posts->id) }}" onclick="return updateForm()"
                                type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                title="Update record">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/Resident/Deactivate/' . $posts->id) }}" onclick="return deleteForm()"
                                type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                title="Deactivate record">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/BarangayClearance/Print/' . $posts->id) }}" target="_blank"
                                type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                title="Barangay Certification">
                                <i class="fa fa-print" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/CertificateIndigency/Print/' . $posts->id) }}" target="_blank"
                                type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                title="Certificate of Indigency">
                                <i class="fa fa-print" aria-hidden="true"></i>
                            </a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group pull-right">
                <label class="checkbox-inline"><input type="checkbox"
                        onclick="document.location='{{ url('admin/Resident/Soft') }}';" id="showDeactivated"> Show
                    deactivated
                    records</label>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link href="{{ asset('vendor/toastr/toastr.css') }}" rel="stylesheet">
@stop

@section('js')
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
                "Are you sure you want to deactivate this record? All items included in this record will also be deactivated. Note: Deactivating the record means the resident they're now transferring their record."
            );
            if (x)
                return true;
            else
                return false;
        }
    </script>
@stop
