@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-10">
                <h3 class="mb-0">Dashboard</h3>
            </div>
            <div class="col-sm-2">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Dashboard
                    </li>
                </ol>
            </div>
        </div> <!--end::Row-->
    </div> <!--end::Container-->
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card card-solid card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Pending Cases</h3>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="display table" style="width:100%" cellspacing="50">
                                <thead>
                                    <tr>
                                        <th>Case No.</th>
                                        <th>Complainant</th>
                                        <th>Complained Resident</th>
                                        <th>Date of Filing</th>
                                        <!-- <th>Person-in-charge</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resident as $posts)
                                        <tr>
                                            <td><span style="color:red;">000{{ $posts->id }}</span></td>
                                            <td>{{ $posts->firstName }} {{ $posts->middleName }}
                                                {{ $posts->lastName }}</td>
                                            <td>{{ $posts->firstName }} {{ $posts->middleName }}
                                                {{ $posts->lastName }}</td>
                                            <td>{{ Carbon\Carbon::parse($posts->created_at)->toFormattedDateString() }}</td>
                                            <!-- <td>{{ $posts->officerCharge }}</td> -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4 card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Filed Cases as of this year {{ Carbon\Carbon::now()->year }}</h3>
                        </div>
                        <div class="card-body">
                            <div id="line-example"></div>
                        </div>
                    </div> <!-- /.card --> <!-- DIRECT CHAT -->

                </div>
                <div class="col-sm-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ count($resident) }}</h3>
                            <p>Population</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                    <!-- <div class="small-box bg-warning"> -->
                    <!--     <div class="inner"> -->
                    <!--         <h3>{{ count($male) }}</h3> -->
                    <!--         <p>Male Residents</p> -->
                    <!--     </div> -->
                    <!--     <div class="icon"> -->
                    <!--         <i class="fa fa-mars"></i> -->
                    <!--     </div> -->
                    <!-- </div> -->
                    <!-- <div class="small-box bg-success"> -->
                    <!--     <div class="inner"> -->
                    <!--         <h3>{{ count($female) }}</h3> -->
                    <!--         <p>Female Residents</p> -->
                    <!--     </div> -->
                    <!--     <div class="icon"> -->
                    <!--         <i class="fa fa-venus"></i> -->
                    <!--     </div> -->
                    <!-- </div> -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ count($voter) }}</h3>
                            <p>Registered Voters</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-id-card"></i>
                        </div>
                    </div>
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ count($blotter) }}</h3>
                            <p>Pending Cases</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-scroll"></i>
                        </div>
                    </div>
                    <div class="small-box bg-indigo">
                        <div class="inner">
                            <h3>{{ count($record) }}</h3>
                            <p>Residents w/Records</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-print"></i>
                        </div>
                    </div>
                    <div class="small-box bg-pink">
                        <div class="inner">
                            <h3>{{ count($business) }}</h3>
                            <p>Businesses</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-briefcase"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

    <script>
        $.ajax({
            type: "GET",
            url: "admin/month",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(response) {
                const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                    "Dec"
                ];
                const currentYear = new Date().getFullYear();

                // Prepare data array
                const seriesData = [
                    response.jan, response.feb, response.mar, response.apr,
                    response.may, response.jun, response.jul, response.aug,
                    response.sep, response.oct, response.nov, response.dec
                ];

                console.log(response.jan);

                const options = {
                    series: [{
                        name: currentYear.toString(),
                        data: seriesData
                    }],
                    chart: {
                        height: 350,
                        type: 'area',
                        toolbar: {
                            tools: {
                                download: true,
                                selection: true,
                                zoom: true,
                                zoomin: true,
                                zoomout: true,
                                pan: true,
                                reset: true
                            }
                        },
                    },
                    colors: ["#0d6efd", "#20c997"],
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 5
                    },
                    xaxis: {
                        categories: months,
                        title: {
                            text: 'Month'
                        },
                        labels: {
                            style: {
                                colors: '#666'
                            }
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Value'
                        },
                    },
                    tooltip: {
                        x: {
                            format: 'dd MMM yyyy'
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.9,
                            stops: [0, 100]
                        }
                    },
                    // Enable responsive design
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                height: 300
                            },
                            legend: {
                                show: false
                            }
                        }
                    }]
                };

                const chart = new ApexCharts(document.querySelector("#line-example"), options);
                chart.render();

                // Optional: Add click event handler
                chart.addEventListener('dataPointSelection', function(event, chartContext, config) {
                    const dataPointIndex = config.dataPointIndex;
                    const month = months[dataPointIndex];
                    const value = seriesData[dataPointIndex];
                    console.log(`Clicked on ${month}: ${value.toLocaleString()}`);
                    // Add your click handler logic here
                });
            }
        });
    </script>
@stop
