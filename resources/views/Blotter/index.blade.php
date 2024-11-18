@extends('adminlte::page')

@section('title', 'Blotter')

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
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Blotter Records</h3>
            <div class="card-tools">
                <a href="{{ url('/admin/Blotter/Create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> New Blotter
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Case No.</th>
                        <th>Complainant</th>
                        <th>Complained Resident</th>
                        <th>Date of Filing</th>
                        <th>Person-in-charge</th>
                        <th>Status</th>
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
                            <td>
                                @if ($posts->status == 1)
                                    Pending
                                @elseif($posts->status == 2)
                                    Ongoing
                                @elseif($posts->status == 3)
                                    Resolved Issue
                                @else
                                    File to Action
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/admin/Blotter/Edit/id=' . $posts->id) }}" onclick="return updateForm()"
                                    type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                    title="Update record">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ url('/admin/Blotter/Deactivate/id=' . $posts->id) }}"
                                    onclick="return deleteForm()" type="button" class="btn btn-danger btn-sm"
                                    data-toggle="tooltip" data-placement="top" title="Deactivate record">
                                    <i class="fas fa-trash"></i>
                                </a>
                                @if ($posts->status == 4)
                                    <a href="{{ url('/admin/FiletoAction/Print/' . $posts->id) }}" target="_blank"
                                        type="button" class="btn btn-success btn-sm" data-toggle="tooltip"
                                        data-placement="top" title="File to Action">
                                        <i class="fas fa-print"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group pull-right">
                <label class="checkbox-inline"><input type="checkbox"
                        onclick="document.location='{{ url('/admin/Blotter/Soft') }}';" id="showDeactivated"> Show
                    deactivated records</label>
            </div>
        </div>
    </div>
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
