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
            <form action="{{ url('/admin/document/foruser') }}" method="GET">
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
                        <tr>
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
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                                        id="actionsMenu{{ $posts->id }}" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa fa-tasks"></i>
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actionsMenu{{ $posts->id }}">
                                        <a class="dropdown-item"
                                            href="{{ url('admin/BarangayClearance/Print/' . $posts->id) }}"
                                            target="_blank">
                                            <i class="fa fa-print"></i> Barangay Certificate
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{ url('admin/CertificateIndigency/Print/' . $posts->id) }}"
                                            target="_blank">
                                            <i class="fa fa-print"></i> Certificate of Indigency
                                        </a>
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

@section('css')
    <style>
        .dropdown-menu {
            z-index: 1050 !important;
        }
    </style>
@endsection

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

            $('.dropdown-toggle').dropdown();
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
