@extends('adminlte::page')

@section('title', 'Business')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Business</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Business</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Business Management</h3>
            <div class="card-tools">
                <a href="{{ url('/admin/Business/Create') }}" class="btn btn-success btn-sm">New Business</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped"style="width:100%">
                <thead>
                    <tr>
                        <th>Business</th>
                        <th>Address</th>
                        <th>Owner</th>
                        <th>Date of Registration</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $posts)
                        <tr>
                            <td>{{ $posts->name }}</td>
                            <td>{{ $posts->street }} {{ $posts->brgy }} {{ $posts->city }}</td>
                            <td>{{ $posts->Resident->firstName }} {{ $posts->Resident->lastName }}</td>
                            <td>{{ Carbon\Carbon::parse($posts->created_at)->toFormattedDateString() }}</td>
                            <td>
                                <a href="{{ url('/admin/Business/Edit/' . $posts->id) }}" class="btn btn-primary btn-sm"
                                    data-toggle="tooltip" title="Update record">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ url('/admin/Business/Deactivate/' . $posts->id) }}"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to deactivate this record? All items included in this record will also be deactivated.');"
                                    data-toggle="tooltip" title="Deactivate record">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href="{{ url('/admin/BusinessPermit/Print/' . $posts->id) }}" target="_blank"
                                    class="btn btn-success btn-sm" data-toggle="tooltip" title="Print Business Permit">
                                    <i class="fas fa-print"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="form-group float-right">
                <label><input type="checkbox" onclick="document.location='{{ url('/admin/Business/Soft') }}';"
                        id="showDeactivated"> Show deactivated records</label>
            </div>
        </div>
    </div>
    <!-- /.card -->

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
