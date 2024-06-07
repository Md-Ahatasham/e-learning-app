@extends('layouts.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-around body_padding_top">
                <div class="col-md-12">
                    <div class="row card add_new_button_design mr-0">
                        <div class="">
{{--                            @can('student-create')--}}
                                <a href="" class="btn btn-info btn-sm btn-round ml-auto add_button_to_right" data-toggle="modal" data-target="#modal-default">
                                    <em class="fa fa-plus"></em> {{'Assign Course To Teacher'}}</a> <br>
{{--                            @endcan--}}
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane table-responsive" id="activity">
                                    <table id="teacherTable" aria-describedby="teacherTable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Picture</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Courses</th>
                                            <th>Batches</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($data['teacherList']))
                                            @foreach ($data['teacherList'] as $teacher)
                                                <tr>
                                                    <td><img class="patient_image rounded-circle" alt="user_avatar" src="{{$teacher->profile_photo}}" /></td>
                                                    <td>{{ $teacher->first_name.' '. $teacher->last_name }}</td>
                                                    <td>{{ $teacher->email }}</td>
                                                    <td>
                                                        @if($teacher->courses->isNotEmpty())
                                                            @foreach($teacher->courses as $index => $course)
                                                                <a href="{{route('courses.enrolled',$course->id)}}">{{ $course->course_name }}</a>{{ $index < $teacher->courses->count() - 1 ? ',' : '' }}
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($teacher->batches->isNotEmpty())
                                                            @foreach($teacher->batches as $index => $batch)
                                                                <a href="{{route('courses.enrolled',$batch->id)}}">{{ $batch->batch_name }}</a>{{ $index < $teacher->batches->count() - 1 ? ',' : '' }}
                                                            @endforeach
                                                        @endif
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

            <!----Batch add modal ---------------------------------------------------->

            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header cat_modal_header">
                            <p class="modal-title">{{'Assign Course'}}</p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action="{{route('assign.courses')}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}

                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="row" id="unitTable">
                                            <div class="form-group">
                                                <label for="email">{{'Select Teacher'}}</label>
                                                <select name="user_id" class="form-control input_field" id="name">
                                                    @if(!empty($data['teacherList']))
                                                        @foreach($data['teacherList'] as $teacher)
                                                            <option value="{{$teacher->id}}">{{$teacher->first_name.' '. $teacher->last_name .'('.$teacher->email.')'}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="course">{{'Select Course'}}</label>
                                                <select name="course_id[]" class="select2 form-control input_field form-control-sm" id="name">
                                                    @if(!empty($data['courseList']))
                                                        @foreach($data['courseList'] as $course)
                                                            <option value="{{$course->id}}">{{$course->course_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="batch">{{'Select Batch'}}</label>
                                                <select name="batch_id[]" class="select2 form-control input_field form-control-sm" id="batch">
                                                    @if(!empty($data['batchList']))
                                                        @foreach($data['batchList'] as $batch)
                                                            <option value="{{$batch->id}}">{{$batch->batch_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
{{--                                        <a class="add_button btn-sm btn-default add_more_button form-control" title="Add field"><em class="fas fa-plus add_icon"></em> </a>--}}
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <div class="col-6 text-center">
                                        <span><a data-dismiss="modal" aria-label="Close" class="btn-sm btn btn-danger cancel-button text-left">Cancel&nbsp;<span class="glyphicons glyphicons-circle_minus"></span></a></span>
                                        <span><input type="submit" class="btn btn-sm btn-info text-right" value="Save"><span class="glyphicons glyphicons-circle_plus"></span></button></span>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
            {{-- end of add batch modal--}}
        </div>
        </div>

    </section>

@endsection