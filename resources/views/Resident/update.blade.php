@extends('adminlte::page')

@section('title', 'Update Resident')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Update Resident</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/Resident') }}">Residents</a></li>
                    <li class="breadcrumb-item active">Update Resident</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-navy">
                        <div class="card-header with-border d-inline-flex">
                            <h5 class="mr-auto mt-2">Update Residents</h5>
                            <div class="card-tools float-right ml-auto mt-2">
                                <p class="card-text"><b>Note</b>: Fields with <span style="color:red;">*</span> are
                                    needed to filled out.</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('admin/Resident/Update/' . $post->id) }}" method="post" files="true"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <center><img class="img-fluid" id="pic"
                                                    src="{{ URL::asset($post->image) }}" alt="Profile Picture"
                                                    style="max-width:200px; background-size: contain" /></center>
                                            <b><label style="margin-top:20px;" for="exampleInputFile">Photo
                                                    Upload</label></b>
                                            <input type="file" class="form-control" name="image"
                                                onChange="readURL(this)" id="exampleInputFile" aria-describedby="fileHelp">
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Date of Registration<span
                                                    style="color:red;">*</span></label>
                                            <div class="input-group date" id="date" data-target-input="nearest">
                                                <input type="text" name="created_at" placeholder="YYYY-MM-DD"
                                                    value="{{ $post->created_at }}"
                                                    class="form-control datetimepicker-input" data-target="#date">
                                                <div class="input-group-append" data-target="#date"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input type="hidden" name="pwd" value="0">
                                            <div class="icheck-midnightblue d-inline md-2" id="pwd">
                                                <input type="checkbox" name="pwd" id="is_pwd" value="1"
                                                    {{ $post->isPWD == 1 ? 'checked' : '' }}>
                                                <label for="is_pwd">Person w/Disability</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="fourps" value="0">
                                            <div class="icheck-midnightblue d-inline" id="4ps">
                                                <input type="checkbox" name="fourps" id="is_4ps" value="1"
                                                    {{ $post->is4Ps == 1 ? 'checked' : '' }}>
                                                <label for="is_4ps">4Ps Recepient</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="hidden" value="{{ $post->id }}" name="residentId">
                                        @foreach ($post->Parents as $parent)
                                            <input type="hidden" value="{{ $parent->id }}" name="parentid">
                                        @endforeach
                                        @foreach ($post->Voter as $voter)
                                            <input type="hidden" value="{{ $voter->id }}" name="vId">
                                        @endforeach
                                        <div class="card">
                                            <div class="card-header d-flex p-2">
                                                <ul class="nav nav-pills ml-auto">
                                                    <li class="nav-item "><a class="nav-link nav-navy active"
                                                            href="#personal" data-toggle="tab">Personal Information</a>
                                                    </li>
                                                    <li class="nav-item"><a class="nav-link" href="#address"
                                                            data-toggle="tab">Address</a></li>
                                                    <li class="nav-item"><a class="nav-link" href="#parent"
                                                            data-toggle="tab">Parent's Information</a></li>
                                                    <li class="nav-item"><a class="nav-link" href="#account"
                                                            data-toggle="tab">Account</a></li>
                                                </ul>
                                            </div><!-- /.card-header -->
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div class="active tab-pane" id="personal">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>First Name<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="70" value="{{ $post->firstName }}"
                                                                        id="firstName" placeholder="First Name"
                                                                        name="firstName">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Middle Name</label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="20" value="{{ $post->middleName }}"
                                                                        id="middleName" placeholder="Middle Name"
                                                                        name="middleName">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Last Name<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="50" value="{{ $post->lastName }}"
                                                                        id="lastName" placeholder="Last Name"
                                                                        name="lastName">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label for="gender">Gender<span
                                                                            style="color:red;">*</span></label>
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="gender" id="male" value="1"
                                                                            @if ($post->gender == 1) checked @endif>
                                                                        <label class="form-check-label"
                                                                            for="male">Male</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="gender" id="female" value="2"
                                                                            @if ($post->gender == 2) checked @endif>
                                                                        <label class="form-check-label"
                                                                            for="female">Female</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label for="birthdate">Birthdate<span
                                                                            style="color:red;">*</span></label>
                                                                    <div class="input-group date" id="birthdate"
                                                                        data-target-input="nearest">
                                                                        <input type="text" name="birthdate"
                                                                            placeholder="YYYY-MM-DD"
                                                                            value="{{ $post->birthdate }}"
                                                                            class="form-control datetimepicker-input"
                                                                            data-target="#birthdate">
                                                                        <div class="input-group-append"
                                                                            data-target="#birthdate"
                                                                            data-toggle="datetimepicker">
                                                                            <div class="input-group-text"><i
                                                                                    class="fa fa-calendar"></i></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Birthplace<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="100" name="birthPlace"
                                                                        value="{{ $post->birthPlace }}" id="birthPlace"
                                                                        placeholder="Place of Birth">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Age</label>
                                                                    <input type="text" name="age" value="18"
                                                                        id="age" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label>Civil Status<span
                                                                            style="color:red;">*</span></label>
                                                                    <select class="form-control select2"
                                                                        name="civilStatus">
                                                                        <option value="0" disabled>Please select your
                                                                            civil
                                                                            status</option>
                                                                        <option value="Single"
                                                                            @if ($post->civilStatus == 'Single') selected ="selected" @endif>
                                                                            Single
                                                                        </option>
                                                                        <option value="Married"
                                                                            @if ($post->civilStatus == 'Married') selected ="selected" @endif>
                                                                            Married
                                                                        </option>
                                                                        <option value="Widow/er"
                                                                            @if ($post->civilStatus == 'Widow/er') selected ="selected" @endif>
                                                                            Widow/er
                                                                        </option>
                                                                        <option value="Legally Separated"
                                                                            @if ($post->civilStatus == 'Legally Separated') selected ="selected" @endif>
                                                                            Legally
                                                                            Separated</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label>Profession/Occupation</label>
                                                                    <select class="form-control typeable-select2"
                                                                        name="occupation" id="occupation">
                                                                        <option value="{{ $post->occupation }}" selected>
                                                                            {{ $post->occupation }}</option>

                                                                        @foreach ($occupations as $occupation)
                                                                            <option value="{{ $occupation }}">
                                                                                {{ $occupation }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label>Religion<span
                                                                            style="color:red;">*</span></label>
                                                                    <select class="form-control typeable-select2"
                                                                        name="religion" id="religion">
                                                                        <option value="{{ $post->religion }}" selected>
                                                                            {{ $post->religion }}</option>

                                                                        @foreach ($religions as $religion)
                                                                            <option value="{{ $religion }}">
                                                                                {{ $religion }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label>Contact Number<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="50" name="contactNumber"
                                                                        value="{{ $post->contactNumber }}"
                                                                        id="contactNumber" placeholder="Contact Number">
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label>Voter's Id No.</label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="50" name="voterId"
                                                                        @foreach ($post->Voter as $voter) value='{{ $voter->voterId }}' @endforeach
                                                                        id="voterId" placeholder="Voter's Id No.">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label>Precint Assignment No.</label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="50" name="precintNo"
                                                                        @foreach ($post->Voter as $voter) value="{{ $voter->precintNo }}" @endforeach
                                                                        id="precint"
                                                                        placeholder="Precint Assignment No.">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="address">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <label for="house_no">House Number<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="number" class="form-control"
                                                                        maxlength="50" value="{{ $post->house_no }}"
                                                                        id="house_no" placeholder="House Number"
                                                                        name="house_no">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="street">Street<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="70" value="{{ $post->street }}"
                                                                        id="street" placeholder="Street"
                                                                        name="street">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Citizenship<span
                                                                            style="color:red;">*</span></label>
                                                                    <select class="form-control select2"
                                                                        name="citizenship">
                                                                        <option value="0" disabled>Please select your
                                                                            citizenship</option>
                                                                        <option value="Filipino"
                                                                            @if ($post->citizenship == 'Filipino') selected ="selected" @endif>
                                                                            Filipino
                                                                        </option>
                                                                        <option value="Foreign"
                                                                            @if ($post->citizenship == 'Foreign') selected ="selected" @endif>
                                                                            Foreign
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-5">
                                                                    <label for="province">Province</label>
                                                                    <select class="form-control select2" id="province"
                                                                        name="province">
                                                                        <option value="{{ $post->province }}">
                                                                            {{ $post->province }}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label for="city">City<span
                                                                            style="color:red;">*</span></label>
                                                                    <select class="form-control select2" id="city"
                                                                        name="city">
                                                                        <option value="{{ $post->city }}">
                                                                            {{ $post->city }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label for="brgy">Brgy.<span
                                                                            style="color:red;">*</span></label>
                                                                    <select class="form-control select2" id="brgy"
                                                                        name="brgy">
                                                                        <option value="{{ $post->brgy }}">
                                                                            {{ $post->brgy }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.tab-pane -->
                                                    <div class="tab-pane" id="parent">
                                                        @foreach ($post->Parents as $parent)
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label>First Name<span
                                                                                style="color:red;">*</span></label>
                                                                        <input type="text" class="form-control"
                                                                            maxlength="70" name="motherFirstName"
                                                                            value="{{ $parent->motherfirstName }}"
                                                                            id="motherFirstName" placeholder="First Name">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label>Middle Name</label>
                                                                        <input type="text" class="form-control"
                                                                            maxlength="20" name="motherMiddleName"
                                                                            value="{{ $parent->mothermiddleName }}"
                                                                            id="motherMiddleName"
                                                                            placeholder="Middle Name">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label>Last Name<span
                                                                                style="color:red;">*</span></label>
                                                                        <input type="text" class="form-control"
                                                                            maxlength="50" name="motherLastName"
                                                                            value="{{ $parent->motherlastName }}"
                                                                            id="motherLastName" placeholder="Last Name">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">

                                                                        <div class="col-md-6">
                                                                            <label>First Name<span
                                                                                    style="color:red;">*</span></label>
                                                                            <input type="text" class="form-control"
                                                                                maxlength="70" name="fatherFirstName"
                                                                                value="{{ $parent->fatherfirstName }}"
                                                                                id="fatherFirstName"
                                                                                placeholder="First Name">
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <label>Middle Name</label>
                                                                            <input type="text" class="form-control"
                                                                                maxlength="20" name="fatherMiddleName"
                                                                                value="{{ $parent->fathermiddleName }}"
                                                                                id="fatherMiddleName"
                                                                                placeholder="Middle Name">
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <label>Last Name<span
                                                                                    style="color:red;">*</span></label>
                                                                            <input type="text" class="form-control"
                                                                                maxlength="50" name="fatherLastName"
                                                                                value="{{ $parent->fatherlastName }}"
                                                                                id="fatherLastName"
                                                                                placeholder="Last Name">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <!-- /.tab-pane -->
                                                    <div class="tab-pane" id="account">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label for="email">Email<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="70" value="{{ $user->email }}"
                                                                        id="email" placeholder="Email"
                                                                        name="email">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="password">Password<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ old('password') }}" id="password"
                                                                        placeholder="Password" name="password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.tab-pane -->
                                                </div>
                                                <!-- /.tab-content -->
                                            </div><!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                        <div class="form-group float-right">
                                            <a class="btn btn-secondary" href="{{ url()->previous() }}">Go Back</a>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            })

            $('.typeable-select2').select2({
                theme: 'bootstrap4',
                tags: true,
                placeholder: 'Select or type option',
                allowClear: true,
            })

            $('#date, #birthdate').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'en',
            })

            $('#precint').inputmask('9999a');
            $('#voterId').inputmask('9999-9999a-a999aaa99999-9');

            $('#contactNumber').inputmask({
                mask: ['9999-999-9999', '(02) 999 9999'],
                keepStatic: true,
                definitions: {
                    'a': {
                        validator: "[0-9]",
                        cardinality: 1,
                    }
                }
            });

            $('#date').on('change.datetimepicker', function(e) {
                today = new Date();
                date = moment(e.date).toDate();
                age = today.getFullYear() - date.getFullYear();
                m = today.getMonth() - date.getMonth();
                if (date >= today) {
                    alert('Invalid Date');
                }
            });

            $('#birthdate').ready(function() {
                var e = $('#birthdate').data("datetimepicker").date();
                var today = new Date();
                var birthDate = moment(e).toDate();
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (birthDate >= today) {
                    alert('Invalid Birthdate');
                } else {
                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    $('#age').val(age);
                }
            });

            $('#birthdate').on('change.datetimepicker', function(e) {
                console.log(e);
                var today = new Date();
                var birthDate = moment(e.date).toDate();
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (birthDate >= today) {
                    alert('Invalid Birthdate');
                } else {
                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    $('#age').val(age);
                }
            });

        })

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#pic')
                        .attr('src', e.target.result)
                        .width(300);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            const provinceDropdown = $('#province');
            const cityDropdown = $('#city');
            const barangayDropdown = $('#brgy');

            function resetDropdown(dropdown, placeholder = "Select") {
                dropdown.html(`<option value="">${placeholder}</option>`);
                dropdown.prop('disabled', true);
            }

            // Load Provinces
            $.ajax({
                url: '/admin/get-provinces',
                method: 'GET',
                success: function(data) {
                    var currentProvince = "{{ $post->province }}";
                    data.forEach(province => {
                        if (currentProvince == province) {
                            provinceDropdown.append(
                                `<option value="${province}" selected>${province}</option>`);
                        } else {
                            provinceDropdown.append(
                                `<option value="${province}">${province}</option>`);
                        }
                    });
                }
            });

            // On Province Change
            provinceDropdown.change(function() {
                const selectedProvince = $(this).val();
                resetDropdown(cityDropdown, "Select a city");
                resetDropdown(barangayDropdown, "Select a barangay");

                if (selectedProvince) {
                    $.ajax({
                        url: '/admin/get-cities',
                        method: 'GET',
                        data: {
                            province: selectedProvince
                        },
                        success: function(data) {
                            var currentCity = "{{ $post->city }}";
                            data.forEach(city => {
                                if (currentCity == province) {
                                    cityDropdown.append(
                                        `<option value="${city}" selected>${city}</option>`
                                    );
                                } else {
                                    cityDropdown.append(
                                        `<option value="${city}">${city}</option>`);
                                }
                            });
                            cityDropdown.prop('disabled', false);
                        }
                    });
                }
            });

            // On City Change
            cityDropdown.change(function() {
                const selectedProvince = provinceDropdown.val();
                const selectedCity = $(this).val();
                resetDropdown(barangayDropdown, "Select a barangay");

                if (selectedCity) {
                    $.ajax({
                        url: '/admin/get-barangays',
                        method: 'GET',
                        data: {
                            province: selectedProvince,
                            city: selectedCity
                        },
                        success: function(data) {
                            var currentBrgy = "{{ $post->brgy }}";
                            data.forEach(barangay => {
                                if (currentBrgy == barangay) {
                                    barangayDropdown.append(
                                        `<option value="${barangay}" selected>${barangay}</option>`
                                    );
                                } else {
                                    barangayDropdown.append(
                                        `<option value="${barangay}">${barangay}</option>`
                                    );
                                }
                            });
                            barangayDropdown.prop('disabled', false);
                        }
                    });
                }
            });
        });
    </script>
@stop
