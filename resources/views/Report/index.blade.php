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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Resident</li>
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
                                    <th>Created At</th>
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

            var source = "";

            $('#source').on('change', function() {
                source = $('#source').val();
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
                    $('#blotterCard').removeClass('d-none'); // Show the results card

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
                                data.source = source
                                data.from_date = $('#start').datetimepicker('viewDate').format(
                                    'YYYY-MM-DD')
                                data.end_date = $('#end').datetimepicker('viewDate').format(
                                    'YYYY-MM-DD')
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
                        ],
                        dom: '<"row"<"col-md-6"l><"col-md-6"B>>rtip',
                        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#report-wrapper .col-md-6:eq(0)');

                } else if (source == "residents") {

                    $('#blotterCard').addClass('d-none'); // Show the results card
                    $('#residentCard').removeClass('d-none'); // Show the results card

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
                                data.source = source
                                data.from_date = $('#start').datetimepicker('viewDate').format(
                                    'YYYY-MM-DD')
                                data.end_date = $('#end').datetimepicker('viewDate').format(
                                    'YYYY-MM-DD')
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
                            {
                                data: 'date'
                            },
                        ],
                        dom: '<"row"<"col-md-6"l><"col-md-6"B>>rtip',
                        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    }).buttons().container().appendTo('#report-wrapper .col-md-6:eq(0)');

                }


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
@stop
