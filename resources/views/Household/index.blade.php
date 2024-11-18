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
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
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
                <a href="{{ url('admin/Household/Create') }}" class="btn btn-sm btn-success">New Household</a>
            </div>
        </div>
        <div class="card-body">
            <table id="example" class="table table-bordered table-striped">
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
                                <a href="{{ url('admin/Household/Edit/' . $posts->id) }}" class="btn btn-primary btn-sm"
                                    data-toggle="tooltip" data-placement="top" title="Update record">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ url('admin/Household/Deactivate/' . $posts->id) }}"
                                    class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                    title="Deactivate record">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group pull-right">
                <label class="checkbox-inline"><input type="checkbox"
                        onclick="document.location='{{ url('admin/Household/Soft') }}';" id="showDeactivated"> Show
                    deactivated
                    records</label>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function updateForm() {
            return confirm("Are you sure you want to modify this record?");
        }

        function deleteForm() {
            return confirm(
                "Are you sure you want to deactivate this record? All items included in this record will also be deactivated."
            );
        }
    </script>
@endsection
