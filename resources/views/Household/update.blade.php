@extends('adminlte::page')

@section('title', 'Update Household')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Update Household</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Update Household</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Household Information</h3>
            <div class="card-tools">
                <p class="text-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are required.</p>
            </div>
        </div>
        <form action="{{ url('admin/Household/Update/' . $post->id) }}" method="post">
            @csrf
            <input type="hidden" value="{{ $post->id }}" name="householdId">
            <input type="hidden" value="{{ $inhabitant->id }}" name="inhabitantId">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="householdNo">Household No.<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="householdNo" maxlength="50"
                                value="{{ $post->id }}" name="id" placeholder="Household No.">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="street">Street<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" maxlength="70" value="{{ $post->street }}"
                                        id="street" placeholder="Street" name="street">
                                </div>
                                <div class="col-md-4">
                                    <label for="brgy">Brgy.<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" maxlength="50" value="{{ $post->brgy }}"
                                        id="brgy" placeholder="Brgy" name="brgy">
                                </div>
                                <div class="col-md-3">
                                    <label for="city">City<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" maxlength="50" value="{{ $post->city }}"
                                        id="city" placeholder="City" name="city">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inhabitants">Inhabitants<span style="color:red;">*</span></label>
                            <select class="form-control select2" name="inhabitantss[]" multiple="multiple" id="inhabitants">
                                @foreach ($resident as $res)
                                    <option value="{{ $res->id }}">{{ $res->firstName }} {{ $res->middleName }}
                                        {{ $res->lastName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inhabitantList">Household Inhabitants</label>
                            <table id="inhabit" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Civil Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm" id="removeInhabitant"><i
                                class="fas fa-trash"></i> Remove</button>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            var table = $('#inhabit').DataTable();

            $('#inhabit tbody').on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            $('#removeInhabitant').click(function() {
                table.row('.selected').remove().draw(false);
            });

            $('#inhabitants').on('select2:select', function(e) {
                var data = e.params.data;
                inhabitant(data.id);
            });

            function inhabitant(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/Household/Inhabitant/') }}" + id,
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
                                data[x].civilStatus,
                                '<button type="button" class="btn btn-danger btn-sm remove-inhabitant"><i class="fas fa-trash"></i></button>'
                            ]).draw();
                        }
                    }
                });
            }

            // Add event listener for removing selected inhabitant from table
            $('#inhabit').on('click', '.remove-inhabitant', function() {
                table.row($(this).closest('tr')).remove().draw(false);
            });
        });
    </script>
@stop
