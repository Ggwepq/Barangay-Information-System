@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Settings</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/') }}">Home</a></li>
                    <li class="breadcrumb-item active">System Settings</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ url('/admin/settings/update') }}" method="post" enctype="multipart/form-data" class="row">
                @csrf
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="form-group">
                                <center>
                                    <img class="profile-user-img img-fluid img-circle" id="pic"
                                        src="{{ $post->logo ? URL::asset($post->logo) : URL::asset('img/uploads/settings/logo.png') }}"
                                        alt="Barangay Logo"
                                        style="max-width: 200px; background-size: contain; height:200px; width:200px">
                                </center>
                                <input type="file" class="form-control mt-4" name="logo" onChange="readURL(this)"
                                    id="exampleInputFile" aria-describedby="fileHelp">
                            </div>
                            <p class="text-muted text-center">Barangay Logo</p>
                            <button type="submit" class="btn btn-primary btn-block"><b>Update Settings</b></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings"
                                        data-toggle="tab">Settings</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">
                                    <div class="form-group row">
                                        <label for="province" class="col-sm-2 col-form-label">Province</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" id="province" name="province">
                                                <option value="">Select a province</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="city" class="col-sm-2 col-form-label">City</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" id="city" name="city">
                                                <option value="">Select a city</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="brgy" class="col-sm-2 col-form-label">Brgy Name</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" id="brgy" name="barangay_name">
                                                <option value="">Select a barangay</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="zone" class="col-sm-2 col-form-label">Zone</label>
                                        <div class="col-sm-10">
                                            <input name="zone" type="number" class="form-control" id="zone"
                                                placeholder="Zone" value="{{ $post->zone }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="district" class="col-sm-2 col-form-label">District</label>
                                        <div class="col-sm-10">
                                            <input name="district" type="number" class="form-control" id="district"
                                                placeholder="District" value="{{ $post->district }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Notification Method</label>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-secondary">
                                                <input type="radio" name="notification_method" id="option_a1"
                                                    value="SMS"> SMS
                                            </label>
                                            <label class="btn btn-secondary active">
                                                <input type="radio" name="notification_method" id="option_a2"
                                                    value="EMAIL" checked>
                                                EMAIL
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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

            // $('#submitBtn').on('click', function() {
            //     $('form').submit();
            // });
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

            // Get current address
            var currentProvince = "{{ $post->province }}";
            var currentCity = "{{ $post->city }}";
            var currentBarangay = "{{ $post->barangay_name }}";

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

            loadCityDropdown(currentProvince, cityDropdown);
            loadBarangayDropdown(currentProvince, currentCity, barangayDropdown);

            // On Province Change
            provinceDropdown.change(function() {
                const selectedProvince = $(this).val();
                resetDropdown(cityDropdown, "Select a city");
                resetDropdown(barangayDropdown, "Select a barangay");

                if (selectedProvince) {
                    loadCityDropdown(selectedProvince, cityDropdown);
                }
            });

            // On City Change
            cityDropdown.change(function() {
                const selectedProvince = provinceDropdown.val();
                const selectedCity = $(this).val();
                resetDropdown(barangayDropdown, "Select a barangay");

                if (selectedCity) {
                    loadBarangayDropdown(selectedProvince, selectedCity, barangayDropdown);
                }
            });
        });

        function loadCityDropdown(selectedProvince, cityDropdown) {
            console.log(selectedProvince);
            $.ajax({
                url: '/admin/get-cities',
                method: 'GET',
                data: {
                    province: selectedProvince
                },
                success: function(data) {
                    var currentCity = "{{ $post->city }}";
                    data.forEach(city => {
                        if (currentCity == city) {
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


        function loadBarangayDropdown(selectedProvince, selectedCity, barangayDropdown) {
            $.ajax({
                url: '/admin/get-barangays',
                method: 'GET',
                data: {
                    province: selectedProvince,
                    city: selectedCity
                },
                success: function(data) {
                    var currentBrgy = "{{ $post->barangay_name }}";
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
    </script>

    @if ($errors->any())
        <script type="text/javascript">
            toastr.error('{{ implode('', $errors->all(':message')) }}', "There's something wrong!");
        </script>
    @endif
    </script>
@endsection
