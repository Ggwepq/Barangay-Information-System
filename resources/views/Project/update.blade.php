@extends('adminlte::page')

@section('title', 'Update Project')

@section('content_header')
    <h1>Update Project</h1>
    <p class="text-muted"><b>Note:</b> Fields with <span class="text-danger">*</span> are required.</p>
@endsection

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
            <form action="{{ url('/admin/Project/Update/' . $post->id) }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectName">Project Name <span class="text-danger">*</span></label>
                            <input type="text" id="projectName" class="form-control" name="projectName"
                                value="{{ $post->projectName }}" placeholder="Project Name" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="projectDev">Project Developer <span class="text-danger">*</span></label>
                            <input type="text" id="projectDev" class="form-control" name="projectDev"
                                value="{{ $post->projectDev }}" placeholder="Project Developer" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="officerCharge">Officer-in-Charge <span class="text-danger">*</span></label>
                            <select id="officerCharge" class="form-control select2" name="officerCharge" required>
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
                                    <label for="dateStarted">Project Started <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="dateStarted" name="dateStarted"
                                            class="form-control datemask" value="{{ $post->dateStarted }}"
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
                                            value="{{ $post->dateEnded }}" placeholder="YYYY-MM-DD" required>
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
                                placeholder="Project Description">{{ $post->description }}</textarea>
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
