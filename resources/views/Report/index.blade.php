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
                    <table id="list1" class="table table-responsive">
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

            $('#start, #end').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'en',
            })

            // Validate date range
            $('#end').on('change.datetimepicker', function(e) {
                const start = $('#start').datetimepicker('viewDate').format('YYYY-MM-DD');
                const end = $('#end').datetimepicker('viewDate').format('YYYY-MM-DD');

                if (start > end) {
                    toastr.error('Invalid End date. It should not be earlier than the Start date.');
                }
            });

            // Generate report
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

                $('#dataCard').removeClass('d-none'); // Show the results card

                $('#list1').DataTable({
                    destroy: true, // Allow reinitialization
                    ajax: `/admin/Report/Table/${start}/${end}`,
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
                const start = $('#start').datetimepicker('viewDate').format('YYYY-MM-DD');
                const end = $('#end').datetimepicker('viewDate').format('YYYY-MM-DD');

                if (!start || !end) {
                    toastr.error('Please select both start and end dates.', 'Error!');
                    return false;
                }

                $(this).attr('href', `/admin/Report/Pdf/${start}/${end}`);
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
