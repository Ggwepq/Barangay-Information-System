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
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Resident</li>
                </ol>
            </div>
        </div>
    </div>
@stop


@section('content')
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

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Officer Management</h3>
            <div class="card-tools">
                <a href="{{ url('/admin/Officer/Create') }}" class="btn btn-xs btn-success">New Officer</a>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped">
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
                                <a href="{{ url('/admin/Officer/Edit/' . $posts->id) }}" onclick="return updateForm()"
                                    class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                    title="Update record">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ url('/admin/Officer/Deactivate/' . $posts->id) }}" onclick="return deleteForm()"
                                    class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                    title="Deactivate record">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group float-right">
                <label class="checkbox-inline"><input type="checkbox"
                        onclick="document.location='{{ url('/admin/Officer/Soft') }}';" id="showDeactivated"> Show
                    deactivated records</label>
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
@stop
