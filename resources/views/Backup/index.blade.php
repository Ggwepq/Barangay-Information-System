@extends('adminlte::page')

@section('title', 'Database Backups')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Database Backups</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Admin Dashboard</a></li>
                    <li class="breadcrumb-item active">Database Backups</li>
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


    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Backups</h3>
            <div class="card-tools">
                <a href="{{ url('/admin/Backup/Create') }}" class="btn btn-xs btn-success">Create Backup</a>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="display table table-bordered table-striped" style="width:100%">
                {{-- Added datatable classes --}}
                <thead>
                    <tr>
                        <th>File</th>
                        <th>Size</th>
                        <th>Date</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($backups as $backup)
                        <tr>
                            <td>{{ $backup['file_name'] }}</td>
                            <td>{{ $backup['file_size'] }}</td>
                            <td>{{ $backup['last_modified'] }}</td>
                            <td>{{ $backup['file_age'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js') {{-- Use 'js' section for scripts in AdminLTE --}}
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
