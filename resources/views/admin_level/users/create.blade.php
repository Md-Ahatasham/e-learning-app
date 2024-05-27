@extends('layouts.master')
@section('content')


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action = "{{route('users.store')}}" method ="post" enctype="multipart/form-data"> {{csrf_field()}}

                <div class="row justify-content-around body_padding_top">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile" style="padding:.9rem;">
                                <div class="form-group">
                                    <label for="first_name">{{'User Photo'}}</label>
                                    <div class="">
                                        <img class="profile-user-img img-fluid img-circle" id="imgPreview" src="{{asset('dist/img/default_avatar.png')}}" alt="User picture">
                                    </div>
                                    <input name="user_photo" value="{{ old('user_photo') }}" id="profile_image" type="file" class="form-control-sm form-control" />
                                    @if ($errors->has('user_photo')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('user_photo') }}</p>
                                    @endif
                                </div>


                                <ul class="list-group list-group-unbordered">

                                    <li class="list-group-item"  style="border:0px;">
                                        <div class="form-group" style="margin-bottom:0rem">
                                            <label for="email">{{'Select Role'}}</label>
                                            {!! Form::select('role_id', $data['allRoles'],'', array('data-placeholder' => 'Select Role','class' => 'form-control-sm form-control','required'=>'required')) !!}
                                            @if ($errors->has('role_id')) <p class="help-block icon_color"><i
                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('role_id') }}</p>
                                            @endif
                                        </div>

                                    </li>

                                    <li class="list-group-item" style="border:0px;">

                                        <div class="form-group" style="margin-bottom:0rem">
                                            <label for="first_name" style="font-weight: normal;font-size:14px;">{{'First
                                                Name'}}</label>
                                            <input name="first_name" id="first_name" value="{{ old('first_name') }}" type="text" class="form-control-sm form-control">
                                            @if ($errors->has('first_name')) <p class="help-block icon_color"><i
                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('first_name') }}</p>
                                            @endif
                                        </div>

                                    </li>
                                    <li class="list-group-item" style="border:0px;" >
                                        <div class="form-group" style="margin-bottom:0rem">
                                            <label for="last_name" style="font-weight: normal;font-size:14px;">{{'Last
                                                Name'}}</label>
                                            <input name="last_name" id="last_name" value="{{ old('last_name') }}" type="text" class="form-control-sm form-control">
                                            @if ($errors->has('last_name')) <p class="help-block icon_color"><i
                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('last_name') }}</p>
                                            @endif
                                        </div>
                                    </li>
                                    <li class="list-group-item"  style="border:0px;">
                                        <div class="form-group" style="margin-bottom:0rem">
                                            <label for="email" style="font-weight: normal;font-size:14px;">{{'Email'}}</label>
                                            <input name="email" id="email" value="{{ old('email') }}" type="email" class="form-control-sm form-control">
                                            @if ($errors->has('email')) <p class="help-block icon_color"><i
                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </li>

                                    <li class="list-group-item"  style="border:0px;">
                                        <div class="form-group"  style="margin-bottom:0rem">
                                            <label for="password" style="font-weight: normal;font-size:14px;">{{'Password'}}</label>
                                            <input name="password" id="password" value="{{ old('password') }}" type="password" class="form-control-sm form-control">
                                            @if ($errors->has('password')) <p class="help-block icon_color"><i
                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('password') }}</p>
                                            @endif
                                        </div>
                                    </li>

                                    <li class="list-group-item"  style="border:0px;">
                                        <div class="form-group"  style="margin-bottom:0rem">
                                            <label for="experience" style="font-weight: normal;font-size:14px;">{{'Experience (number of years)'}}</label>
                                            <input name="experience" id="experience" value="{{ old('experience') }}" min="0" type="number" class="form-control-sm form-control">
                                            @if ($errors->has('experience')) <p class="help-block icon_color"><i
                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('experience') }}</p>
                                            @endif
                                        </div>
                                    </li>

                                    <li class="list-group-item"  style="border:0px;">
                                        <div class="form-group"  style="margin-bottom:0rem">
                                            <label for="speciality" style="font-weight: normal;font-size:14px;">{{'Speciality (example: teaching, good speaker)'}}</label>
                                            <input name="speciality" id="speciality" value="{{ old('speciality') }}" type="text" class="form-control-sm form-control">
                                            @if ($errors->has('speciality')) <p class="help-block icon_color"><i
                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('speciality') }}</p>
                                            @endif
                                        </div>
                                    </li>

                                </ul>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Educational Information</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- /.tab-pane -->
                                    <div class="active tab-pane" id="timeline">
                                        <!-- The timeline -->
                                        <div class="timeline timeline-inverse">

                                            <div>
                                                <i class="fas fa-envelope bg-primary"></i>

                                                <div class="timeline-item">
                                                    <div class="card card-widget">
                                                        <div class="card-header">
                                                            <div class="user-block">
                                                                <span class="username">{{'SSC Information'}}</span>
                                                            </div>

                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                            </div>

                                                        </div>

                                                        <div class="card-body" style="display: block;">

                                                            <div class="form-group row">
                                                                <div class="form-group col-md-8">
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label for="org_name" style="font-weight: normal;font-size:14px;">{{'Organization Name'}}</label>
                                                                            <input name="ssc_org_name" id="ssc_org_name" value="{{ old('ssc_org_name') }}" type="text" class="form-control-sm form-control">
                                                                            @if ($errors->has('ssc_org_name')) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('ssc_org_name') }}</p>
                                                                            @endif
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <label for="email">{{'Select Board'}}</label>
                                                                            {!! Form::select('ssc_board_name', $data['boards'],'', array('data-placeholder' => 'Select Board','class' => 'form-control-sm form-control')) !!}
                                                                            @if ($errors->has('ssc_board_name')) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('ssc_board_name') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-md-6" style="max-width: 45%">
                                                                            <label for="ssc_passing_year" style="font-weight: normal;font-size:14px;">{{'Passing Year'}}</label>
                                                                            <input name="ssc_passing_year" id="ssc_passing_year" value="{{ old("ssc_passing_year") }}" type="text" class="form-control-sm form-control">
                                                                            @if ($errors->has("ssc_passing_year")) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first("ssc_passing_year") }}</p>
                                                                            @endif
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <label for="gpa" style="font-weight: normal;font-size:14px;">{{'GPA'}}</label>
                                                                            <input name="ssc_gpa" id="ssc_gpa" value="{{ old("ssc_gpa") }}" type="text" class="form-control-sm form-control">
                                                                            @if ($errors->has("ssc_gpa")) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first("ssc_gpa") }}</p>
                                                                            @endif
                                                                        </div>

                                                                        <div class="col-md-3" style="margin-left: 5%;">

                                                                            <label for="email">{{'Select Degree'}}</label>
                                                                            {!! Form::select('ssc_degree_name', $data['degrees'],'', array('data-placeholder' => 'Select Degree','class' => 'form-control-sm form-control')) !!}
                                                                            @if ($errors->has('ssc_degree_name')) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('ssc_degree_name') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="form-group col-md-4">
                                                                    <label for="first_name">{{'Certificate'}}</label>
                                                                    <div class="">
                                                                        <img class="profile-user-img img-fluid img-circle" id="imgPreview" src="{{asset('dist/img/default_avatar.png')}}" alt="User picture">
                                                                    </div>
                                                                    <input name="ssc_certificate" value="{{ old('ssc_certificate') }}" id="profile_image" type="file" class="form-control-sm form-control" />
                                                                    @if ($errors->has('ssc_certificate')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('ssc_certificate') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-user bg-info"></i>

                                                <div class="timeline-item">
                                                    <div class="card card-widget">
                                                        <div class="card-header">
                                                            <div class="user-block">
                                                                <span class="username">{{'HSC Information'}}</span>
                                                            </div>

                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                            </div>

                                                        </div>

                                                        <div class="card-body" style="display: block;">

                                                            <div class="form-group row">
                                                                <div class="form-group col-md-8">
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label for="org_name" style="font-weight: normal;font-size:14px;">{{'Organization Name'}}</label>
                                                                            <input name="hsc_org_name" id="hsc_org_name" value="{{ old('hsc_org_name') }}" type="text" class="form-control-sm form-control">
                                                                            @if ($errors->has('hsc_org_name')) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('hsc_org_name') }}</p>
                                                                            @endif
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <label for="email">{{'Select Board'}}</label>
                                                                            {!! Form::select('hsc_board_name', $data['boards'],'', array('data-placeholder' => 'Select Board','class' => 'form-control-sm form-control')) !!}
                                                                            @if ($errors->has('hsc_board_name')) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('hsc_board_name') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-md-6" style="max-width: 45%">
                                                                            <label for="passing_year" style="font-weight: normal;font-size:14px;">{{'Passing Year'}}</label>
                                                                            <input name="hsc_passing_year" id="hsc_passing_yearhsc_" value="{{ old("hsc_passing_year") }}" type="text" class="form-control-sm form-control">
                                                                            @if ($errors->has("hsc_passing_year")) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first("hsc_passing_year") }}</p>
                                                                            @endif
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <label for="gpa" style="font-weight: normal;font-size:14px;">{{'GPA'}}</label>
                                                                            <input name="hsc_gpa" id="hsc_gpa" value="{{ old("hsc_gpa") }}" type="text" class="form-control-sm form-control">
                                                                            @if ($errors->has("hsc_gpa")) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first("hsc_gpa") }}</p>
                                                                            @endif
                                                                        </div>

                                                                        <div class="col-md-3" style="margin-left: 5%;">

                                                                            <label for="emahonors_il">{{'Select Degree'}}</label>
                                                                            {!! Form::select('hsc_degree_name', $data['degrees'],'', array('data-placeholder' => 'Select Degree','class' => 'form-control-sm form-control')) !!}
                                                                            @if ($errors->has('hsc_degree_name')) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('hsc_degree_name') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="form-group col-md-4">
                                                                    <label for="first_name">{{'Certificate'}}</label>
                                                                    <div class="">
                                                                        <img class="profile-user-img img-fluid img-circle" id="imgPreview" src="{{asset('dist/img/default_avatar.png')}}" alt="User picture">
                                                                    </div>
                                                                    <input name="hsc_certificate" value="{{ old('hsc_certificate') }}" id="hsc_certificate" type="file" class="form-control-sm form-control" />
                                                                    @if ($errors->has('hsc_certificate')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('hsc_certificate') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-comments bg-warning"></i>

                                                <div class="timeline-item">
                                                    <div class="card card-widget">
                                                        <div class="card-header">
                                                            <div class="user-block">
                                                                <span class="username">{{'Honors/Degree Information'}}</span>
                                                            </div>

                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                            </div>

                                                        </div>

                                                        <div class="card-body" style="display: block;">

                                                            <div class="form-group row">
                                                                <div class="form-group col-md-8">
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label for="org_name" style="font-weight: normal;font-size:14px;">{{'Organization Name'}}</label>
                                                                            <input name="honors_org_name" id="honors_org_name" value="{{ old('honors_org_name') }}" type="text" class="form-control-sm form-control">
                                                                            @if ($errors->has('honors_org_name')) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('honors_org_name') }}</p>
                                                                            @endif
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <label for="email">{{'Select Board'}}</label>
                                                                            {!! Form::select('honors_board_name', $data['boards'],'', array('data-placeholder' => 'Select Board','class' => 'form-control-sm form-control')) !!}
                                                                            @if ($errors->has('honors_board_name')) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('honors_board_name') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-md-6" style="max-width: 45%">
                                                                            <label for="passing_year" style="font-weight: normal;font-size:14px;">{{'Passing Year'}}</label>
                                                                            <input name="honors_passing_year" id="org_name" value="{{ old("honors_passing_year") }}" type="text" class="form-control-sm form-control">
                                                                            @if ($errors->has("honors_passing_year")) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first("honors_passing_year") }}</p>
                                                                            @endif
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <label for="gpa" style="font-weight: normal;font-size:14px;">{{'GPA'}}</label>
                                                                            <input name="honors_gpa" id="honors_masters_gpa" value="{{ old("honors_gpa") }}" type="text" class="form-control-sm form-control">
                                                                            @if ($errors->has("honors_gpa")) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first("honors_gpa") }}</p>
                                                                            @endif
                                                                        </div>

                                                                        <div class="col-md-3" style="margin-left: 5%;">

                                                                            <label for="email">{{'Select Degree'}}</label>
                                                                            {!! Form::select('honors_degree_name', $data['degrees'],'', array('data-placeholder' => 'Select Degree','class' => 'form-control-sm form-control')) !!}
                                                                            @if ($errors->has('honors_degree_name')) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('honors_degree_name') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="form-group col-md-4">
                                                                    <label for="first_name">{{'Certificate'}}</label>
                                                                    <div class="">
                                                                        <img class="profile-user-img img-fluid img-circle" id="imgPreview" src="{{asset('dist/img/default_avatar.png')}}" alt="User picture">
                                                                    </div>
                                                                    <input name="honors_certificate" value="{{ old('honors_certificate') }}" id="honors_certificate" type="file" class="form-control-sm form-control" />
                                                                    @if ($errors->has('honors_certificate')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('honors_certificate') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->

                                            <div>
                                                <i class="fas fa-camera bg-purple"></i>
                                                <div class="timeline-item">
                                                    <div class="card card-widget">
                                                        <div class="card-header">
                                                            <div class="user-block">
                                                                <span class="username">{{'Masters/MSC Information'}}</span>
                                                            </div>

                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                            </div>

                                                        </div>

                                                        <div class="card-body" style="display: block;">

                                                            <div class="form-group row">
                                                                <div class="form-group col-md-8">
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label for="org_name" style="font-weight: normal;font-size:14px;">{{'Organization Name'}}</label>
                                                                            <input name="masters_org_name" id="masters_org_name" value="{{ old('masters_org_name') }}" type="text" class="form-control-sm form-control">
                                                                            @if ($errors->has('masters_org_name')) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('masters_org_name') }}</p>
                                                                            @endif
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <label for="email">{{'Select Board'}}</label>
                                                                            {!! Form::select('masters_board_name', $data['boards'],'', array('data-placeholder' => 'Select Board','class' => 'form-control-sm form-control')) !!}
                                                                            @if ($errors->has('masters_board_name')) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('masters_board_name') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-md-6" style="max-width: 45%">
                                                                            <label for="passing_year" style="font-weight: normal;font-size:14px;">{{'Passing Year'}}</label>
                                                                            <input name="masters_passing_year" id="masters_passing_year" value="{{ old("masters_passing_year") }}" type="text" class="form-control-sm form-control">
                                                                            @if ($errors->has("masters_passing_year")) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first("masters_passing_year") }}</p>
                                                                            @endif
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <label for="gpa" style="font-weight: normal;font-size:14px;">{{'GPA'}}</label>
                                                                            <input name="masters_gpa" id="masters_gpa" value="{{ old("masters_gpa") }}" type="text" class="form-control-sm form-control">
                                                                            @if ($errors->has("masters_gpa")) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first("masters_gpa") }}</p>
                                                                            @endif
                                                                        </div>

                                                                        <div class="col-md-3" style="margin-left: 5%;">

                                                                            <label for="email">{{'Select Degree'}}</label>
                                                                            {!! Form::select('masters_degree_name', $data['degrees'],'', array('data-placeholder' => 'Select Exam','class' => 'form-control-sm form-control')) !!}
                                                                            @if ($errors->has('masters_degree_name')) <p class="help-block icon_color"><i
                                                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('masters_degree_name') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="form-group col-md-4">
                                                                    <label for="first_name">{{'Certificate'}}</label>
                                                                    <div class="">
                                                                        <img class="profile-user-img img-fluid img-circle" id="imgPreview" src="{{asset('dist/img/default_avatar.png')}}" alt="User picture">
                                                                    </div>
                                                                    <input name="masters_certificate" value="{{ old('masters_certificate') }}" id="masters_certificate" type="file" class="form-control-sm form-control" />
                                                                    @if ($errors->has('masters_certificate')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('masters_certificate') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->

                                </div>
                                <div class="col-6 text-center">
                                    <span><a data-dismiss="modal" aria-label="Close" class="btn btn-danger cancel-button btn-sm text-left">Cancel&nbsp;<span class="glyphicons glyphicons-circle_minus"></span></a></span>
                                    <span><button type="submit" name="submit" class="btn btn-info btn-sm text-right">Save</button></span>
                                </div>

                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                </div>

            </form>
        </div>
    </section>




@endsection
