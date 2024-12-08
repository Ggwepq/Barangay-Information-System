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
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset($res->image) }}"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $res->firstName }} {{ $res->lastName }}</h3>


                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Birthdate</b> <a class="float-right">{{ $res->birthdate }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Citizenship</b> <a class="float-right">{{ $res->citizenship }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Religion</b> <a
                                        class="float-right">{{ $res->religion ? $res->religion : 'None' }}</a>
                                </li>
                                <a href="{{ url('/user/profile') }}" class="btn btn-primary btn-block"><b>View
                                        Profile</b></a>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <i class="fas fa-bullhorn"></i>
                            Announcements
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-pane" id="settings">
                                @if (count($announcements) != 0)
                                    @foreach ($announcements as $announce)
                                        <div class="callout callout-info">
                                            <h5>{{ $announce->title }}</h5>

                                            <div class="announcement-content" id="announce-{{ $announce->id }}">
                                                {!! $announce->content !!}
                                            </div>
                                            <button class="btn btn-link toggle-content"
                                                data-target="#announce-{{ $announce->id }}">
                                                Read More
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('css')
    <style>
        .announcement-content {
            max-height: 1px;
            /* Limit the visible height */
            overflow: hidden;
            position: relative;
        }

        .announcement-content.expanded {
            max-height: none;
            /* Remove height limit when expanded */
        }
    </style>
@endsection

@section('js')

    <script>
        $(document).on('click', '.toggle-content', function() {
            const target = $(this).data('target');
            const content = $(target);
            content.toggleClass('expanded');

            if (content.hasClass('expanded')) {
                $(this).text('Read Less');
            } else {
                $(this).text('Read More');
            }
        });
    </script>
@endsection
