@extends('adminlte::page')

@section('title', 'Officers')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Officer Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                    {{-- Updated home link --}}
                    <li class="breadcrumb-item active">Officers</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')

    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success!');
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error('{{ session('error') }}', "There's something wrong!");
        </script>
    @endif


    <div class="card card-primary"> {{-- Updated box to card --}}
        <div class="card-header"> {{-- Updated box-header to card-header --}}
            <h3 class="card-title">Officer Management</h3>
            <div class="card-tools"> {{-- Updated box-tools to card-tools --}}
                <a href="{{ url('/admin/Officer/Create') }}" class="btn btn-xs btn-success">New Officer</a>
                {{-- Updated route URL --}}
            </div>
        </div>
        <div class="card-body"> {{-- Updated box-body to card-body --}}
            <table id="example" class="table table-bordered table-hover"> {{-- Updated table classes --}}
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $posts)
                        <tr>
                            <td>{{ $posts->position }}</td>
                            <td>{{ $posts->Resident->firstName }} {{ $posts->Resident->middleName }}
                                {{ $posts->Resident->lastName }}</td>
                            <td>
                                @if ($posts->Resident->gender == 1)
                                    Male
                                @else
                                    Female
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/admin/Officer/Reactivate/' . $posts->id) }}" onclick="return reacForm()"
                                    class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                    title="Reactivate record"> {{-- Updated route URL and removed inline onclick --}}
                                    <i class="fa fa-recycle"></i>
                                </a>
                                <a href="{{ url('/admin/Officer/Remove/' . $posts->id) }}" onclick="return deleteForm()"
                                    class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                    title="Delete record"> {{-- Updated route URL and removed inline onclick --}}
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group pull-right"> {{-- Consider using a more modern approach for alignment --}}
                <div class="custom-control custom-checkbox"> {{-- Updated checkbox styling --}}
                    <input class="custom-control-input" type="checkbox" id="showDeactivated"
                        onclick="document.location='{{ url('/admin/Officer') }}';"> {{-- Updated route URL --}}
                    <label for="showDeactivated" class="custom-control-label">Show active records</label>
                </div>
            </div>

        </div>
    </div>

@stop

@section('js') {{-- Updated script section to js --}}
    <script>
        function reacForm() {
            return confirm("Are you sure you want to reactivate this record?"); // Simplified confirmation
        }

        function deleteForm() {
            return confirm("Are you sure you want to delete this record?"); // Simplified confirmation
        }
    </script>
@stop
