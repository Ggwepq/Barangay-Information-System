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
            <h3 class="card-title">Generate Resident Reports</h3>
        </div>
        <div class="card-body">
            <form id="reportForm">
                <div class="row">
                    @csrf
                    <!-- Start Date -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="start">Date Started</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" id="start" name="start"
                                    placeholder="YYYY-MM-DD">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- End Date -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="end">Date Ended</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" id="end" name="end"
                                    placeholder="YYYY-MM-DD">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Generate Report Button -->
                    <div class="col-md-1">
                        <button type="button" id="gen" class="btn btn-primary mt-4">Generate</button>
                    </div>

                    <!-- Export to PDF Button -->
                    <div class="col-md-1">
                        <a href="#" id="pdf" target="_blank" class="btn btn-success mt-4">
                            <i class="fa fa-file"></i> Export
                        </a>
                    </div>
                </div>
            </form>

            <!-- Data Table -->
            <div class="card mt-4 d-none" id="dataCard">
                <div class="card-header bg-primary text-white">Report Results</div>
                <div class="card-body">
                    <table id="list1" class="table table-bordered table-striped">
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
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Initialize date picker
            $('.datepicker').inputmask('9999-99-99');

            // Validate date range
            $('#end').on('change', function() {
                const start = $('#start').val();
                const end = $('#end').val();
                if (start > end) {
                    alert('Invalid End date. It should not be earlier than the Start date.');
                }
            });

            // Generate report
            $('#gen').on('click', function() {
                const start = $('#start').val();
                const end = $('#end').val();

                if (!start || !end) {
                    toastr.error('Please select both start and end dates.', 'Error!');
                    return;
                }

                $('#dataCard').removeClass('d-none'); // Show the results card

                $('#list1').DataTable({
                    destroy: true, // Allow reinitialization
                    ajax: `/Report/Table/${start}/${end}`,
                    columns: [{
                            data: 'id',
                            render: (data) => String(data).padStart(5, '0')
                        },
                        {
                            data: 'complainant'
                        },
                        {
                            data: 'complainedResident'
                        },
                        {
                            data: 'date'
                        }
                    ]
                });
            });

            // Export to PDF
            $('#pdf').on('click', function() {
                const start = $('#start').val();
                const end = $('#end').val();

                if (!start || !end) {
                    toastr.error('Please select both start and end dates.', 'Error!');
                    return false;
                }

                $(this).attr('href', `/Report/Pdf/${start}/${end}`);
            });
        });
    </script>
@stop
