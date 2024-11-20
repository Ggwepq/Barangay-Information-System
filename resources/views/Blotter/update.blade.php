@extends('adminlte::page')

@section('title', 'Blotter Records')

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
@stop

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

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Blotter</h3>
                            <div class="card-tools float-right">
                                <p class="card-text"><b>Note</b>: Fields with <span style="color:red;">*</span> are
                                    needed to filled out.</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/admin/Blotter/Update/' . $post->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="created_at">Date of Filing <span style="color:red;">*</span></label>
                                            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                                <input type="text" name="created_at" placeholder="YYYY-MM-DD"
                                                    value="{{ $post->created_at }}"
                                                    class="form-control datetimepicker-input"
                                                    data-target="#datetimepicker1" />
                                                <div class="input-group-append" data-target="#datetimepicker1"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Complainant <span style="color:red;">*</span></label>
                                            <select class="form-control select2 mr-3" name="complainant"
                                                style="height:100px;">
                                                @foreach ($resident as $res)
                                                    <option value="{{ $res->id }}"
                                                        @if ($post->complainant == $res->id) selected="selected" @endif>
                                                        {{ $res->firstName }} {{ $res->middleName }} {{ $res->lastName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Complained Resident <span style="color:red;">*</span></label>
                                            <select class="form-control select2" name="complainedResident">
                                                @foreach ($resident2 as $res2)
                                                    <option value="{{ $res2->id }}"
                                                        @if ($post->complainedResident == $res2->id) selected="selected" @endif>
                                                        {{ $res2->firstName }} {{ $res2->middleName }}
                                                        {{ $res2->lastName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Officer-in-charge <span style="color:red;">*</span></label>
                                            <select class="form-control select2" name="officerCharge">
                                                @foreach ($officer as $o)
                                                    <option
                                                        value="{{ $o->firstName }} {{ $o->Resident->middleName }} {{ $o->Resident->lastName }}">
                                                        {{ $o->Resident->firstName }} {{ $o->middleName }}
                                                        {{ $o->lastName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><span style="color:red;">Case No.*</span></label>
                                            <input type="number" class="form-control" maxlength="10"
                                                value="{{ $post->id }}" placeholder="Case No." name="id">
                                        </div>
                                        <div class="form-group">
                                            <label>Status <span style="color:red;">*</span></label>
                                            <select class="form-control" name="status">
                                                <option value="1"
                                                    @if ($post->status == 1) selected="selected" @endif>Pending
                                                </option>
                                                <option value="2"
                                                    @if ($post->status == 2) selected="selected" @endif>Ongoing
                                                </option>
                                                <option value="3"
                                                    @if ($post->status == 3) selected="selected" @endif>Resolved
                                                    Issue</option>
                                                <option value="4"
                                                    @if ($post->status == 4) selected="selected" @endif>File to
                                                    Action</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description <span style="color:red;">*</span></label>
                                            <textarea class="form-control" rows="5" maxlength="150" name="description" id="description">{{ $post->description }}</textarea>
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
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'en',
            })

            $('#date').on('change.datetimepicker', function() {
                today = new Date();
                date = new Date($(this).val());
                if (date >= today) {
                    alert('Invalid Date');
                    $(this).val(''); //clear the field if invalid date
                }
            });
            $('.select2').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@stop
