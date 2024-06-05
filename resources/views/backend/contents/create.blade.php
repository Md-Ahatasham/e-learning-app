@extends('layouts.master')
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-around body_padding_top">
                <div class="col-md-12">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="container my-4">

                        <form method="post" action="{{route('contents.store')}}" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="row" style="margin-right:-6%;">
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-bottom:0rem">
                                        <label for="content_title" style="font-weight: normal;font-size:14px;">{{'Content Title'}}</label>
                                        <input name="content_title" id="content_title" value="{{ old('content_title') }}" type="text" class="form-control-sm form-control">
                                        @if ($errors->has('content_title')) <p class="help-block icon_color"><i
                                                    class="fa fa-times-circle-o"></i>{{ $errors->first('content_title') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group" style="margin-bottom:0rem">
                                        <input type="hidden" name="course_id" value="{{$data['courseId']}}" />
                                        <label for="content_sub_title" style="font-weight: normal;font-size:14px;">{{'Content Sub Title'}}</label>
                                        <input name="content_sub_title" id="content_sub_title" value="{{ old('content_sub_title') }}" type="text" class="form-control-sm form-control">
                                        @if ($errors->has('content_sub_title')) <p class="help-block icon_color"><i
                                                    class="fa fa-times-circle-o"></i>{{ $errors->first('content_sub_title') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="file-loading">
                                <input id="content" class="file-loading"  type="file" name="contents[]" multiple>
                            </div>
                            <div class="row" style="margin-left:50%;margin-top:1%;">
                                <button type="submit"  class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-info ml-1">Reset</button>
                            </div>
                        </form>

                    </div>

                    </div>
                </div>

            </div>

    </section>


@endsection