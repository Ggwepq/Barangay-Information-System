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
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box"> <span class="info-box-icon bg-primary shadow-sm"> <i class="fa fa-users"></i>
                </span>
                <div class="info-box-content"> <span class="info-box-text">Residents</span> <span class="info-box-number">
                        {{ number_format($resident) }}</span> </div> <!-- /.info-box-content -->
            </div> <!-- /.info-box -->
        </div> <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box"> <span class="info-box-icon bg-danger shadow-sm"> <i class="fa fa-address-card"></i>
                </span>
                <div class="info-box-content"> <span class="info-box-text">Voters</span> <span
                        class="info-box-number">{{ number_format($voter) }}</span> </div> <!-- /.info-box-content -->
            </div> <!-- /.info-box -->
        </div> <!-- /.col --> <!-- fix for small devices only --> <!-- <div class="clearfix hidden-md-up"></div> -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box"> <span class="info-box-icon bg-success shadow-sm"> <i class="fa fa-university"></i>
                </span>
                <div class="info-box-content"> <span class="info-box-text">Residents w/Records</span> <span
                        class="info-box-number">{{ number_format($record) }}</span> </div> <!-- /.info-box-content -->
            </div> <!-- /.info-box -->
        </div> <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box"> <span class="info-box-icon bg-warning shadow-sm"> <i class="fa fa-briefcase"></i>
                </span>
                <div class="info-box-content"> <span class="info-box-text">Employed Residents</span> <span
                        class="info-box-number">{{ number_format($employed) }}</span> </div> <!-- /.info-box-content -->
            </div> <!-- /.info-box -->
        </div> <!-- /.col -->
    </div> <!-- /.row --> <!--begin::Row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Registered Residents for Year {{ Carbon\Carbon::now()->year }}</h5>
                </div> <!-- /.card-header -->
                <div class="card-body"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-md-8">
                            <p class="text-center"> <strong>Monthly Residents</strong> </p>
                            <div id="monthly-chart"></div>
                        </div> <!-- /.col -->
                        <div class="col-md-4">
                            <p class="text-center"> <strong>Resident Statistics</strong> </p>
                            <div class="progress-group">
                                Male Residents
                                <span class="float-end"><b>{{ $male }}</b>/{{ $resident }}</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width:{{ $slider['maleSlider'] }};">
                                    </div>
                                </div>
                            </div> <!-- /.progress-group -->
                            <div class="progress-group">
                                Female Residents
                                <span class="float-end"><b>{{ $female }}</b>/{{ $resident }}</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-danger" style="width:{{ $slider['femaleSlider'] }};">
                                    </div>
                                </div>
                            </div> <!-- /.progress-group -->
                            <div class="progress-group"> <span class="progress-text">
                                    Resident w/Records
                                </span> <span class="float-end"><b>{{ $record }}</b>/{{ $resident }}</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-warning" style="width:{{ $slider['resRecord'] }};">
                                    </div>
                                </div>
                            </div> <!-- /.progress-group -->
                            <div class="progress-group">
                                PWD Residents
                                <span class="float-end"><b>{{ $pwd }}</b>/{{ $resident }}</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success" style="width:{{ $slider['pwdSlider'] }};">
                                    </div>
                                </div>
                            </div> <!-- /.progress-group -->
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </div> <!-- ./card-body -->
                <div class="card-footer"> <!--begin::Row-->
                    <div class="row text-center">
                        <div class="d-flex flex-column mx-auto my-auto">
                            <input type="text" id="minor-dial" class="round-dial" data-angleOffset=-125 data-angleArc=250
                                value="{{ $ageGroups['Minors'] }}" data-fgColor="#007bff" readonly>
                            <label class="knob-label" for="minor-dial">Minor</label>
                        </div> <!-- /.col -->
                        <div class="d-flex flex-column mx-auto my-auto">
                            <input type="text" id="adult-dial" class="round-dial" data-angleOffset=-125
                                value="{{ $ageGroups['Adult'] }}" data-angleArc=250 data-fgColor="#28a745" readonly>
                            <label class="text-center" for="adult-dial">Adult</label>
                        </div> <!-- /.col -->
                        <div class="d-flex flex-column mx-auto my-auto">
                            <input type="text" id="middle-dial" class="round-dial" data-angleOffset=-125
                                value="{{ $ageGroups['Middle Aged'] }}" data-angleArc=250 data-fgColor="#ffc107" readonly>
                            <label class="text-center" for="middle-dial">Middle Aged</label>
                        </div> <!-- /.col -->
                        <div class="d-flex flex-column mx-auto my-auto">
                            <input type="text" id="senior-dial" class="round-dial" data-angleOffset=-125
                                value="{{ $ageGroups['Senior'] }}" data-angleArc=250 data-fgColor="#dc3545" readonly>
                            <label class="text-center" for="senior-dial">Senior</label>
                        </div>
                    </div> <!--end::Row-->
                </div> <!-- /.card-footer -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!--end::Row--> <!--begin::Row-->
    <div class="row"> <!-- Start col -->
        <!-- MAP & BOX PANE -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Monthly Filed Cases for Year {{ Carbon\Carbon::now()->year }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="d-md-flex">
                        <div class="p-1 flex-fill" style="overflow: hidden">
                            <!-- Map will be created here -->
                            <div id="world-map-markers" style="height: 325px; overflow: hidden">
                                <div class="blotter-chart"></div>
                            </div>
                        </div>
                        <div class="card-pane-right bg-navy pt-2 pb-2 pl-4 pr-4">
                            <div class="description-block mb-4">
                                <h5 class="description-header">{{ $blotterStatus['total'] }}</h5>
                                <span class="description-text">Total Cases</span>
                            </div>
                            <!-- /.description-block -->
                            <div class="description-block mb-4">
                                <h5 class="description-header">{{ $blotterStatus['filed'] }}</h5>
                                <span class="description-text">Filed to Action Cases</span>
                            </div>
                            <!-- /.description-block -->
                            <div class="description-block">
                                <h5 class="description-header">{{ $blotterStatus['ongoing'] }}</h5>
                                <span class="description-text">Ongoing Cases</span>
                            </div>
                            <!-- /.description-block -->
                            <div class="description-block">
                                <h5 class="description-header">{{ $blotterStatus['resolved'] }}</h5>
                                <span class="description-text">Resolved Cases</span>
                            </div>
                            <!-- /.description-block -->
                        </div><!-- /.card-pane-right -->
                    </div><!-- /.d-md-flex -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row g-4 mb-4">
                <div class="col-md-6"> <!-- DIRECT CHAT -->
                    <div class="card direct-chat direct-chat-warning">
                        <div class="card-header">
                            <h3 class="card-title">Barangay Officials</h3>
                        </div> <!-- /.card-header -->
                        <div class="card-body"> <!-- Conversations are loaded here -->
                            <div class="px-2">
                                @foreach ($officers as $staff)
                                    <div class="d-flex border-top py-2 px-1">
                                        <div class="col-2">
                                            <img src="{{ asset($staff->resident->image) }}" alt="Staff Image"
                                                class="img-size-50">
                                        </div>
                                        <div class="col-10 ml-2">
                                            <a href="javascript:void(0)" class="fw-bold text-truncate">
                                                {{ $staff->resident->firstName }}
                                                {{ $staff->resident->lastName }}
                                            </a>
                                            <div class="text-truncate text-secondary text-sm">
                                                {{ $staff->position->position_name }}
                                            </div>
                                        </div>
                                    </div> <!-- /.item -->
                                @endforeach
                                <div class="d-flex border-top py-2 px-1">
                                    <div class="col-2">
                                        <img src="{{ asset($kagawad->resident->image) }}" alt="Staff Image"
                                            class="img-size-50">
                                    </div>
                                    <div class="col-10 ml-2">
                                        <a href="javascript:void(0)" class="fw-bold text-truncate">
                                            {{ $kagawad->resident->firstName }}
                                            {{ $kagawad->resident->lastName }}
                                        </a>
                                        <div class="text-truncate text-secondary text-sm">
                                            {{ $kagawad->position->position_name }}
                                        </div>
                                    </div>
                                </div> <!-- /.item -->
                            </div>
                        </div> <!-- /.card-body -->
                        <div class="card-footer text-center"> <a href="{{ url('/admin/Officer') }}" class="uppercase">
                                View All Officer
                            </a> </div> <!-- /.card-footer -->
                    </div> <!-- /.direct-chat -->
                </div> <!-- /.col -->
                <div class="col-md-6"> <!-- USERS LIST -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Latest Members</h3>
                            <div class="card-tools"> <span class="badge bg-danger">
                                    New Members
                                </span> </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="row text-center m-1">
                                @foreach ($recent as $posts)
                                    <div class="col-3 p-2"> <img class="img-fluid rounded-circle"
                                            src="{{ asset($posts->image) }}" alt="User Image"> <a
                                            class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0"
                                            href="#">
                                            {{ $posts->firstName }}
                                        </a>
                                        <div class="text-sm text-truncate">
                                            {{ $posts->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                @endforeach
                            </div> <!-- /.users-list -->
                        </div> <!-- /.card-body -->
                        <div class="card-footer text-center"> <a href="{{ url('/admin/Resident') }}"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View
                                All Users</a> </div> <!-- /.card-footer -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!--end::Row--> <!--begin::Latest Order Widget-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ongoing Barangay Projects</h3>
                </div> <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>Project ID</th>
                                    <th>Project Name</th>
                                    <th>Status</th>
                                    <th>End Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $proj)
                                    <tr>
                                        <td> <a href="pages/examples/invoice.html"
                                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">PR{{ $proj->id }}</a>
                                        </td>
                                        <td>{{ $proj->projectName }}</td>
                                        <td> <span class="badge bg-warning p-2">
                                                Ongoing
                                            </span> </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($proj->endDate)->format('F j, Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- /.table-responsive -->
                </div> <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="{{ url('/admin/Project') }}" class="btn btn-sm btn-secondary float-end">
                        View All Projects
                    </a>
                </div> <!-- /.card-footer -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
        <div class="col-md-4"> <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning"> <span class="info-box-icon"> <i class="fa fa-mars"></i>
                </span>
                <div class="info-box-content"> <span class="info-box-text">Male</span> <span
                        class="info-box-number">{{ $male }}</span> </div> <!-- /.info-box-content -->
            </div> <!-- /.info-box -->
            <div class="info-box mb-3 bg-success"> <span class="info-box-icon"> <i class="fa fa-venus"></i>
                </span>
                <div class="info-box-content"> <span class="info-box-text">Female</span> <span
                        class="info-box-number">{{ $female }}</span> </div> <!-- /.info-box-content -->
            </div> <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger"> <span class="info-box-icon"> <i class="fa fa-wheelchair"></i>
                </span>
                <div class="info-box-content"> <span class="info-box-text">PWDs</span> <span
                        class="info-box-number">{{ $pwd }}</span> </div> <!-- /.info-box-content -->
            </div> <!-- /.info-box -->
            <div class="info-box mb-3 bg-info"> <span class="info-box-icon"> <i class="fa fa-university"></i>
                </span>
                <div class="info-box-content"> <span class="info-box-text">4Ps Recepient</span> <span
                        class="info-box-number">{{ $fourps }}</span> </div> <!-- /.info-box-content -->
            </div> <!-- /.info-box -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Resident's Gender</h3>
                </div> <!-- /.card-header -->
                <div class="card-body"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-12">
                            <div id="gender-chart"></div>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </div> <!-- /.card-body -->
                <div class="card-footer p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item"> <a href="#" class="nav-link">
                                Male
                                <span class="float-end text-success"> <i class="bi bi-arrow-up fs-7"></i>
                                    {{ $slider['maleSlider'] }}
                                </span> </a> </li>
                        <li class="nav-item"> <a href="#" class="nav-link">
                                Female
                                <span class="float-end text-info"> <i class="bi bi-arrow-left fs-7"></i>
                                    {{ $slider['femaleSlider'] }}
                                </span> </a> </li>
                    </ul>
                </div> <!-- /.footer -->
            </div> <!-- /.card --> <!-- PRODUCT LIST -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Barangay Officials</h3>
                </div> <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="px-2">
                        @foreach ($officers as $staff)
                            <div class="d-flex border-top py-2 px-1">
                                <div class="col-2">
                                    <img src="{{ asset($staff->resident->image) }}" alt="Staff Image"
                                        class="img-size-50">
                                </div>
                                <div class="col-10 ml-2">
                                    <a href="javascript:void(0)" class="fw-bold text-truncate">
                                        {{ $staff->resident->firstName }}
                                        {{ $staff->resident->lastName }}
                                    </a>
                                    <div class="text-truncate text-secondary text-sm">
                                        {{ $staff->position->position_name }}
                                    </div>
                                </div>
                            </div> <!-- /.item -->
                        @endforeach
                    </div>
                </div> <!-- /.card-body -->
                <div class="card-footer text-center"> <a href="{{ url('/admin/Officer') }}" class="uppercase">
                        View All Officer
                    </a> </div> <!-- /.card-footer -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!--end::Row-->

    <h5 class="mb-2">News and Announcements</h5>
    <div class="card card-success">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="card mb-2 bg-gradient-dark">
                        <img class="card-img-top" src="../dist/img/photo1.png" alt="Dist Photo 1">
                        <div class="card-img-overlay d-flex flex-column justify-content-end">
                            <h5 class="card-title text-primary text-white">Card Title</h5>
                            <p class="card-text text-white pb-2 pt-1">Lorem ipsum dolor sit amet, consectetur
                                adipisicing
                                elit sed do eiusmod tempor.</p>
                            <a href="#" class="text-white">Last update 2 mins ago</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="card mb-2">
                        <img class="card-img-top" src="../dist/img/photo2.png" alt="Dist Photo 2">
                        <div class="card-img-overlay d-flex flex-column justify-content-center">
                            <h5 class="card-title text-white mt-5 pt-2">Card Title</h5>
                            <p class="card-text pb-2 pt-1 text-white">
                                Lorem ipsum dolor sit amet, <br>
                                consectetur adipisicing elit <br>
                                sed do eiusmod tempor.
                            </p>
                            <a href="#" class="text-white">Last update 15 hours ago</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="card mb-2">
                        <img class="card-img-top" src="../dist/img/photo3.jpg" alt="Dist Photo 3">
                        <div class="card-img-overlay">
                            <h5 class="card-title text-primary">Card Title</h5>
                            <p class="card-text pb-1 pt-1 text-white">
                                Lorem ipsum dolor <br>
                                sit amet, consectetur <br>
                                adipisicing elit sed <br>
                                do eiusmod tempor. </p>
                            <a href="#" class="text-primary">Last update 3 days ago</a>
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
                        height: 280,
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
                            text: 'Months'
                        },
                        labels: {
                            style: {
                                colors: '#666'
                            }
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Residents'
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

                const chart = new ApexCharts(document.querySelector("#monthly-chart"), options);
                chart.render();

            }
        });

        $('.round-dial').knob({
            'min': 0,
            'max': {{ $resident }},
            'skin': 'tron',
            'width': '100',
            'height': '100',
        });

        $.ajax({
            type: "GET",
            url: "admin/genders",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(response) {

                var options = {
                    series: Object.values(response),
                    chart: {
                        width: 250,
                        height: 300,
                        type: 'pie',
                    },
                    labels: Object.keys(response),
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#gender-chart"), options);
                chart.render();

            }
        });

        $.ajax({
            type: "GET",
            url: "admin/blotter-months",
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

                const options = {
                    series: [{
                        name: currentYear.toString(),
                        data: seriesData
                    }],
                    chart: {
                        height: 280,
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
                            text: 'Months'
                        },
                        labels: {
                            style: {
                                colors: '#666'
                            }
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Blotter Cases'
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

                const chart = new ApexCharts(document.querySelector(".blotter-chart"), options);
                chart.render();

            }
        });
    </script>
@stop
