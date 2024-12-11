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
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Database Backups</li>
                </ol>
            </div>
        </div>
    </div>
@stop


@section('content')


    <div class="card card-outline card-navy">
        <div class="card-header">
            <h3 class="card-title">Backups</h3>
            <div class="card-tools">
                <a href="{{ url('/admin/Backup/Create') }}" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Create
                    Backup</a>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="display table table-bordered table-striped" style="width:100%">
                {{-- Added datatable classes --}}
                <thead>
                    <tr>
                        <th>Backup Name</th>
                        <th>Backup Size</th>
                        <th>Backup Date</th>
                        <th>Backup Age</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($backups as $backup)
                        <tr>
                            <td>{{ $backup['file_name'] }}</td>
                            <td>{{ $backup['file_size'] }}</td>
                            <td>{{ $backup['last_modified'] }}</td>
                            <td>{{ $backup['file_age'] }}</td>
                            <td>

                                <div class="dropdown">
                                    <button class="btn btn-outline-danger btn-sm dropdown-toggle" type="button"
                                        id="actionsMenu{{ $backup['file_name'] }}" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"><i class="fa fa-tasks"></i>
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actionsMenu{{ $backup['file_name'] }}">
                                        <a href="{{ url('/admin/Backup/Import/' . $backup['file_name']) }}"
                                            class="dropdown-item"
                                            onclick="return confirm('Are you sure you want to import this backup?');">
                                            <i class="fa fa-arrow-circle-down "></i>
                                            Import
                                        </a>
                                        <a href="{{ url('/admin/Backup/Download/' . $backup['file_name']) }}"
                                            class="dropdown-item">
                                            <i class="fa fa-download"></i>
                                            Download
                                        </a>

                                        <a href="{{ url('/admin/Backup/Delete/' . $backup['file_name']) }}"
                                            class="dropdown-item"
                                            onclick="return confirm('Are you sure you want to delete this backup?');">
                                            <i class="fa fa-trash"></i>
                                            Delete
                                        </a>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js') {{-- Use 'js' section for scripts in AdminLTE --}}
    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();
        })
    </script>

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

    @if (session('warning'))
        <script>
            toastr.success('{{ session('warning') }}', "Warning!");
        </script>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error('{{ $error }}', "Error!");
            </script>
        @endforeach
    @endif
@stop
