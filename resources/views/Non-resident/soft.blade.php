@extends('adminlte::page')

@section('title', 'Residents')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Non-Resident Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Non-Residents</li>
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

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Non-Residents</h3>
            <div class="card-tools">
                <a href="{{ url('/admin/Resident/NotResident/Create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-user-plus"></i> New Non-Resident
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-hover" style="width:100%">
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
                        <tr class="{{ $posts->isDerogatory == 0 ? 'table-danger' : '' }}">
                            <td><img src="{{ asset($posts->image) }}" class="img-thumbnail" width="100"></td>
                            <td>{{ $posts->firstName }} {{ $posts->middleName }} {{ $posts->lastName }}</td>
                            <td>{{ $posts->gender == 1 ? 'Male' : 'Female' }}</td>
                            <td>{{ $posts->civilStatus }}</td>
                            <td>{{ $posts->religion }}</td>
                            <td>{{ \Carbon\Carbon::parse($posts->created_at)->toFormattedDateString() }}</td>
                            <td>
                                <a href="{{ url('/admin/Resident/NotResident/Edit/' . $posts->id) }}"
                                    class="btn btn-primary btn-sm" title="Update record" onclick="return confirmUpdate();">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ url('/admin/Resident/NotResident/Deactivate/' . $posts->id) }}"
                                    class="btn btn-danger btn-sm" title="Deactivate record"
                                    onclick="return confirmDeactivate();">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-right">
            <label class="checkbox-inline">
                <input type="checkbox" onclick="window.location='{{ url('/admin/Resident/NotResident') }}';"
                    id="showDeactivated">
                Show Active Records
            </label>
        </div>
    </div>
@stop

@section('js')
    <script>
        function confirmUpdate() {
            return confirm("Are you sure you want to modify this record?");
        }

        function confirmDeactivate() {
            return confirm(
                "Are you sure you want to deactivate this record? All items included in this record will also be deactivated."
            );
        }
    </script>
@stop
