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
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Error!</h5>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Error!</h5>
            {{ session('error') }}
        </div>
    @endif

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Blotter</h3>
            <div class="card-tools">
                <p class="text-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are required.</p>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('/admin/Blotter/Store') }}" method="post">
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
                        <div class="form-group">
                            <label>Complainant <span style="color:red;">*</span></label>
                            <select class="form-control select2" name="complainant">
                                @foreach ($resident as $res)
                                    <option value="{{ $res->id }}">{{ $res->firstName }} {{ $res->middleName }}
                                        {{ $res->lastName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Complained Resident <span style="color:red;">*</span></label>
                            <select class="form-control select2" name="complainedResident">
                                @foreach ($resident2 as $res)
                                    <option value="{{ $res->id }}">{{ $res->firstName }} {{ $res->middleName }}
                                        {{ $res->lastName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Officer-in-charge <span style="color:red;">*</span></label>
                            <select class="form-control select2" name="officerCharge">
                                @foreach ($officer as $o)
                                    <option value="{{ $o->id }}">{{ $o->Resident->firstName }}
                                        {{ $o->middleName }} {{ $o->lastName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><span style="color:red;">Case No.*</span></label>
                            <input type="number" class="form-control" maxlength="10" value="{{ old('id') }}"
                                placeholder="Case No." name="id">
                        </div>
                        <div class="form-group">
                            <label>Status <span style="color:red;">*</span></label>
                            <select class="form-control" name="status" disabled>
                                <option value="1">Pending</option>
                                <option value="2">Ongoing</option>
                                <option value="3">Resolved Issue</option>
                                <option value="4">File to Action</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description <span style="color:red;">*</span></label>
                            <textarea class="form-control" rows="5" maxlength="150" name="description" id="description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
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
                    $(this).val(''); //clear the field if invalid date
                }
            });
            $('.select2').select2()
        })
    </script>
@stop
