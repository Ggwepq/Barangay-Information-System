@extends('adminlte::page')

@section('title', 'New Business')

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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Business Information</h3>
            <p class="card-text">Fields with <span style="color:red;">*</span> are required.</p>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/Business/Update/' . $post->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="date">Date of Registration*</label>
                    <div class="input-group date" id="datetimepicker1">
                        <input type="text" name="created_at" value="{{ $post->created_at }}" class="form-control"
                            id="date" placeholder="YYYY-MM-DD">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">


                    <div class="row">
                        <div class="col-sm-6">
                            <label for="name">Business Name*</label>
                            <input type="text" class="form-control" name="name" value="{{ $post->name }}"
                                placeholder="Business Name" maxlength="70">
                        </div>
                        <div class="col-sm-6">
                            <label for="residentId">Owner*</label>
                            <select class="form-control select2" name="residentId">
                                @foreach ($resident as $res)
                                    <option value="{{ $res->id }}" {{ $res->id == $post->id ? 'selected' : '' }}>
                                        {{ $res->firstName }} {{ $res->lastName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#date').on('change', function() {
            today = new Date();
            date = new Date($('#date').val());
            age = today.getFullYear() - date.getFullYear();
            m = today.getMonth() - date.getMonth();
            if (date >= today) {
                alert('Invalid Date');
            }
        });

        $(document).ready(function() {
            $('#date').inputmask('9999-99-99');
        });
    </script>
@stop
