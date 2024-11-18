@extends('adminlte::page')

@section('title', 'Business')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Business</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Business</li>
                </ol>
            </div>
        </div>
    </div>
@stop


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">New Business</h3>
                            <div class="card-tools">
                                <p class="text-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are
                                    required.</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/admin/Business/Store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="created_at">Date of Registration <span style="color:red;">*</span></label>
                                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                        <input type="text" name="created_at" id="date"
                                            value="{{ old('created_at') }}" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker1" />
                                        <div class="input-group-append" data-target="#datetimepicker1"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name">Business Name <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="70"
                                                value="{{ old('name') }}" placeholder="Business Name" name="name">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="residentId">Owner <span style="color:red;">*</span></label>
                                            <select class="form-control select2" name="residentId">
                                                @foreach ($resident as $res)
                                                    <option value="{{ $res->id }}">{{ $res->firstName }}
                                                        {{ $res->lastName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="street">Street <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="70"
                                                value="{{ old('street') }}" placeholder="Street" name="street">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="brgy">Brgy <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="50"
                                                value="{{ old('brgy') }}" placeholder="Brgy" name="brgy">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="city">City <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" maxlength="50"
                                                value="{{ old('city') }}" placeholder="City" name="city">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" maxlength="150" rows="5" placeholder="Description"></textarea>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @endsection

        @section('script')
            <script>
                $(function() {
                    $('#datetimepicker1').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });
                    $('#date').inputmask('9999-99-99');
                    $('#date').on('change', function() {
                        today = new Date();
                        date = new Date($(this).val());
                        if (date >= today) {
                            alert('Invalid Date');
                            $(this).val(''); // Clear the field if invalid date
                        }
                    });
                    $('.select2').select2()
                });
            </script>
        @stop
