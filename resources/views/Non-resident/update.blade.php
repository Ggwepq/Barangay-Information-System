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
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Resident</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    @if ($errors->any())
        <script>
            toastr.error('{{ implode('', $errors->all(':message')) }}', "There's something wrong!");
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error('{{ session('error') }}', "There's something wrong!");
        </script>
    @endif

    <div class="card card-outline card-navy">
        <div class="card-header">
            <h3 class="card-title">New Non-resident</h3>
            <p class="float-right"><b>Note:</b> Fields with <span class="text-danger">*</span> are required.</p>
        </div>
        <div class="card-body">
            <form action="{{ url('/admin/Resident/NotResident/Store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="image">Photo Upload</label>
                            <input type="file" class="form-control-file" name="image" id="image"
                                onchange="previewImage(event)">
                            <img id="preview" class="img-fluid mt-3" src="{{ asset('img/steve.jpg') }}" alt="Preview">
                        </div>
                        <div class="form-group">
                            <label for="created_at">Date of Registration<span class="text-danger">*</span></label>
                            <input type="date" name="created_at" value="{{ old('created_at') }}" class="form-control">
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-9">
                        <div class="card bg-dark text-white mb-3">
                            <div class="card-header">Personal Information</div>
                        </div>

                        <!-- Personal Info Fields -->
                        <div class="row">
                            <div class="col-md-6">
                                <x-adminlte-input name="firstName" label="First Name" placeholder="Enter First Name"
                                    value="{{ old('firstName') }}" required />
                            </div>
                            <div class="col-md-3">
                                <x-adminlte-input name="middleName" label="Middle Name" placeholder="Enter Middle Name"
                                    value="{{ old('middleName') }}" />
                            </div>
                            <div class="col-md-3">
                                <x-adminlte-input name="lastName" label="Last Name" placeholder="Enter Last Name"
                                    value="{{ old('lastName') }}" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Contact Number<span style="color:red;">*</span></label>
                            <input type="text" class="col-sm-6 form-control" value="{{ old('contactNumber') }}"
                                maxlength="50" name="contactNumber" id="contactNumber" placeholder="Contact Number">
                        </div>
                        <div class="col-sm-4">
                            <label>Voter's Id No.<span style="color:red;"></span></label>
                            <input type="text" class="col-sm-6 form-control" value="{{ old('voterId') }}" maxlength="50"
                                name="voterId" id="voterId" placeholder="Voter's Id No.">
                        </div>
                        <div class="col-sm-4">
                            <label>Precint Assignment No.<span style="color:red;"></span></label>
                            <input type="text" class="col-sm-6 form-control" value="{{ old('precintNo') }}"
                                maxlength="50" name="precintNo" id="precint" placeholder="Precint Assignment No.">
                        </div>
                    </div>
                </div>
                <div class="" style="padding:10px; background:#252525; color:white;">
                    Mother's Information
                </div>
                <div style="margin-top:10px; margin-bottom:10px;">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>First Name<span style="color:red;">*</span></label>
                            <input type="text" class="col-sm-6 form-control" value="{{ old('motherFirstName') }}"
                                maxlength="70" name="motherFirstName" id="exampleInputEmail1" placeholder="First Name">
                        </div>
                        <div class="col-sm-3">
                            <label>Middle Name<span style="color:red;"></span></label>
                            <input type="text" class="col-sm-6 form-control" value="{{ old('motherMiddleName') }}"
                                maxlength="20" name="motherMiddleName" id="exampleInputEmail1"
                                placeholder="Middle Name">
                        </div>
                        <div class="col-sm-3">
                            <label>Last Name<span style="color:red;">*</span></label>
                            <input type="text" class="col-sm-6 form-control" value="{{ old('motherLastName') }}"
                                maxlength="50" name="motherLastName" id="exampleInputEmail1" placeholder="Last Name">
                        </div>
                    </div>
                </div>
                <input type="text" class="col-sm-6 form-control" maxlength="70" value="{{ old('fatherfirstName') }}"
                    name="fatherFirstName" id="exampleInputEmail1" placeholder="First Name">
        </div>
        <div class="col-sm-3">
            <label>Middle Name<span style="color:red;"></span></label>
            <input type="text" class="col-sm-6 form-control" maxlength="20" value="{{ old('fatherMiddleName') }}"
                name="fatherMiddleName" id="exampleInputEmail1" placeholder="Middle Name">
        </div>
        <div class="col-sm-3">
            <label>Last Name<span style="color:red;">*</span></label>
            <input type="text" class="col-sm-6 form-control" maxlength="50" value="{{ old('fatherLastName') }}"
                name="fatherLastName" id="exampleInputEmail1" placeholder="Last Name">
        </div>
    </div>
    </div>
    <div class="" style="padding:10px; background:#252525; color:white;">
        Father's Information
    </div>
    <div style="margin-top:10px; margin-bottom:10px;">
        <div class="row">
            <div class="col-sm-6">
                <label>First Name<span style="color:red;">*</span></label>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-5">
                            <label>Street<span style="color:red;">*</span></label>
                            <input type="text" class="col-sm-6 form-control" value="{{ old('street') }}"
                                maxlength="70" id="exampleInputEmail1" placeholder="Street" name="street">
                        </div>
                        <div class="col-sm-4">
                            <label>Brgy.<span style="color:red;">*</span></label>
                            <input type="text" class="col-sm-6 form-control" value="{{ old('brgy') }}"
                                maxlength="50" id="exampleInputEmail1" placeholder="Brgy" name="brgy">
                        </div>
                        <div class="col-sm-3">
                            <label>City<span style="color:red;">*</span></label>
                            <input type="text" class="col-sm-6 form-control" value="{{ old('city') }}"
                                maxlength="50" id="exampleInputEmail1" placeholder="City" name="city">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Province<span style="color:red;"></span></label>
                            <input type="text" class="col-sm-6 form-control" value="{{ old('province') }}"
                                maxlength="100" id="exampleInputEmail1" placeholder="Province" name="province">
                        </div>
                        <div class="col-sm-3">
                            <label>Citizenship<span style="color:red;">*</span></label>
                            <select class="form-control select" name="citizenship">
                                <option value="0" disabled>Please select your citizenship</option>
                                <option value="Filipino">Filipino</option>
                                <option value="Foreign">Foreign</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Religion<span style="color:red;">*</span></label>
                            <input type="text" class="col-sm-6 form-control" value="{{ old('religion') }}"
                                maxlength="50" id="exampleInputEmail1" placeholder="Religion" name="religion">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3" style="margin-top:20px;">
                            <label class="checkbox-inline">
                                <input type="checkbox" checked name="gender" id="inlineCheckbox1" value="1"> Male
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="gender" id="inlineCheckbox2" value="2">
                                Female
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <label>Birthdate<span style="color:red;">*</span></label>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' name="birthdate" id="bday" value="{{ old('birthdate') }}"
                                    placeholder="YYYY-MM-DD" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label>Birthplace<span style="color:red;">*</span></label>
                            <input type="text" name="birthPlace" maxlength="100" value="{{ old('birthPlace') }}"
                                class="col-sm-6 form-control" id="exampleInputEmail1" placeholder="Place of Birth">
                        </div>
                        <div class="col-sm-3">
                            <label>Age<span style="color:red;"></span></label>
                            <input type="text" value="18" id="age" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Civil Status<span style="color:red;">*</span></label>
                            <select class="form-control select" name="civilStatus">
                                <option value="0" disabled>Please select your civil status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widow/er">Widow/er</option>
                                <option value="Legally Separated">Legally Separated</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Profession/Occupation<span style="color:red;"></span></label>
                            <input type="text" class="col-sm-6 form-control" value="{{ old('occupation') }}"
                                maxlength="70" name="occupation" id="exampleInputEmail1"
                                placeholder="Profession/Occupation">
                        </div>
                        <div class="col-sm-3">
                            <label>Tin No.<span style="color:red;"></span></label>
                            <input type="text" class="col-sm-6 form-control" value="{{ old('tinNo') }}"
                                maxlength="50" name="tinNo" id="tin" placeholder="Tin No.">
                        </div>
                        <div class="col-sm-3">
                            <label>Period of Residence<span style="color:red;">*</span></label>
                            <input type="text" class="col-sm-6 form-control" value="{{ old('periodResidence') }}"
                                maxlength="50" name="periodResidence" id="exampleInputEmail1"
                                placeholder="Period of Residence">
                        </div>

                        <!-- Additional Rows Here -->

                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    @stop

    @section('css')
        <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    @stop

    @section('js')
        <script src="{{ asset('js/toastr.js') }}"></script>
        <script>
            function previewImage(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    document.getElementById('preview').src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }

            // Input validation and formatting (update as needed)
        </script>
    @stop
