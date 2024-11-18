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
                    <li class="breadcrumb-item active">Update Resident</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
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

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Update Resident</h3>
            <p class="card-text float-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled
                out.</p>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{ url('admin/Resident/Update/' . $post->id) }}" method="post" files="true"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-3">
                        <div class="form-group" style="border:1px solid black; padding:10px">
                            <center><img class="img-fluid" id="pic" src="{{ URL::asset($post->image) }}"
                                    alt="Profile Picture" style="max-width:200px; background-size: contain" /></center>
                            <b><label style="margin-top:20px;" for="exampleInputFile">Photo Upload</label></b>
                            <input type="file" class="form-control-file" name="image" onChange="readURL(this)"
                                id="exampleInputFile" aria-describedby="fileHelp">
                        </div>
                        <div class="form-group">
                            <label>Date of Registration<span style="color:red;">*</span></label>
                            <input type="date" class="form-control" name="created_at" value="{{ $post->created_at }}"
                                id="date">
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
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Personal Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>First Name<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="70"
                                                value="{{ $post->firstName }}" id="firstName" placeholder="First Name"
                                                name="firstName">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Middle Name</label>
                                            <input type="text" class="form-control" maxlength="20"
                                                value="{{ $post->middleName }}" id="middleName" placeholder="Middle Name"
                                                name="middleName">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Last Name<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="50"
                                                value="{{ $post->lastName }}" id="lastName" placeholder="Last Name"
                                                name="lastName">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label>Street<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="70"
                                                value="{{ $post->street }}" id="street" placeholder="Street"
                                                name="street">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Brgy.<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="50"
                                                value="{{ $post->brgy }}" id="brgy" placeholder="Brgy"
                                                name="brgy">
                                        </div>
                                        <div class="col-md-3">
                                            <label>City<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="50"
                                                value="{{ $post->city }}" id="city" placeholder="City"
                                                name="city">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Province</label>
                                            <input type="text" class="form-control" maxlength="100"
                                                value="{{ $post->province }}" id="province" placeholder="Province"
                                                name="province">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Citizenship<span style="color:red;">*</span></label>
                                            <select class="form-control select2" name="citizenship">
                                                <option value="0" disabled>Please select your citizenship</option>
                                                <option value="Filipino"
                                                    @if ($post->citizenship == 'Filipino') selected ="selected" @endif>Filipino
                                                </option>
                                                <option value="Foreign"
                                                    @if ($post->citizenship == 'Foreign') selected ="selected" @endif>Foreign
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Religion<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="50"
                                                value="{{ $post->religion }}" id="religion" placeholder="Religion"
                                                name="religion">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="gender"
                                                    @if ($post->gender == 1) checked @endif id="inlineCheckbox1"
                                                    value="1"> Male
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="gender"
                                                    @if ($post->gender == 2) checked @endif id="inlineCheckbox2"
                                                    value="2"> Female
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Birthdate<span style="color:red;">*</span></label>
                                            <input type="date" class="form-control" name="birthdate"
                                                value="{{ $post->birthdate }}" id="bday">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Birthplace<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="100" name="birthPlace"
                                                value="{{ $post->birthPlace }}" id="birthPlace"
                                                placeholder="Place of Birth">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Age</label>
                                            <input type="text" value="18" id="age" class="form-control"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Civil Status<span style="color:red;">*</span></label>
                                            <select class="form-control select2" name="civilStatus">
                                                <option value="0" disabled>Please select your civil status</option>
                                                <option value="Single"
                                                    @if ($post->civilStatus == 'Single') selected ="selected" @endif>Single
                                                </option>
                                                <option value="Married"
                                                    @if ($post->civilStatus == 'Married') selected ="selected" @endif>Married
                                                </option>
                                                <option value="Widow/er"
                                                    @if ($post->civilStatus == 'Widow/er') selected ="selected" @endif>Widow/er
                                                </option>
                                                <option value="Legally Separated"
                                                    @if ($post->civilStatus == 'Legally Separated') selected ="selected" @endif>Legally
                                                    Separated</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Profession/Occupation</label>
                                            <input type="text" class="form-control" maxlength="70" name="occupation"
                                                value="{{ $post->occupation }}" id="occupation"
                                                placeholder="Profession/Occupation">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Tin No.</label>
                                            <input type="text" class="form-control" name="tinNo"
                                                value="{{ $post->tinNo }}" id="tin" placeholder="Tin No.">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Period of Residence<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="50"
                                                name="periodResidence" value="{{ $post->periodResidence }}"
                                                id="periodResidence" placeholder="Period of Residence">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Contact Number<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="50"
                                                name="contactNumber" value="{{ $post->contactNumber }}"
                                                id="contactNumber" placeholder="Contact Number">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Voter's Id No.</label>
                                            <input type="text" class="form-control" maxlength="50" name="voterId"
                                                @foreach ($post->Voter as $voter) value='{{ $voter->voterId }}' @endforeach
                                                id="voterId" placeholder="Voter's Id No.">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Precint Assignment No.</label>
                                            <input type="text" class="form-control" maxlength="50" name="precintNo"
                                                @foreach ($post->Voter as $voter) value="{{ $voter->precintNo }}" @endforeach
                                                id="precint" placeholder="Precint Assignment No.">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Mother's Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($post->Parents as $parent)
                                        <div class="col-md-6">
                                            <label>First Name<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="70"
                                                name="motherFirstName" value="{{ $parent->motherfirstName }}"
                                                id="motherFirstName" placeholder="First Name">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Middle Name</label>
                                            <input type="text" class="form-control" maxlength="20"
                                                name="motherMiddleName" value="{{ $parent->mothermiddleName }}"
                                                id="motherMiddleName" placeholder="Middle Name">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Last Name<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="50"
                                                name="motherLastName" value="{{ $parent->motherlastName }}"
                                                id="motherLastName" placeholder="Last Name">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Father's Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($post->Parents as $parent)
                                        <div class="col-md-6">
                                            <label>First Name<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="70"
                                                name="fatherFirstName" value="{{ $parent->fatherfirstName }}"
                                                id="fatherFirstName" placeholder="First Name">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Middle Name</label>
                                            <input type="text" class="form-control" maxlength="20"
                                                name="fatherMiddleName" value="{{ $parent->fathermiddleName }}"
                                                id="fatherMiddleName" placeholder="Middle Name">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Last Name<span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="50"
                                                name="fatherLastName" value="{{ $parent->fatherlastName }}"
                                                id="fatherLastName" placeholder="Last Name">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).on('focus', '#contactNumber', function() {
            $(this).popover({
                trigger: 'manual',
                content: function() {
                    var content =
                        '<button type="button" id="cp" class="btn btn-primary col-md-12">Mobile No.</button><button type="button" id="tp" class="btn btn-primary col-md-12">Telephone No.</button>';
                    return content;
                },
                html: true,
                placement: function() {
                    var placement = 'top';
                    return placement;
                },
                template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
                title: function() {
                    var title = 'Choose a format:';
                    return title;
                }
            });
            $(this).popover('show');
        });
        $(document).on('focusout', '#contactNumber', function() {
            $(this).popover('hide');
        });
        $(document).on('click', '#cp', function() {
            $('#contactNumber').val('');
            $('#contactNumber').inputmask("9999-999-9999");
        });
        $(document).on('click', '#tp', function() {
            $('#contactNumber').val('');
            $('#contactNumber').inputmask("(02) 999 9999");
        });

        $(document).ready(function() {
            $('#tin').inputmask("99-9999999");
            $('#precint').inputmask('9999a');
            $('#voterId').inputmask('9999-9999a-a999aaa99999-9');
            //$('#date').inputmask('9999-99-99'); // Removed since we are using date input type

            today = new Date();
            birthDate = new Date($('#bday').val());
            age = today.getFullYear() - birthDate.getFullYear();
            m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            $('#age').val(age);
        });

        $('#date').on('change', function() {
            today = new Date();
            date = new Date($('#date').val());
            age = today.getFullYear() - date.getFullYear();
            m = today.getMonth() - date.getMonth();
            if (date >= today) {
                alert('Invalid Date');
            }
        });

        $('#bday').on('change', function() {
            today = new Date();
            birthDate = new Date($('#bday').val());
            age = today.getFullYear() - birthDate.getFullYear();
            m = today.getMonth() - birthDate.getMonth();
            if (birthDate >= today) {
                alert('Invalid Birthdate');
            } else {
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                $('#age').val(age);
            }
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
@stop
