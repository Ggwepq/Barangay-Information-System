@extends('adminlte::page')

@section('title', 'Household')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Blotter</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Blotter</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Blotter</h3>
            <div class="card-tools">
                <p class="pull-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled out.
                </p>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/Blotter/Store') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="created_at">Date of Filing <span style="color:red;">*</span></label>
                            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                <input type="text" name="created_at" placeholder="YYYY-MM-DD" id="date"
                                    value="{{ old('created_at') }}" class="form-control datetimepicker-input"
                                    data-target="#datetimepicker1" />
                                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id"><span style="color:red;">Case No.*</span></label>
                            <input type="number" class="form-control" maxlength="10" value="{{ old('id') }}"
                                placeholder="Case No." name="id">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span style="color:red;">*</span></label>
                            <select class="form-control" name="status" disabled>
                                <option value="1">Pending</option>
                                <option value="2">Ongoing</option>
                                <option value="3">Resolved Issue</option>
                                <option value="4">File to Action</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="complainant">Complainant <span style="color:red;">*</span></label>
                            <select class="form-control select2" name="complainant">
                                @foreach ($resident as $res)
                                    <option value="{{ $res->id }}">{{ $res->firstName }} {{ $res->middleName }}
                                        {{ $res->lastName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="complainedResident">Complained Resident <span style="color:red;">*</span></label>
                            <select class="form-control select2" name="complainedResident">
                                @foreach ($resident2 as $res)
                                    <option value="{{ $res->id }}">{{ $res->firstName }} {{ $res->middleName }}
                                        {{ $res->lastName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="officerCharge">Officer-in-charge <span style="color:red;">*</span></label>
                            <select class="form-control select2" name="officerCharge">
                                @foreach ($officer as $o)
                                    <option
                                        value="{{ $o->firstName }} {{ $o->Resident->middleName }} {{ $o->Resident->lastName }}">
                                        {{ $o->Resident->firstName }} {{ $o->middleName }} {{ $o->lastName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description <span style="color:red;">*</span></label>
                            <textarea class="form-control" rows="5" maxlength="150" name="description" id="description"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#date').inputmask('9999-99-99');
        });

        $('#date').on('change', function() {
            today = new Date();
            date = new Date($(this).val());
            if (date >= today) {
                alert('Invalid Date');
            }
        });
    </script>
@stop
