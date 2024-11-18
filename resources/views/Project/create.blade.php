@extends('adminlte::page')

@section('title', 'Project Records')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Projects</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Project</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    @if ($errors->any())
        <script>
            toastr.error('{!! implode('<br>', $errors->all()) !!}', "There's something wrong!");
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error('{{ session('error') }}', "There's something wrong!");
        </script>
    @endif

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Project Details</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('/admin/Project/Store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectName">Project Name <span class="text-danger">*</span></label>
                            <input type="text" id="projectName" class="form-control" name="projectName"
                                value="{{ old('projectName') }}" placeholder="Project Name" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="projectDev">Project Developer <span class="text-danger">*</span></label>
                            <input type="text" id="projectDev" class="form-control" name="projectDev"
                                value="{{ old('projectDev') }}" placeholder="Project Developer" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="officerCharge">Officer-in-Charge <span class="text-danger">*</span></label>
                            <select id="officerCharge" class="form-control select2" name="officerCharge" required>
                                <option value="" disabled selected>Select an Officer</option>
                                @foreach ($officer as $of)
                                    <option value="{{ $of->Resident->firstName }}">
                                        {{ $of->Resident->firstName }} {{ $of->Resident->middleName }}
                                        {{ $of->Resident->lastName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dateStarted">Project Started <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="dateStarted" name="dateStarted"
                                            class="form-control datemask" value="{{ old('dateStarted') }}"
                                            placeholder="YYYY-MM-DD" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dateEnded">Project Ended <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="dateEnded" name="dateEnded" class="form-control datemask"
                                            value="{{ old('dateEnded') }}" placeholder="YYYY-MM-DD" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" class="form-control" name="description" rows="5" maxlength="150"
                                placeholder="Project Description">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.datemask').inputmask('9999-99-99'); // Mask for date format

            $('#dateEnded').on('change', function() {
                const startDate = $('#dateStarted').val();
                const endDate = $('#dateEnded').val();

                if (startDate && endDate && startDate > endDate) {
                    toastr.error('Invalid End Date. It must be after the Start Date.', "Validation Error");
                    $('#dateEnded').val('');
                }
            });
        });
    </script>
@endsection
