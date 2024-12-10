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
    <div class="card card-outline card-navy collapsed-card">
        <div class="card-header">
            <h5 class="card-title">Filter Residents</h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('/admin/Resident') }}" method="GET">
                <div class="row">
                    <!-- Name -->
                    <div class="col-md-4">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Search by name"
                            value="{{ request('name') }}">
                    </div>
                    <!-- Gender -->
                    <div class="col-md-2">
                        <label for="gender">Gender</label>
                        <select class="form-control" name="gender">
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
                            <option value="" {{ request('civil_status') == '' ? 'selected' : '' }}>Any</option>
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
                            <option value="" {{ request('occupation') == '' ? 'selected' : '' }}>Any</option>
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
                    <div class="col-md-4 mt-4">
                        <a href="{{ url('/admin/Resident') }}" class="btn btn-secondary btn-inline row-md-2 ">Reset</a>
                        <button type="submit" class="btn btn-primary btn-inline row-md-2">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
                        <th>Age</th>
                        <th>Civil Status</th>
                        <th>Religion</th>
                        <th>Occupation</th>
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
                        <td>{{ $posts->age }}</td>
                        <td>{{ $posts->civilStatus }}</td>
                        <td>{{ $posts->religion }}</td>
                        <td>{{ $posts->occupation ?? 'Unemployed' }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#showProfile-{{ $posts->id }}">
                                <i class="fa fa-eye" aria-hidden="true"></i> Details
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#deactivateModal-{{ $posts->id }}">
                                <i class="fa fa-trash" aria-hidden="true"></i> Delete
                            </button>

                            <!-- Show Profile Modal -->
                            <div class="modal fade show" data-backdrop="static" data-keyboard="false"
                                id="showProfile-{{ $posts->id }}" tabindex="-1" aria-labelledby="showProfileLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="showProfileLabel">{{ $posts->firstName }}
                                                {{ $posts->middleName }} {{ $posts->lastName }}</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
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
                                                            {{ $posts->profession ?? 'Unemployed' }}</p>
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
                                                        <p><strong>Email Address:</strong>
                                                            {{ $posts->userofficer->email ?? $posts->user->email }}
                                                        </p>
                                                        <p><strong>Voter's ID No.:</strong>
                                                            {{ $posts->voter->first()->voterId ?? 'N/A' }}</p>
                                                    </div>
                                                </div>

                                                <hr>
                                                <h4 class="text-center">Cases</h4>
                                                @if (!$posts->isDerogatory)
                                                    <div class="col mt-2">
                                                        <table id="datatable"
                                                            class="table table-striped dataTable dtr-inline">
                                                            <thead>
                                                                <tr>
                                                                    <th>Case No.</th>
                                                                    <th>Complainant</th>
                                                                    <th>Date of Filing</th>
                                                                    <th>Person-in-charge</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($posts->blotter as $blotter)
                                                                    <tr>
                                                                        <?php $caseNo = str_pad($posts->id, 5, '0', STR_PAD_LEFT); ?>
                                                                        <td><span
                                                                                style="color:red;">{{ $caseNo }}</span>
                                                                        </td>
                                                                        <td>{{ $blotter->com->firstName }}
                                                                            {{ $blotter->com->middleName }}
                                                                            {{ $blotter->com->lastName }}</td>
                                                                        <td>{{ Carbon\Carbon::parse($posts->created_at)->toFormattedDateString() }}
                                                                        </td>
                                                                        <td>{{ $blotter->officer->resident->firstName }}
                                                                        </td>
                                                                        <td>
                                                                            @if ($blotter->status == 1)
                                                                                Pending
                                                                            @elseif($blotter->status == 2)
                                                                                Ongoing
                                                                            @elseif($blotter->status == 3)
                                                                                Resolved Issue
                                                                            @else
                                                                                File to Action
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @else
                                                    <h6 class="text-center text-secondary"> - No cases found - </h6>
                                                @endif
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

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            })
        })
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
