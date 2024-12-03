@extends('adminlte::page')

@section('title', 'Request Document')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Request for Document</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/user/home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/user/document') }}">Documents</a></li>
                    <li class="breadcrumb-item active">Request Document </li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-2">
                Request Document
            </div><!-- /.card-header -->
            <div class="card-body">
                <div id="settings">
                    <form class="form-horizontal" action="{{ url('user/document/store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="document_type" class="col-sm-2 col-form-label">Document</label>
                            <select class="form-control col-sm-9" name="document_type">
                                <option value="Barangay Certificate"
                                    {{ old('document_type') == 'Barangay Certificate' ? 'selected' : '' }}>
                                    Barangay Certificate</option>
                                <option value="Certificate of Indigency"
                                    {{ old('document_type') == 'Certificate of Indigency' ? 'selected' : '' }}>
                                    Certificate of Indigency</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="purpose" class="col-sm-2 col-form-label">Purpose</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="purpose" name="purpose"
                                    placeholder="Scholarship" value="{{ old('purpose') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
