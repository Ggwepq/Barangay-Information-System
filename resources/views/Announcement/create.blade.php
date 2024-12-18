@extends('adminlte::page')

@section('title', 'Announcements')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Announcements</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/announcement') }}">Announcements</a></li>
                    <li class="breadcrumb-item active">Create Announcments</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-2">
                Create Announcement
            </div><!-- /.card-header -->
            <div class="card-body">
                <div id="settings">
                    <form class="form-horizontal" action="{{ url('admin/announcement/store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Name"
                                    value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description" name="content">{{ old('description') }}</textarea>
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

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select recipients",
                allowClear: true,
                theme: 'bootstrap4',
            });

            $('#description').summernote({
                height: 600,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Adjust dropdowns to use Bootstrap 5 attributes
            setTimeout(function() {
                var elements = document.querySelectorAll('[data-toggle="dropdown"]');
                elements.forEach(function(element) {
                    element.setAttribute('data-bs-toggle', 'dropdown');
                    element.setAttribute('data-bs-auto-close', 'outside');
                    element.removeAttribute('data-toggle');

                    // Handle dropdown toggle
                    $(element.nextElementSibling).on('click', function(e) {
                        element.click();
                    });
                });

                // Add event listener to close dropdowns when clicking outside
                document.addEventListener('click', function(event) {
                    elements.forEach(function(element) {
                        var dropdownMenu = element.nextElementSibling;
                        if (
                            !dropdownMenu.contains(event.target) &&
                            !element.contains(event.target)
                        ) {
                            // Close the dropdown
                            $(element).dropdown('hide');
                        }
                    });
                });
            }, 1000);
        });
    </script>
@endsection
