@extends('adminlte::page')

@section('title', 'Blotter Records')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Blotter</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Blotter</li>
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
            <h3 class="card-title">Blotter Records</h3>
            <div class="card-tools">
                <a href="{{ url('admin/Household/Create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> New Household
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Case No.</th>
                        <th>Complainant</th>
                        <th>Complained Resident</th>
                        <th>Date of Filing</th>
                        <th>Person-in-charge</th>
                        <th>Description</th>
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
                            <td>{{ $posts->description }}</td>
                            <td>
                                <a href="{{ url('admin/Blotter/Reactivate/' . $posts->id) }}"
                                    onclick="return confirmReactivation();" class="btn btn-warning btn-sm"
                                    data-toggle="tooltip" title="Reactivate record">
                                    <i class="fas fa-recycle"></i>
                                </a>
                                <a href="{{ url('admin/Blotter/Remove/' . $posts->id) }}"
                                    onclick="return confirmDeletion();" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                    title="Delete record">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group text-right">
                <label class="checkbox-inline">
                    <input type="checkbox" onclick="location.href='{{ url('admin/Blotter') }}';" id="showDeactivated"> Show
                    active records
                </label>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        function confirmReactivation() {
            return confirm("Are you sure you want to reactivate this record?");
        }

        function confirmDeletion() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
@stop
