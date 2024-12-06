@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')

    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-10">
                <h3 class="mb-0">Home</h3>
            </div>
            <div class="col-sm-2">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item active" aria-current="page">
                        Home
                    </li>
                </ol>
            </div>
        </div> <!--end::Row-->
    </div> <!--end::Container-->
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-navy">
                        <div class="card-header with-border d-inline-flex">
                            <h5 class="mr-auto mt-2">Resident Details</h5>
                            <div class="card-tools float-right ml-auto mt-2">
                                <p class="card-text"><b>Note</b>: This view displays resident information only. No changes
                                    can be made here.</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <center><img class="img-fluid" id="pic" src="{{ URL::asset($post->image) }}"
                                                alt="Profile Picture" style="max-width:200px; background-size: contain" />
                                        </center>
                                        <label style="margin-top:20px;" for="exampleInputFile">Photo</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Date of Registration</label>
                                        <p>{{ $post->created_at }}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <div class="icheck-midnightblue d-inline md-2" id="pwd">
                                            <input type="checkbox" disabled {{ $post->isPWD == 1 ? 'checked' : '' }}>
                                            <label>Person w/Disability</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="icheck-midnightblue d-inline" id="4ps">
                                            <input type="checkbox" disabled {{ $post->is4Ps == 1 ? 'checked' : '' }}>
                                            <label>4Ps Recepient</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h3 class="card-title">Personal Information</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool collapsed"
                                                    data-card-widget="collapse">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>First Name</label>
                                                        <p>{{ $post->firstName }}</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Middle Name</label>
                                                        <p>{{ $post->middleName }}</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Last Name</label>
                                                        <p>{{ $post->lastName }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Gender</label>
                                                        <p>{{ $post->gender == 1 ? 'Male' : ($post->gender == 2 ? 'Female' : '') }}
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label>Birthdate</label>
                                                        <p>{{ $post->birthdate }}</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Birthplace</label>
                                                        <p>{{ $post->birthPlace }}</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Age</label>
                                                        <p>18</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Civil Status</label>
                                                        <p>{{ $post->civilStatus }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Profession/Occupation</label>
                                                        <p>{{ $post->occupation }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Religion</label>
                                                        <p>{{ $post->religion }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Contact Number</label>
                                                        <p>{{ $post->contactNumber }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Voter's Id No.</label>
                                                        <p>{{ $post->Voter->count() > 0 ? $post->Voter[0]->voterId : '' }}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Precint Assignment No.</label>
                                                        <p>{{ $post->Voter->count() > 0 ? $post->Voter[0]->precintNo : '' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-secondary collapsed-card">
                                        <div class="card-header">
                                            <h3 class="card-title">Residence Information</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool collapsed"
                                                    data-card-widget="collapse">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label>House Number</label>
                                                        <p>{{ $post->house_no }}</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Street</label>
                                                        <p>{{ $post->street }}</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Citizenship</label>
                                                        <p>{{ $post->citizenship }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <label>Province</label>
                                                        <p>{{ $post->province }}</p>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label>City</label>
                                                        <p>{{ $post->city }}</p>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>Brgy.</label>
                                                        <p>{{ $post->brgy }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-secondary collapsed-card">
                                        <div class="card-header">
                                            <h3 class="card-title">Parent's Information</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool collapsed"
                                                    data-card-widget="collapse">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @foreach ($post->Parents as $parent)
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Mother's First Name</label>
                                                            <p>{{ $parent->motherfirstName }}</p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Mother's Middle Name</label>
                                                            <p>{{ $parent->mothermiddleName }}</p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Mother's Last Name</label>
                                                            <p>{{ $parent->motherlastName }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Father's First Name</label>
                                                                <p>{{ $parent->fatherfirstName }}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Father's Middle Name</label>
                                                                <p>{{ $parent->fathermiddleName }}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Father's Last Name</label>
                                                                <p>{{ $parent->fatherlastName }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card card-secondary collapsed-card">
                                        <div class="card-header">
                                            <h3 class="card-title">Account Details</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool collapsed"
                                                    data-card-widget="collapse">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>Email</label>
                                                        <p>{{ $user->email }}</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group float-right">
                                        <a class="btn btn-secondary" href="{{ url()->previous() }}">Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
