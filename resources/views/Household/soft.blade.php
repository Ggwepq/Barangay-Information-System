@extends('adminlte::page')

@section('title', 'Household')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Household</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Household</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Household Management</h3>
            <div class="card-tools">
                <a href="{{ url('/admin/Household/Create') }}" class="btn btn-sm btn-success">New Household</a>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Household no.</th>
                        <th>Address</th>
                        <th>Inhabitants</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $posts)
                        <tr>
                            <td>{{ $posts->id }}</td>
                            <td>{{ $posts->street }} {{ $posts->brgy }} {{ $posts->city }}</td>
                            <td>
                                @foreach ($posts->Inhabitants as $inhabitants)
                                    {{ $inhabitants->Resident->firstName }} {{ $inhabitants->Resident->middleName }}
                                    {{ $inhabitants->Resident->lastName }}<br>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ url('/admin/Household/Reactivate/' . $posts->id) }}" onclick="return reacForm()"
                                    type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                    title="Reactivate record">
                                    <i class="fas fa-recycle"></i>
                                </a>
                                <a href="{{ url('/admin/Household/Remove/' . $posts->id) }}" onclick="return deleteForm()"
                                    type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                    title="Delete record">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group pull-right">
                <label class="checkbox-inline">
                    <input type="checkbox" onclick="document.location='{{ url('/admin/Household') }}';"
                        id="showDeactivated"> Show Active
                    Records</label>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function reacForm() {
            var x = confirm("Are you sure you want to reactivate this record?");
            if (x)
                return true;
            else
                return false;
        }

        function deleteForm() {
            var x = confirm("Are you sure you want to delete this record?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endsection
