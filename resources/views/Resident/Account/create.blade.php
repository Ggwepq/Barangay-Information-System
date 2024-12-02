@extends('adminlte::page')

@section('title', 'Resident Accounts')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Resident Account</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/Resident') }}">Resident</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/Resident/Account') }}">Account</a></li>
                    <li class="breadcrumb-item active">Create Resident Account</li>
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


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-navy">
                    <div class="card-header">
                        <h3 class="card-title">Create Resident Account</h3>
                        <div class="card-tools float-right">
                            <p class="card-text"><b>Note</b>: Fields with <span style="color:red;">*</span> are
                                needed to filled out.</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/admin/Resident/Account/Store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Resident<span style="color:Red;">*</span></label>
                                        <select class="form-control select2" name="residentId">
                                            @foreach ($residents as $res)
                                                <option value="{{ $res->id }}">{{ $res->firstName }}
                                                    {{ $res->middleName }}
                                                    {{ $res->lastName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="card bg-dark mb-3">
                                        <div class="card-body text-white">
                                            Account Information
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address<span style="color:Red;">*</span></label>
                                        <input type="email" class="form-control" value="{{ old('email') }}"
                                            name="email" id="email" placeholder="Email Address">
                                    </div>
                                    <div class="form-group">
                                        <label>Password<span style="color:Red;">*</span></label>
                                        <input type="password" class="form-control" name="password" placeholder="Password"
                                            value="{{ old('password') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password<span style="color:Red;">*</span></label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="Confirm Password">
                                    </div>
                                    <div class="form-group text-right">
                                        <a class="btn btn-secondary mx-2" href="{{ url('/admin/Resident/Account') }}">Go
                                            Back</a>
                                        <button class="btn btn-primary float-right" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop



@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            }); // Initialize Select2
            $('#email').inputmask('email'); //If using Inputmask
        });
    </script>
@stop
