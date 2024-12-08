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
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Resident</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-navy">
        <div class="card-header with-border d-inline-flex">
            <h6 class="mr-auto mt-2"><i class="fa fa-list"></i> List of Registerd Residents</h6>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-striped dataTable dtr-inline">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Civil Status</th>
                        <th>Religion</th>
                        <th>Date Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $posts)
                        @if ($posts->isDerogatory == 1)
                            <tr>
                            @else
                            <tr class="table-danger blotter">
                        @endif
                        <td><img src="{{ asset($posts->image) }}" width="100px" style="max-width:100px;"></td>
                        <td>{{ $posts->firstName }} {{ $posts->middleName }} {{ $posts->lastName }}</td>
                        <td>
                            @if ($posts->gender == 1)
                                Male
                            @else
                                Female
                            @endif
                        </td>
                        <td>{{ $posts->civilStatus }}</td>
                        <td>{{ $posts->religion }}</td>
                        <td>{{ Carbon\Carbon::parse($posts->created_at)->toFormattedDateString() }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#showProfile-{{ $posts->id }}">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#deactivateModal-{{ $posts->id }}">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                            <a href="{{ url('admin/BarangayClearance/Print/' . $posts->id) }}" target="_blank"
                                type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                title="Barangay Certification">
                                <i class="fa fa-print" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/CertificateIndigency/Print/' . $posts->id) }}" target="_blank"
                                type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                title="Certificate of Indigency">
                                <i class="fa fa-print" aria-hidden="true"></i>
                            </a>

                            <!-- Show Profile Modal -->
                            <div class="modal fade show" data-backdrop="static" data-keyboard="false"
                                id="showProfile-{{ $posts->id }}" tabindex="-1" aria-labelledby="showProfileLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="showProfileLabel">{{ $posts->firstName }}
                                                {{ $posts->middleName }} {{ $posts->lastName }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <!-- Profile Picture -->
                                                    <div class="col-md-4 text-center">
                                                        <img src="{{ asset($posts->image) }}" alt="Profile Picture"
                                                            class="img-fluid rounded-circle mb-3">
                                                        <p class="text-muted">Date of Registration:
                                                            {{ Carbon\Carbon::parse($posts->created_at)->toFormattedDateString() }}
                                                        </p>
                                                    </div>
                                                    <!-- Personal Details -->
                                                    <div class="col">
                                                        <h5>Personal Information</h5>
                                                        <div class="row">
                                                            <dt class="col-sm-3">First Name: </dt>
                                                            <dd class="col-sm-8">{{ $posts->firstName }}</dd>
                                                            <dt class="col-sm-3">Middle Name: </dt>
                                                            <dd class="col-sm-8">{{ $posts->middleName }}</dd>
                                                            <dt class="col-sm-3">Last Name: </dt>
                                                            <dd class="col-sm-8">{{ $posts->lastName }}</dd>
                                                            <dt class="col-sm-3">Gender: </dt>
                                                            <dd class="col-sm-8">{{ $posts->gender ? 'Male' : 'Female' }}
                                                            </dd>
                                                            <dt class="col-sm-3">Birthdate: </dt>
                                                            <dd class="col-sm-8">{{ $posts->birthdate }}</dd>
                                                            <dt class="col-sm-3">Age: </dt>
                                                            <dd class="col-sm-8">{{ $posts->age }}</dd>
                                                            <dt class="col-sm-3">Birthplace: </dt>
                                                            <dd class="col-sm-8">
                                                                {{ $posts->birthplace ? $posts->birthplace : 'N/A' }}</dd>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <!-- Contact Details -->
                                                    <!-- Additional Information -->
                                                    <div class="col-md-6">
                                                        <h5>Additional Information</h5>
                                                        <p><strong>Civil Status:</strong> {{ $posts->civilStatus }}</p>
                                                        <p><strong>Religion:</strong> {{ $posts->religion }}</p>
                                                        <p><strong>Profession/Occupation:</strong>
                                                            {{ $posts->profession ?? 'N/A' }}</p>
                                                        <p><strong>Precinct Assignment No.:</strong>
                                                            {{ $posts->voter->first()->precintNo ?? 'N/A' }}</p>
                                                        <p><strong>Person w/ Disability:</strong>
                                                            {{ $posts->isPWD ? 'Yes' : 'No' }}</p>
                                                        <p><strong>4Ps Recipient:</strong>
                                                            {{ $posts->is4Ps ? 'Yes' : 'No' }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5>Contact Details</h5>
                                                        <p><strong>Contact Number:</strong> {{ $posts->contactNumber }}</p>
                                                        <p><strong>Voter's ID No.:</strong>
                                                            {{ $posts->voter->first()->voterId ?? 'N/A' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <a href="{{ url('admin/Resident/Edit/' . $posts->id) }}"
                                                class="btn btn-primary">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Deactivate Modal -->
                            <div class="modal fade" id="deactivateModal-{{ $posts->id }}" tabindex="-1"
                                aria-labelledby="deactivateModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deactivateModalLabel">Deactivate Record</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to deactivate this record?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <a href="{{ url('admin/Resident/Deactivate/' . $posts->id) }}"
                                                class="btn btn-danger">Deactivate</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group float-left">
                <label class="checkbox-inline"><input type="checkbox"
                        onclick="document.location='{{ url('admin/Resident/Soft') }}';" id="showDeactivated"> Show
                    deactivated
                    records</label>
            </div>
        </div>
    </div>
@stop


@section('js')
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
    </script>

    @if (session('success'))
        <script type="text/javascript">
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            })
        </script>
    @endif
    @if (session('error'))
        <script type="text/javascript">
            Toast.fire({
                icon: 'success',
                title: '{{ session('error') }}'
            })
        </script>
    @endif
@stop
