@extends('layouts.master')
@section('content')

    <section class="content">

        <div class="container-fluid">

            <div class="row justify-content-around body_padding_top">
                <div class="col-md-10">
                    <div class="row card mr-0" style="box-shadow: 0 0 0 0">
                        <div class="">
                             @can('course-create')
                                <a href="" class="btn btn-info btn-sm btn-round ml-auto add_button_to_right"
                                   data-toggle="modal" data-target="#modal-default">{{'Add New Course'}}</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activitys">

                                   @if(Auth::user()->role_id !== 1)
                                       @include('backend.Courses.teacherView')
                                    @else
                                        @include('backend.Courses.adminView')
                                    @endif

                                </div>
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
                        <p class="modal-title">Add New Course</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{route('courses.store')}}" method="post"
                              enctype="multipart/form-data"> {{csrf_field()}}

                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="row" id="unitTable">
                                        <div class="form-group">
                                            <label for="">Course Name</label>
                                            <input required="required" placeholder="Enter Course Name"
                                                   class="form-control-sm form-control" id="" type="text"
                                                   name="course_name">
                                        </div>
                                    </div>
                                    {{--                                    <a class="add_button btn-sm btn-default add_more_button form-control" title="Add field"><em class="fas fa-plus add_icon"></em> </a>--}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="row" id="unitTable">
                                        <div class="form-group">
                                            <label for="">Course Details</label>
                                            <textarea required="required" rows="5" cols="5"
                                                      placeholder="Enter Course Details"
                                                      class="form-control-sm form-control" id="" type="text"
                                                      name="course_details"></textarea>

{{--                                            <textarea id="editor1" name="editor1" rows="10" cols="80">--}}
{{--                                            This is my textarea to be replaced with CKEditor.--}}
{{--                                            </textarea>--}}
                                        </div>
                                    </div>
                                    {{--                                    <a class="add_button btn-sm btn-default add_more_button form-control" title="Add field"><em class="fas fa-plus add_icon"></em> </a>--}}
                                </div>
                            </div>

                            <div class="modal-footer justify-content-center">
                                <div class="col-6 text-center">
                                    <span><a data-dismiss="modal" aria-label="Close"
                                             class="btn-sm btn btn-danger cancel-button text-left">Cancel&nbsp;<span
                                                    class="glyphicons glyphicons-circle_minus"></span></a></span>
                                    <span><input type="submit" class="btn btn-sm btn-info text-right" value="Save"><span
                                                class="glyphicons glyphicons-circle_plus"></span></span>
                                </div>
                            </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- end of add batch modal--}}

        @include('backend.courses.edit')
        </div>


    </section>

@endsection