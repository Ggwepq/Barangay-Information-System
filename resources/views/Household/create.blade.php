@extends('adminlte::page')

@section('title', 'New Household')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New Household</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">New Household</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-outline card-navy">
        <div class="card-header">
            <h3 class="card-title">New Household</h3>
            <div class="card-tools float-right">
                <p class="card-text"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled out.
                </p>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/Household/Store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Household Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id">Household No.<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('id') }}" id="no"
                                        maxlength="50" name="id" placeholder="Household No.">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <label for="street">Street<span style="color:red;">*</span></label>
                                            <input type="text" value="{{ old('street') }}" class="form-control"
                                                maxlength="70" id="street" placeholder="Street" name="street">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="brgy">Brgy.<span style="color:red;">*</span></label>
                                            <input type="text" value="{{ old('brgy') }}" class="form-control"
                                                maxlength="50" id="brgy" placeholder="Brgy" name="brgy">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="city">City<span style="color:red;">*</span></label>
                                            <input type="text" value="{{ old('city') }}" class="form-control"
                                                maxlength="50" id="city" placeholder="City" name="city">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inhabitantss">Inhabitants<span style="color:red;">*</span></label>
                                    <select class="form-control select2" name="inhabitantss[]" multiple="multiple">
                                        @foreach ($resident as $res)
                                            <option value="{{ $res->id }}">{{ $res->firstName }} {{ $res->middleName }}
                                                {{ $res->lastName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Household Inhabitants</h3>
                                <div class="card-tools">
                                    <a href="#" id="remove" class="btn btn-sm btn-danger"
                                        title="Remove inhabitant"><i class="fas fa-trash"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="inhabit" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Civil Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <button class="btn btn-primary" style="margin-right:20px;">Submit</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#inhabit').DataTable();

            // Handle row selection
            $('#inhabit tbody').on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            // Handle removal of selected row
            $('#remove').click(function() {
                table.row('.selected').remove().draw(false);
            });

            // Handle select2 selection
            $('select').on('select2:select', function(e) {
                var data = e.params.data;
                inhabitant(data.id);
            });

            // Function to add inhabitant data to the table
            function inhabitant(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/Household/Inhabitant/' . ':id') }}".replace(':id', id),
                    dataType: "JSON",
                    success: function(data) {
                        for (var x = 0; x < data.length; x++) {
                            var sex = data[x].gender;
                            if (sex == 1) {
                                sex = "Male";
                            } else {
                                sex = "Female";
                            }
                            table.row.add([
                                data[x].firstName + data[x].middleName + data[x].lastName,
                                sex,
                                data[x].civilStatus
                            ]).draw();
                        }
                    }
                });
            }
        });
    </script>
@endsection
