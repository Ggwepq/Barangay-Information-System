@extends('adminlte::page')

@section('title', 'New Resident')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New Resident</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/Resident') }}">Residents</a></li>
                    <li class="breadcrumb-item active">New Resident</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-navy">
                        <div class="card-header with-border d-inline-flex">
                            <h6 class="mr-auto mt-2"> New Resident Information</h6>
                            <div class="card-tools float-right ml-auto mt-2">
                                <p class="card-text"><b>Note</b>: Fields with <span style="color:red;">*</span> are
                                    needed to filled out.</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('admin/Resident/Store') }}" method="post" files="true"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <center>
                                                <img class="img-fluid img-thumbnail" id="pic"
                                                    src="{{ URL::asset('img/uploads/steve.jpg') }}" alt="Resident Photo"
                                                    style="max-width: 200px; background-size: contain;">
                                            </center>
                                            <label for="exampleInputFile" class="form-label">Photo Upload</label>
                                            <input type="file" class="form-control " name="image"
                                                onChange="readURL(this)" id="exampleInputFile" aria-describedby="fileHelp">
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Date of Registration<span
                                                    style="color:red;">*</span></label>
                                            <div class="input-group date" id="date" data-target-input="nearest">
                                                <input type="text" name="created_at" placeholder="YYYY-MM-DD"
                                                    value="{{ date('Y-m-d H:i:s') }}"
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
                                                <input type="checkbox" name="pwd" id="is_pwd" value="1">
                                                <label for="is_pwd">Person w/Disability</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="fourps" value="0">
                                            <div class="icheck-midnightblue d-inline" id="4ps">
                                                <input type="checkbox" name="fourps" id="is_4ps" value="1">
                                                <label for="is_4ps">4Ps Recepient</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card">
                                            <div class="card-header d-flex p-2">
                                                <ul class="nav nav-pills ml-auto">
                                                    <li class="nav-item "><a class="nav-link nav-navy active"
                                                            href="#personal" data-toggle="tab">Personal Information</a></li>
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
                                                                <div class="col-sm-6">
                                                                    <label for="firstName">First Name<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="70" value="{{ old('firstName') }}"
                                                                        id="firstName" placeholder="First Name"
                                                                        name="firstName">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label for="middleName">Middle Name</label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="20" value="{{ old('middleName') }}"
                                                                        id="middleName" placeholder="Middle Name"
                                                                        name="middleName">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label for="lastName">Last Name<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="50" value="{{ old('lastName') }}"
                                                                        id="lastName" placeholder="Last Name"
                                                                        name="lastName">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <label for="gender">Gender<span
                                                                            style="color:red;">*</span></label>
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="gender" id="male" value="1"
                                                                            {{ old('gender') == 1 ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="male">Male</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="gender" id="female" value="2"
                                                                            {{ old('gender') == 2 ? 'checked' : '' }}>
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
                                                                            value="{{ old('birthdate') }}"
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
                                                                <div class="col-sm-3">
                                                                    <label for="birthPlace">Birthplace<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="100" value="{{ old('birthPlace') }}"
                                                                        id="birthPlace" placeholder="Place of Birth"
                                                                        name="birthPlace">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label for="age">Age</label>
                                                                    <input type="text" name="age" value="18"
                                                                        id="age" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label for="civilStatus">Civil Status<span
                                                                            style="color:red;">*</span></label>
                                                                    <select class="form-control" name="civilStatus">
                                                                        <option value="Single"
                                                                            {{ old('civilStatus') == 'Single' ? 'selected' : '' }}>
                                                                            Single</option>
                                                                        <option value="Married"
                                                                            {{ old('civilStatus') == 'Married' ? 'selected' : '' }}>
                                                                            Married</option>
                                                                        <option value="Widow/er"
                                                                            {{ old('civilStatus') == 'Widow/er' ? 'selected' : '' }}>
                                                                            Widow/er</option>
                                                                        <option value="Legally Separated"
                                                                            {{ old('civilStatus') == 'Legally Separated' ? 'selected' : '' }}>
                                                                            Legally Separated</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label for="occupation">Occupation</label>
                                                                    <select class="form-control typeable-select2"
                                                                        name="occupation">
                                                                        @for ($i = 0; $i <= count($occupations) - 1; $i++)
                                                                            <option value="{{ $occupations[$i] }}"
                                                                                {{ old('occupation') == $occupations[$i] ? 'selected' : '' }}>
                                                                                {{ $occupations[$i] }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label for="religion">Religion<span
                                                                            style="color:red;">*</span></label>
                                                                    <select class="form-control typeable-select2"
                                                                        name="religion">
                                                                        @for ($i = 0; $i <= count($religions) - 1; $i++)
                                                                            <option value="{{ $religions[$i] }}"
                                                                                {{ old('religion') == $religions[$i] ? 'selected' : '' }}>
                                                                                {{ $religions[$i] }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label for="contactNumber">Contact Number<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="50" value="{{ old('contactNumber') }}"
                                                                        id="contactNumber" placeholder="Contact Number"
                                                                        name="contactNumber">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label for="voterId">Voter's Id No.</label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="50" value="{{ old('voterId') }}"
                                                                        id="voterId" placeholder="Voter's Id No."
                                                                        name="voterId">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label for="precintNo">Precint Assignment No.</label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="50" value="{{ old('precintNo') }}"
                                                                        id="precintNo"
                                                                        placeholder="Precint Assignment No."
                                                                        name="precintNo">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.tab-pane -->
                                                    <div class="tab-pane" id="address">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <label for="house_no">House Number<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="50" value="{{ old('house_no') }}"
                                                                        id="house_no" placeholder="House Number"
                                                                        name="house_no">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="street">Street<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="70" value="{{ old('street') }}"
                                                                        id="street" placeholder="Street"
                                                                        name="street">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label for="citizenship">Citizenship<span
                                                                            style="color:red;">*</span></label>
                                                                    <select class="form-control" name="citizenship">
                                                                        <option value="Filipino"
                                                                            {{ old('citizenship') == 'Filipino' ? 'selected' : '' }}>
                                                                            Filipino</option>
                                                                        <option value="Foreign"
                                                                            {{ old('citizenship') == 'Foreign' ? 'selected' : '' }}>
                                                                            Foreign</option>
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
                                                                        <option value="">Select a province</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label for="city">City<span
                                                                            style="color:red;">*</span></label>
                                                                    <select class="form-control select2" id="city"
                                                                        name="city" disabled>
                                                                        <option value="">Select a city</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label for="brgy">Brgy.<span
                                                                            style="color:red;">*</span></label>
                                                                    <select class="form-control select2" id="brgy"
                                                                        name="brgy" disabled>
                                                                        <option value="">Select a barangay</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- /.tab-pane -->
                                                    <div class="tab-pane" id="parent">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label for="motherFirstName">Mother First Name<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="70"
                                                                        value="{{ old('motherFirstName') }}"
                                                                        id="motherFirstName" placeholder="First Name"
                                                                        name="motherFirstName">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label for="motherMiddleName">Mother Middle
                                                                        Name</label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="20"
                                                                        value="{{ old('motherMiddleName') }}"
                                                                        id="motherMiddleName" placeholder="Middle Name"
                                                                        name="motherMiddleName">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label for="motherLastName">Mother Last Name<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="50"
                                                                        value="{{ old('motherLastName') }}"
                                                                        id="motherLastName" placeholder="Last Name"
                                                                        name="motherLastName">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label for="fatherFirstName">Father First Name<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="70"
                                                                        value="{{ old('fatherFirstName') }}"
                                                                        id="fatherFirstName" placeholder="First Name"
                                                                        name="fatherFirstName">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label for="fatherMiddleName">Father Middle
                                                                        Name</label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="20"
                                                                        value="{{ old('fatherMiddleName') }}"
                                                                        id="fatherMiddleName" placeholder="Middle Name"
                                                                        name="fatherMiddleName">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label for="fatherLastName">Father Last Name<span
                                                                            style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="50"
                                                                        value="{{ old('fatherLastName') }}"
                                                                        id="fatherLastName" placeholder="Last Name"
                                                                        name="fatherLastName">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.tab-pane -->
                                                    <div class="tab-pane" id="account">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label for="email">Email<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="70" value="{{ old('email') }}"
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
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="d-flex justify-content-end">
                                    <a href="/admin/Resident" class="btn btn-secondary mr-2">Go Back</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            })

            $('.typeable-select2').select2({
                theme: 'bootstrap4',
                tags: true,
                placeholder: 'Select or type option',
                allowClear: true,
            })

            //Initialize Date Range Picker
            $('#date, #birthdate').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'en',
            })

            //Initialize Input Masks
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

            $('#precintNo').inputmask('9999a');
            $('#voterId').inputmask('9999-9999a-a999aaa99999-9');

            $('#date').on('change.datetimepicker', function(e) {
                today = new Date();
                date = moment(e.date).toDate();
                age = today.getFullYear() - date.getFullYear();
                m = today.getMonth() - date.getMonth();
                if (date >= today) {
                    alert('Invalid Date');
                }
                console.log($('#age').val());
            });

            $('#birthdate').on('change.datetimepicker', function(e) {
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
        });

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
                    data.forEach(province => {
                        provinceDropdown.append(
                            `<option value="${province}">${province}</option>`);
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
                            data.forEach(city => {
                                cityDropdown.append(
                                    `<option value="${city}">${city}</option>`);
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

                console.log(selectedProvince)

                if (selectedCity) {
                    $.ajax({
                        url: '/admin/get-barangays',
                        method: 'GET',
                        data: {
                            province: selectedProvince,
                            city: selectedCity
                        },
                        success: function(data) {
                            data.forEach(barangay => {
                                console.log(barangay)
                                barangayDropdown.append(
                                    `<option value="${barangay}">${barangay}</option>`
                                );
                            });
                            barangayDropdown.prop('disabled', false);
                        }
                    });
                }
            });
        });
    </script>

    @if ($errors->any())
        <script type="text/javascript">
            toastr.error('{{ implode('', $errors->all(':message')) }}', "There's something wrong!");
        </script>
    @endif
    </script>
@endsection
