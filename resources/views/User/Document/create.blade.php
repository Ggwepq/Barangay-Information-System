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
                        <!-- Document Type -->
                        <div class="form-group row">
                            <label for="document_type" class="col-sm-2 col-form-label">Document</label>
                            <select class="form-control col-sm-9" id="document_type" name="document_type">
                                <option value="" disabled selected>Select Document</option>
                                <option value="Barangay Clearance"
                                    {{ old('document_type') == 'Barangay Clearance' ? 'selected' : '' }}>Barangay Clearance
                                </option>
                                <option value="Certificate of Indigency"
                                    {{ old('document_type') == 'Certificate of Indigency' ? 'selected' : '' }}>Certificate
                                    of Indigency</option>
                                <option value="Certificate of Residency"
                                    {{ old('document_type') == 'Certificate of Residency' ? 'selected' : '' }}>Certificate
                                    of Residency</option>
                                <option value="Certificate of Good Moral Character"
                                    {{ old('document_type') == 'Certificate of Good Moral Character' ? 'selected' : '' }}>
                                    Certificate of Good Moral Character</option>
                            </select>
                        </div>

                        <!-- Purpose -->
                        <div class="form-group row">
                            <label for="purpose" class="col-sm-2 col-form-label">Purpose</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="purpose" name="purpose"
                                    placeholder="Scholarship" value="{{ old('purpose') }}">
                            </div>
                        </div>

                        <!-- Additional Fields Based on Document -->
                        <div id="additional-fields">
                            <!-- Fields for Barangay Clearance -->
                            <div id="barangay-clearance-fields" class="conditional-fields d-none">
                                <div class="form-group row">
                                    <label for="requested_by" class="col-sm-2 col-form-label">Requested By</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="requested_by" name="requested_by"
                                            placeholder="Your Name">
                                    </div>
                                </div>
                            </div>

                            <!-- Fields for Certificate of Residency -->
                            <div id="residency-fields" class="conditional-fields d-none">
                                <div class="form-group row">
                                    <label for="years_of_residency" class="col-sm-2 col-form-label">Years of
                                        Residency</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="years_of_residency"
                                            name="years_of_residency" placeholder="Enter years of residency">
                                    </div>
                                </div>
                            </div>

                            <!-- Fields for Certificate of Indigency -->
                            <div id="indigency-fields" class="conditional-fields d-none">
                                <div class="form-group row">
                                    <label for="income" class="col-sm-2 col-form-label">Monthly Income</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="income" name="income"
                                            placeholder="Enter monthly income">
                                    </div>
                                </div>
                            </div>

                            <!-- Fields for Certificate of Good Moral Character -->
                            <div id="moral-character-fields" class="conditional-fields d-none">
                                <div class="form-group row">
                                    <label for="reference" class="col-sm-2 col-form-label">Reference Person</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="reference" name="reference"
                                            placeholder="Name of reference person">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
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

@section('js')

    <script>
        $(document).ready(function() {
            // Handle document type change
            // $('#document_type').on('change', function() {
            //     // Hide all conditional fields
            //     $('.conditional-fields').addClass('d-none');
            //
            //     // Show the relevant fields based on selected document type
            //     var selectedType = $(this).val();
            //
            //     if (selectedType === 'Barangay Clearance') {
            //         $('#barangay-clearance-fields').removeClass('d-none');
            //     } else if (selectedType === 'Certificate of Residency') {
            //         $('#residency-fields').removeClass('d-none');
            //     } else if (selectedType === 'Certificate of Indigency') {
            //         $('#indigency-fields').removeClass('d-none');
            //     } else if (selectedType === 'Certificate of Good Moral Character') {
            //         $('#moral-character-fields').removeClass('d-none');
            //     }
            // });
            //
            // // Trigger the change event on load to handle old values
            // $('#document_type').trigger('change');
        });
    </script>
@endsection
