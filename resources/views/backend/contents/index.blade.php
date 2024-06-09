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

                        <div class="card-body">
                            <div class="tab-content">

                                <div class="active tab-pane" id="timeline">

                                    <div class="timeline timeline-inverse">

                                        @if(!empty($data['contentList']))
                                            @foreach($data['contentList'] as $list)

                                        <div>
                                            <i class="fas fa-comments bg-warning"></i>
                                            <div class="timeline-item">
                                                <span class="time"> </span>
                                                <h3 class="timeline-header">{{$list->content_title}}</h3>
                                                <div class="timeline-body">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            {{$list->content_sub_title}}
                                                        </div>
                                                        <div class="col-md-3 text-right">
                                                            @if(pathinfo($list->content_path, PATHINFO_EXTENSION) == 'mp4')
                                                                <video width="90" height="60" controls>
                                                                    <source src="{{ asset($list->content_path) }}" type="video/mp4">
                                                                </video>
                                                            @elseif(pathinfo($list->content_path, PATHINFO_EXTENSION) == 'pdf')
                                                                    <a href="{{ asset($list->content_path) }}" target="_blank">
                                                                        <iframe src="{{ asset($list->content_path) }}" type="application/pdf" width="90" height="60"></iframe>
                                                                    </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            @endforeach
                                        @endif


                                    </div>
                                </div>

                            </div>

                        </div>


                </div>
            </div>
        </div>
        </div>

    </section>

@endsection