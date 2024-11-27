@extends('adminlte::page')

@section('title', 'Update Project')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Projects</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Project</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-lg">Update Project Details</h3>
                        <div class="card-tools float-right">
                            <p class="card-text"><b>Note</b>: Fields with <span style="color:red;">*</span> are
                                needed to filled out.</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/admin/Project/Update/' . $post->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectName">Project Name <span class="text-danger">*</span></label>
                                        <input type="text" id="projectName" class="form-control" name="projectName"
                                            value="{{ $post->projectName }}" placeholder="Project Name" maxlength="100"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="projectDev">Project Developer <span class="text-danger">*</span></label>
                                        <input type="text" id="projectDev" class="form-control" name="projectDev"
                                            value="{{ $post->projectDev }}" placeholder="Project Developer" maxlength="100"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="officerCharge">Officer-in-Charge <span
                                                class="text-danger">*</span></label>
                                        <select id="officerCharge" class="form-control select2" name="officerCharge"
                                            required>
                                            @foreach ($officer as $of)
                                                <option value="{{ $of->Resident->firstName }}"
                                                    @if ($of->Resident->firstName === $post->officerCharge) selected @endif>
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
                                                <label for="date">Project Start Date<span
                                                        style="color:red;">*</span></label>
                                                <div class="input-group" id="dateStarted" data-target-input="nearest">
                                                    <input type="text" name="dateStarted" placeholder="YYYY-MM-DD"
                                                        value="{{ $post->dateStarted }}"
                                                        class="form-control datetimepicker-input datemask"
                                                        data-target="#dateStarted">
                                                    <div class="input-group-append" data-target="#dateStarted"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date">Project End Date<span
                                                        style="color:red;">*</span></label>
                                                <div class="input-group" id="dateEnded" data-target-input="nearest">
                                                    <input type="text" name="dateEnded" placeholder="YYYY-MM-DD"
                                                        value="{{ $post->dateEnded }}"
                                                        class="form-control datetimepicker-input datemask"
                                                        data-target="#dateEnded">
                                                    <div class="input-group-append" data-target="#dateEnded"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" class="form-control" name="description" rows="5" maxlength="150"
                                            placeholder="Project Description">{{ $post->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <a class="btn btn-secondary" href="{{ url('/admin/Project') }}">Go Back</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.datemask').inputmask('9999-99-99'); // Mask for date format

            $('#dateEnded, #dateStarted').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'en',
            })

            $('#dateEnded').on('change.datetimepicker', function() {
                const startDate = $('#dateStarted').datetimepicker('viewDate').format('YYYY-MM-DD');
                const endDate = $('#dateEnded').datetimepicker('viewDate').format('YYYY-MM-DD');

                if (startDate && endDate && startDate > endDate) {
                    toastr.error('Invalid End Date. It must be after the Start Date.', "Validation Error");
                    $('#dateEnded').val('');
                }
            });
        });
    </script>
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
@endsection
