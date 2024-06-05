@extends('layouts.master')
@section('content')

    <section class="content">

        <div class="container-fluid">
            <div class="row justify-content-around body_padding_top">
                <div class="col-md-10">
                    <div class="row card add_new_button_design mr-0">
                        <div class="">
                            {{--                            @can('batch-create')--}}
                            <a href="{{route('courses.index')}}" class="btn btn-info btn-sm btn-round ml-auto add_button_to_right">
                                <em class="fa fa-arrow-left"></em> {{'Back to course'}}</a> <br>
                            {{--                            @endcan--}}
                        </div>
                    </div>
                    <div class="card">

{{--                        <input id="showContent" class="file-loading"  type="file" name="contents[]" multiple>--}}
                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="tab-content">
                                <div class="active tab-pane" id="activitys">
                                    <table id="location" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Content</th>
                                            <th>Title</th>
                                            <th>Sub Title</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($data['contentList']))
                                            @foreach($data['contentList'] as $list)
                                                <tr>
                                                    <td>
                                                        @if(pathinfo($list->content_path, PATHINFO_EXTENSION) == 'mp4')
                                                            <video width="350" height="160" controls>
                                                                <source src="{{ asset($list->content_path) }}" type="video/mp4">
                                                            </video>
                                                        @else
                                                            <iframe src="{{ asset($list->content_path) }}" type="application/pdf" width="350" height="160"></iframe>
                                                        @endif
                                                    </td>
                                                    <td>{{$list->content_title}}</td>
                                                    <td>{{$list->content_sub_title}}</td>
                                                    <td class="text-center">
                                                        <div class="row form-button-action">
                                                            <div class="col-6 text-right">
                                                                {{--                                                                @can('batch-edit')--}}
                                                                <button type="button" data-toggle="tooltip" title=""
                                                                        class="edit_batch btn  btn-info btn-xs "
                                                                        data-original-title="Edit Task"
                                                                        id="{{$list->id}}">
                                                                    <em class="fa fa-edit"></em>
                                                                </button>
                                                                @if(pathinfo($list->content_path, PATHINFO_EXTENSION) == 'pdf')
                                                                    <a href="{{ asset($list->content_path) }}" target="_blank"><em class="fa fa-eye"></em></a>
                                                                @endif
                                                                {{--                                                                @endcan--}}
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

    </section>

@endsection