@extends('adminlte::page')

@section('title', 'Report')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Report</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Report</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')

    <div class="card card-outline card-navy">
        <div class="card-header">
            <h3 class="card-title">Generate Resident Reports</h3>
        </div>
        <div class="card-body">
            <form id="reportForm">
                <div class="row">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="civil_status">Source</label>
                            <select class="form-control" name="source" id="source">
                                <option value="">Select a source</option>
                                <option value="residents">Residents</option>
                                <option value="blotters">Blotter</option>
                            </select>
                        </div>
                    </div>
                    <!-- Start Date -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="date">Start Date</label>
                            <div class="input-group date" id="start" data-target-input="nearest">
                                <input type="text" id="startDate" name="start" placeholder="YYYY-MM-DD"
                                    value="{{ old('start') }}" class="form-control datetimepicker-input"
                                    data-target="#start">
                                <div class="input-group-append" data-target="#start" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- End Date -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="date">End Date</label>
                            <div class="input-group date" id="end" data-target-input="nearest">
                                <input type="text" id="endDate" name="start" placeholder="YYYY-MM-DD"
                                    value="{{ old('end') }}" class="form-control datetimepicker-input"
                                    data-target="#end">
                                <div class="input-group-append" data-target="#end" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Generate Report Button -->
                    <div class="col-md-1">
                        <button type="button" id="gen" class="btn btn-primary mt-4">
                            <i class="fa fa-file"></i> Generate
                        </button>
                    </div>

                </div>
            </form>

            <div class="card card-outline card-navy collapsed-card d-none" id="resident-filter">
                <div class="card-header">
                    <h5 class="card-title">Filter Residents</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="residentFilter">
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-4">
                                <label for="name">Name</label>
                                <input id="resName" type="text" class="form-control" name="name"
                                    placeholder="Search by name" value="{{ request('name') }}">
                            </div>
                            <!-- Gender -->
                            <div class="col-md-2">
                                <label for="gender">Gender</label>
                                <select id="genderVal" class="form-control" name="gender">
                                    <option value="" {{ request('gender') == '' ? 'selected' : '' }}>Any</option>
                                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>Male</option>
                                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <!-- Age -->
                            <div class="col-md-2">
                                <label for="min_age">Age Range</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" class="form-control" name="min_age" placeholder="Min age"
                                            value="{{ request('min_age') }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" class="form-control" name="max_age" placeholder="Max age"
                                            value="{{ request('max_age') }}">
                                    </div>
                                </div>
                            </div>
                            <!-- Civil Status -->
                            <div class="col-md-4">
                                <label for="civil_status">Civil Status</label>
                                <select class="form-control" name="civil_status">
                                    <option value="" {{ request('civil_status') == '' ? 'selected' : '' }}>Any
                                    </option>
                                    @foreach ($civilStatus as $civil)
                                        <option value="{{ $civil }}"
                                            {{ request('civil_status') == $civil ? 'selected' : '' }}>
                                            {{ $civil }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="row mt-3">
                            <!-- PWD -->
                            <div class="col-md-2">
                                <label for="isPWD">PWD</label>
                                <select class="form-control" name="isPWD">
                                    <option value="" {{ request('isPWD') == '' ? 'selected' : '' }}>Any</option>
                                    <option value="1" {{ request('isPWD') == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ request('isPWD') == '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <!-- 4Ps -->
                            <div class="col-md-2">
                                <label for="is4Ps">4Ps Recipient</label>
                                <select class="form-control" name="is4Ps">
                                    <option value="" {{ request('is4Ps') == '' ? 'selected' : '' }}>Any</option>
                                    <option value="1" {{ request('is4Ps') == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ request('is4Ps') == '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="occupation">Occupation</label>
                                <select class="form-control select2" name="occupation">
                                    <option value="" {{ request('occupation') == '' ? 'selected' : '' }}>Any
                                    </option>
                                    @foreach ($occupations as $occupation)
                                        @if (!$occupation)
                                            @php($occupation = 'Unemployed')
                                            <option value="{{ $occupation }}"
                                                {{ request('occupation') == $occupation ? 'selected' : '' }}>
                                                {{ $occupation }}</option>
                                        @else
                                            <option value="{{ $occupation }}"
                                                {{ request('occupation') == $occupation ? 'selected' : '' }}>
                                                {{ $occupation }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="religion">Religion</label>
                                <select class="form-control select2" name="religion">
                                    <option value="" {{ request('religion') == '' ? 'selected' : '' }}>Any</option>
                                    @foreach ($religions as $religion)
                                        <option
                                            value="{{ $religion }}"{{ request('religion') == $religion ? 'selected' : '' }}>
                                            {{ $religion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="blotter">Has Record</label>
                                <select class="form-control" name="blotter">
                                    <option value="" {{ request('blotter') == '' ? 'selected' : '' }}>Any</option>
                                    <option value="0" {{ request('blotter') == '0' ? 'selected' : '' }}>Yes</option>
                                    <option value="1" {{ request('blotter') == '1' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <!-- Submit -->
                        </div>
                    </form>
                </div>
            </div>

            <div class="card card-outline card-navy collapsed-card d-none" id="blotter-filter">
                <div class="card-header">
                    <h5 class="card-title">Filter Blotter Records</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="blotterFilter">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="officer">Officer in Charge</label>
                                <select class="form-control select2" name="officer">
                                    <option value="" {{ request('officer') == '' ? 'selected' : '' }}>Any</option>
                                    @foreach ($officers as $officer)
                                        <option value="{{ $officer->id }}"
                                            {{ request('officer') == $officer->id ? 'selected' : '' }}>
                                            {{ $officer->resident->firstName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="status">Status</label>
                                <select class="form-control select2" name="status">
                                    <option value="" {{ request('status') == '' ? 'selected' : '' }}>Any</option>
                                    @foreach ($status as $stats)
                                        @if ($stats == 1)
                                            <option
                                                value="{{ $stats }}"{{ request('status') == $stats ? 'selected' : '' }}>
                                                Pending</option>
                                        @elseif($stats == 2)
                                            <option
                                                value="{{ $stats }}"{{ request('status') == $stats ? 'selected' : '' }}>
                                                Ongoing</option>
                                        @elseif($stats == 3)
                                            <option
                                                value="{{ $stats }}"{{ request('status') == $stats ? 'selected' : '' }}>
                                                Resolved Issue</option>
                                        @else
                                            <option
                                                value="{{ $stats }}"{{ request('status') == $stats ? 'selected' : '' }}>
                                                File to Action</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <!-- Submit -->
                        </div>
                    </form>
                </div>
            </div>

            <!-- Data Table -->
            <div class="card mt-4 d-none card-outline card-navy" id="blotterCard">
                <div class="card-header">Report Results</div>
                <div class="card-body">
                    <div id="report-wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <table id="blotter-table" class="table table-striped dataTable dtr-inline">
                            <thead>
                                <tr>
                                    <th>Case No.</th>
                                    <th>Complainant</th>
                                    <th>Complained Resident</th>
                                    <th>Date of Filing</th>
                                    <th>Person-in-charge</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- DataTables will populate this area -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



            <div class="card mt-4 d-none card-outline card-navy" id="residentCard">
                <div class="card-header">Report Results</div>
                <div class="card-body">
                    <div id="report-wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <table id="resident-table" class="table table-striped dataTable dtr-inline">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Civil Status</th>
                                    <th>Religion</th>
                                    <th>Occupation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- DataTables will populate this area -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {

            $('#start, #end').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'en',
            })

            $('.select2').select2({
                theme: 'bootstrap4'
            })

            $(' #source').select2({
                theme: 'bootstrap4',
                placeholder: 'Select a source'
            })

            // Validate date range
            $('#end').on('change.datetimepicker', function(e) {
                const start = $('#start').datetimepicker('viewDate').format('YYYY-MM-DD');
                const end = $('#end').datetimepicker('viewDate').format('YYYY-MM-DD');

                if (start > end) {
                    toastr.error('Invalid End date. It should not be earlier than the Start date.');
                }
            });

            $('#gen').on('click', function() {
                const start = $('#start').datetimepicker('viewDate').format('YYYY-MM-DD');
                const end = $('#end').datetimepicker('viewDate').format('YYYY-MM-DD');

                const source = $('#source').val();

                if (start > end) {
                    toastr.error('Invalid End date. It should not be earlier than the Start date.');
                    return;
                } else {
                    if (!start || !end) {
                        toastr.error('Please select both start and end dates.', 'Error!');
                        return;
                    }
                }

                if (source == "blotters") {
                    $('#residentCard').addClass('d-none'); // Show the results card
                    $('#resident-filter').addClass('d-none'); // Show the results card
                    $('#blotterCard').removeClass('d-none'); // Show the results card
                    $('#blotter-filter').removeClass('d-none'); // Show the results card

                    blotterTable();

                } else if (source == "residents") {
                    $('#blotterCard').addClass('d-none'); // Show the results card
                    $('#blotter-filter').addClass('d-none'); // Show the results card
                    $('#residentCard').removeClass('d-none'); // Show the results card
                    $('#resident-filter').removeClass('d-none'); // Show the results card

                    residentTable();
                }


            });

            $('#residentFilter').on('click', function() {
                console.log("Clicked");

            });


            function residentTable() {
                $('#resident-table').DataTable({
                    responsive: true,
                    lengthChange: true,
                    autoWidth: false,
                    destroy: true, // Allow reinitialization
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ url('/admin/Report/Table') }}",
                        data: function(data) {
                            data.source = "residents";
                            data.name = $('#resName').val();
                            data.gender = $('#genderVal').val();
                            data.min_age = $('[name="min_age"]').val();
                            data.max_age = $('[name="max_age"]').val();
                            data.civil_status = $('[name="civil_status"]').val();
                            data.isPWD = $('[name="isPWD"]').val();
                            data.is4Ps = $('[name="is4Ps"]').val();
                            data.occupation = $('[name="occupation"]').val();
                            data.religion = $('[name="religion"]').val();
                            data.blotter = $('[name="blotter"]').val();
                            data.from_date = $('#start').datetimepicker('viewDate').format(
                                'YYYY-MM-DD');
                            data.end_date = $('#end').datetimepicker('viewDate').format('YYYY-MM-DD');
                        }
                    },
                    columns: [{
                            data: 'id',
                        },
                        {
                            data: 'firstName'
                        },
                        {
                            data: 'lastName'
                        },
                        {
                            data: 'gender'
                        },
                        {
                            data: 'age'
                        },
                        {
                            data: 'civilStatus'
                        },
                        {
                            data: 'religion'
                        },
                        {
                            data: 'occupation'
                        },
                    ],
                    dom: '<"row"<"col-md-6"l><"col-md-6"B>>rtip',
                    buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                }).buttons().container().appendTo('#report-wrapper .col-md-6:eq(0)');

            }


            function blotterTable() {

                $('#blotter-table').DataTable({
                    responsive: true,
                    lengthChange: true,
                    autoWidth: false,
                    destroy: true, // Allow reinitialization
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ url('/admin/Report/Table') }}",
                        data: function(data) {
                            data.source = "blotters";
                            data.officer = $('[name="officer"]').val();
                            data.status = $('[name="status"]').val();
                            data.from_date = $('#start').datetimepicker('viewDate').format(
                                'YYYY-MM-DD');
                            data.end_date = $('#end').datetimepicker('viewDate').format('YYYY-MM-DD');
                        }
                    },
                    columns: [{
                            data: 'id',
                            render: (data) => String(data).padStart(5, '0')
                        },
                        {
                            data: 'complainant'
                        },
                        {
                            data: 'complained_resident'
                        },
                        {
                            data: 'date'
                        },
                        {
                            data: 'officer'
                        },
                        {
                            data: 'status'
                        }
                    ],
                    dom: '<"row"<"col-md-6"l><"col-md-6"B>>rtip',
                    buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#report-wrapper .col-md-6:eq(0)');

            }

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
@stop
