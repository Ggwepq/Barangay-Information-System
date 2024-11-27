@extends('adminlte::page')

@section('title', 'Edit Schedule')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Schedule</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/Schedule') }}">Schedules</a></li>
                    <li class="breadcrumb-item active">Edit Schedule</li>
                </ol>
            </div>
        </div>
    </div>
@stop


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
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Schedule</h3>
                            <div class="card-tools float-right">
                                <p class="card-text"><b>Note</b>: Fields with <span style="color:red;">*</span> are
                                    needed to filled out.</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="bg-dark p-2 mb-3 text-white">
                                Schedule Information
                            </div>
                            <form action="{{ url('/admin/Schedule/Update/' . $post->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="residentId">Resident<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="residentId" id="residentId">
                                        @foreach ($resident as $res)
                                            <option value="{{ $res->id }}"
                                                @if ($post->residentId == $res->id) selected @endif>
                                                {{ $res->firstName }} {{ $res->middleName }} {{ $res->lastName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="date">Date<span class="text-danger">*</span></label>
                                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                        <input type="text" id="date" name="date" value="{{ $post->date }}"
                                            placeholder="YYYY-MM-DD" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker1" />
                                        <div class="input-group-append" data-target="#datetimepicker1"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="start">Start<span class="text-danger">*</span></label>
                                    <div class="input-group date" id="timepicker1" data-target-input="nearest">
                                        <input type="text" name="start" value="{{ $post->start }}"
                                            class="form-control datetimepicker-input" data-target="#timepicker1" />
                                        <div class="input-group-append" data-target="#timepicker1"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="end">End<span class="text-danger">*</span></label>
                                    <div class="input-group date" id="timepicker2" data-target-input="nearest">
                                        <input type="text" name="end" value="{{ $post->end }}"
                                            class="form-control datetimepicker-input" data-target="#timepicker2" />
                                        <div class="input-group-append" data-target="#timepicker2"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="officerId">Officer-in-Charge<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="officerId" id="officerId">
                                        @foreach ($officer as $of)
                                            <option value="{{ $of->id }}"
                                                @if ($post->officerId == $of->id) selected @endif>
                                                {{ $of->Resident->firstName }} {{ $of->Resident->middleName }}
                                                {{ $of->Resident->lastName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="float-right">
                                    <a class="btn btn-secondary" href="{{ url('/admin/Schedule') }}">Go Back</a>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            $('#date').inputmask('9999-99-99');
            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $('#timepicker1, #timepicker2').datetimepicker({
                format: 'HH:mm'
            });
        });
    </script>
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success!');
        </script>
    @endif
@stop
