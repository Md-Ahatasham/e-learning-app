@extends('layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
                <div class="row justify-content-around body_padding_top">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile" style="padding:.9rem;">
                                <form action = "{{!empty($data['routine']->id) ? route('routines.update',$data['routine']->id) : route('routines.store')}}" method ="post">
                                    {{csrf_field()}}
                                    @if(!empty($data['routine']->id))
                                        @method('PUT')
                                    @endif

                                <ul class="list-group list-group-unbordered">

                                    <li class="list-group-item"  style="border:0px;">
                                        <div class="form-group" style="margin-bottom:0rem">
                                            <label for="email">{{'Select Course'}}</label>
                                            <select name="course_id" class="select2 form-control input_field" id="course">
                                                @if(!empty($data['courseList']))
                                                    @foreach($data['courseList'] as $course)
                                                        <option value="{{$course->id}}" @if(!empty($data['routine']) && ($data['routine']->course_id==$course->id)) {{ 'selected' }} @endif>{{$course->course_name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
{{--                                            {!! Form::select('course_id', $data['courseList'],'', array('data-placeholder' => 'Select Course','class' => 'form-control-sm form-control','required'=>'required')) !!}--}}
                                            @if ($errors->has('course_id')) <p class="help-block icon_color"><i
                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('course_id') }}</p>
                                            @endif
                                        </div>

                                    </li>

                                    <li class="list-group-item"  style="border:0px;">
                                        <div class="form-group" style="margin-bottom:0rem">
                                            <label for="email">{{'Select Batch'}}</label>
                                            <select name="batch_id" class="select2 form-control input_field" id="batch">
                                                @if(!empty($data['batchList']))
                                                    @foreach($data['batchList'] as $batch)
{{--                                                        <option value="{{$roles->id}}" @if(!empty($data['routine']) && ($data['routine']->batch_id==$batch->id)) {{ 'selected' }} @endif>{{$roles->name}}</option>--}}
                                                        <option value="{{$batch->id}}" @if(!empty($data['routine']) && ($data['routine']->batch_id==$batch->id)) {{ 'selected' }} @endif>{{$batch->batch_name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
{{--                                            {!! Form::select('batch_id', $data['batchList'],'', array('data-placeholder' => 'Select Batch','class' => 'form-control-sm form-control','required'=>'required')) !!}--}}
                                            @if ($errors->has('batch_id')) <p class="help-block icon_color"><i
                                                        class="fa fa-times-circle-o"></i>{{ $errors->first('batch_id') }}</p>
                                            @endif
                                        </div>

                                    </li>
                                    <li class="list-group-item" style="border:0px;" >
                                        <div class="form-group" style="margin-bottom:0rem">
                                            <label for="id_start_datetime">{{'Start Time'}}</label>
                                            <div class="input-group date" id="startDate">
                                                <input type="text" name="start_time" value="{{ $data['routine']->start_time ?? old('start_time') }}" class="form-control" required/>
                                                <div class="input-group-addon input-group-append">
                                                    <div class="input-group-text">
                                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                @if ($errors->has('start_time')) <p class="help-block icon_color"><i
                                                            class="fa fa-times-circle-o"></i>{{ $errors->first('start_time') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item" style="border:0px;" >
                                        <div class="form-group" style="margin-bottom:0rem">
                                            <label for="id_start_datetime">{{'End Time'}}</label>
                                            <div class="input-group date" id="endDate">
                                                <input type="text" name="end_time" value="{{ $data['routine']->end_time ?? old('end_time') }}" class="form-control" required/>
                                                <div class="input-group-addon input-group-append">
                                                    <div class="input-group-text">
                                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                @if ($errors->has('end_time')) <p class="help-block icon_color"><i
                                                            class="fa fa-times-circle-o"></i>{{ $errors->first('end_time') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                @can('routine-create')
                                    <div class="col-6 text-center">
                                        <span><button type="submit" name="submit" class="btn btn-info btn-smtext-right">Save</button></span>
                                    </div>
                                @endcan
                                </form>
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
                                    <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">{{'Routine List'}}</a></li>
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
                                                                <span class="username">{{'Routine Information'}}</span>
                                                            </div>

                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                            </div>

                                                        </div>

                                                        <div class="card-body" style="display: block;">

                                                            <div class="tab-content">
                                                                <div class="active tab-pane table-responsive" id="activity">
                                                                    <table id="routine" aria-describedby="teacherTable" class="table table-bordered table-striped">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Course</th>
                                                                            <th>Batch</th>
                                                                            <th>Start Time</th>
                                                                            <th>End Time</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @if(!empty($data['routineList']))
                                                                            @foreach ($data['routineList'] as $routine)
                                                                                <tr>
                                                                                    <td>{{$routine->id}}</td>
                                                                                    <td>{{$routine->course->course_name}}</td>
                                                                                    <td>{{$routine->batch->batch_name}}</td>
                                                                                    <td>
                                                                                        {{$routine->start_time}}
                                                                                    </td>
                                                                                    <td>{{$routine->end_time}}</td>
                                                                                    <td class="text-center">
                                                                                        <div class="row form-button-action">

                                                                                            <div class="col-6 text-right">
                                                                                                @can('routine-edit')
                                                                                                    <a href="{{route('routines.edit',$routine->id)}}" class="edit_user btn btn-primary btn-xs" id="{{$routine->id}}"><em class="fa fa-edit"></em></a>
                                                                                                @endcan
                                                                                            </div>

                                                                                            <div class="col-6 text-left">
                                                                                                @can('routine-delete')
                                                                                                    <form action="{{ route('routines.destroy',$routine->id) }}" method="post">
                                                                                                        @csrf
                                                                                                        @method('DELETE')
                                                                                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete ?')"><em class='fas fa-trash-alt'></em></button>
                                                                                                    </form>
                                                                                                @endcan
                                                                                            </div>

                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        @endif

                                                                        </tbody>
                                                                    </table>
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

                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                </div>
        </div>
    </section>




@endsection
