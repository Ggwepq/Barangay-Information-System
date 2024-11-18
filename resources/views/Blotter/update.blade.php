@extends('dashboard')

@section('title', 'Blotter Records')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Blotter</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Blotter</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    @if ($errors->any())
        <script type="text/javascript">
            toastr.error(' <?php echo implode('', $errors->all(':message')); ?>', "There's something wrong!")
        </script>
    @endif
    @if (session('error'))
        <script type="text/javascript">
            toastr.error(' <?php echo session('error'); ?>', "There's something wrong!")
        </script>
    @endif
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Update Blotter</h3>
            <div class="box-tools pull-right">
                <p class="pull-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to be filled
                    out.
                </p>
            </div>
        </div>
        <div class="box-body">
            <form action="{{ url('/admin/Blotter/Update/' . $post->id) }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-section-header">
                            Blotter Information
                        </div>
                        <div class="form-group">
                            <label>Date of Filing<span style="color:red;">*</span></label>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' name="created_at" placeholder="YYYY-MM-DD" id="date"
                                    value="{{ $post->created_at }}" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label><span style="color:red;">Case No.*</span></label>
                                    <input type="number" class="form-control" maxlength="10" value="{{ $post->id }}"
                                        placeholder="Case No." name="id">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Status<span style="color:Red;">*</span></label>
                                    <select class="form-control" name="status">
                                        <option value="1" @if ($post->status == 1) selected @endif>Pending
                                        </option>
                                        <option value="2" @if ($post->status == 2) selected @endif>Ongoing
                                        </option>
                                        <option value="3" @if ($post->status == 3) selected @endif>Resolved
                                            Issue</option>
                                        <option value="4" @if ($post->status == 4) selected @endif>File to
                                            Action</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Complainant<span style="color:Red;">*</span></label>
                            <select class="form-control select2" name="complainant">
                                @foreach ($resident as $res)
                                    <option value="{{ $res->id }}" @if ($post->complainant == $res->id) selected @endif>
                                        {{ $res->firstName }} {{ $res->middleName }} {{ $res->lastName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Complained Resident<span style="color:Red;">*</span></label>
                            <select class="form-control select2" name="complainedResident">
                                @foreach ($resident2 as $res2)
                                    <option value="{{ $res2->id }}" @if ($post->complainedResident == $res2->id) selected @endif>
                                        {{ $res2->firstName }} {{ $res2->middleName }} {{ $res2->lastName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Officer-in-charge<span style="color:Red;">*</span></label>
                            <select class="form-control select2" name="officerCharge">
                                @foreach ($officer as $o)
                                    <option
                                        value="{{ $o->Resident->firstName }} {{ $o->Resident->middleName }} {{ $o->Resident->lastName }}">
                                        {{ $o->Resident->firstName }} {{ $o->Resident->middleName }}
                                        {{ $o->Resident->lastName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="comment">Description<span style="color:Red;">*</span></label>
                        <textarea class="form-control" rows="5" maxlength="150" name="description" id="comment">{{ $post->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="pull-right">
                            <button class="btn btn-primary" style="margin-right:20px; margin-top:20px;">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal for non-registered residents --}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Resident not registered in the Barangay</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="{{ url('/admin/Resident/NotResident/Store') }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <!-- Form fields for resident registration -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#pic').attr('src', e.target.result).width(300);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {
            $('#date').inputmask('9999-99-99');
        });

        $('#date').on('change', function() {
            const today = new Date();
            const date = new Date($('#date').val());
            if (date >= today) {
                alert('Invalid Date');
            }
        });
    </script>
@stop
