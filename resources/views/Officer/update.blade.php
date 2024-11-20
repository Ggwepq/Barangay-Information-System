@extends('adminlte::page')

@section('title', 'Officers')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update Officer</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/Officers') }}">Officers</a></li>
                    <li class="breadcrumb-item active">Update Officer</li>
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
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Officer</h3>
                        <div class="card-tools float-right">
                            <p class="card-text"><b>Note</b>: Fields with <span style="color:red;">*</span> are
                                needed to filled out.</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/admin/Officer/Update/' . $post->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Position<span style="color:Red;">*</span></label>
                                                <select class="form-control" name="position">
                                                    <option value="Kagawad"
                                                        @if ($post->position == 'Kagawad') selected @endif>Kagawad
                                                    </option>
                                                    <option value="Tanod"
                                                        @if ($post->position == 'Tanod') selected @endif>Tanod
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Resident<span style="color:Red;">*</span></label>
                                                <select class="form-control select2" name="residentId">
                                                    @foreach ($resident as $res)
                                                        <option value="{{ $res->id }}"
                                                            @if ($res->id == $post->residentId) selected @endif>
                                                            {{ $res->firstName }}
                                                            {{ $res->middleName }} {{ $res->lastName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card bg-dark text-white mb-3">
                                                <div class="card-header">Account Information</div>
                                            </div>

                                            @foreach ($post->User as $user)
                                                <input type="hidden" value="{{ $user->id }}" name="userId">
                                                <input type="hidden" value="{{ $user->officerId }}" name="officerId">

                                                <div class="form-group">
                                                    <label>Email Address<span style="color:Red;">*</span></label>
                                                    <input type="email" class="form-control" value="{{ $user->email }}"
                                                        name="email" placeholder="Email Address" required>
                                                </div>
                                            @endforeach

                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control" name="conpassword"
                                                    placeholder="Confirm Password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
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
                theme: bootstrap4
            });
        });
    </script>

    // Just for syntax highlighting :D
    @if (session('success'))
        <script type="text/javascript">
            toastr.success('{{ session('success') }}', 'Success!');
        </script>
    @endif
    @if (session('error'))
        <script type="text/javascript">
            toastr.error('{{ session('error') }}', "There's something wrong!");
        </script>
    @endif
@stop
