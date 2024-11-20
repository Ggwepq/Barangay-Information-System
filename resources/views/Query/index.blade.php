@extends('adminlte::page')

@section('title', 'Queries')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Query</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Query</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Select Query</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="queryId">Query Options</label>
                <select id="queryId" name="queryId" class="form-control select2">
                    <option value="" selected disabled>Choose a query...</option>
                    <option value="1">List of Registered Voters</option>
                    <option value="2">List of Filed to Action Blotters</option>
                    <option value="3">List of Senior Citizens Registered in the Barangay</option>
                </select>
            </div>

            <!-- List of Registered Voters -->
            <div class="card card-primary pan1 d-none">
                <div class="card-header">List of Registered Voters</div>
                <div class="card-body">
                    <table id="list1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Civil Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($voter as $v)
                                <tr>
                                    <td>{{ $v->Resident->firstName }} {{ $v->Resident->lastName }}</td>
                                    <td>{{ $v->Resident->gender == 1 ? 'Male' : 'Female' }}</td>
                                    <td>{{ $v->Resident->civilStatus }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- List of Filed to Action Blotters -->
            <div class="card card-primary pan2 d-none">
                <div class="card-header">List of Filed to Action Blotters</div>
                <div class="card-body">
                    <table id="list2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Case No.</th>
                                <th>Complainant</th>
                                <th>Complained Resident</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($file as $file)
                                <tr>
                                    <?php $caseNo = str_pad($file->id, 5, '0', STR_PAD_LEFT); ?>
                                    <td><span class="text-danger">{{ $caseNo }}</span></td>
                                    <td>{{ $file->com->lastName }} {{ $file->com->firstName }}</td>
                                    <td>{{ $file->comRes->lastName }} {{ $file->comRes->firstName }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- List of Senior Citizens -->
            <div class="card card-primary pan3 d-none">
                <div class="card-header">List of Senior Citizens Registered in the Barangay</div>
                <div class="card-body">
                    <table id="list3" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Civil Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($senior as $s)
                                <tr>
                                    <td>{{ $s->firstName }} {{ $s->lastName }}</td>
                                    <td>{{ $s->gender == 1 ? 'Male' : 'Female' }}</td>
                                    <td>{{ $s->civilStatus }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                theme: bootstrap4
            });

            // Initialize DataTables
            $('#list1, #list2, #list3').DataTable({
                responsive: true,
            });

            // Handle query selection
            let currentPanel = null;
            $('#queryId').on('change', function() {
                if (currentPanel) {
                    $(currentPanel).addClass('d-none');
                }
                currentPanel = '.pan' + $(this).val();
                $(currentPanel).removeClass('d-none');
            });
        });
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
@endsection
