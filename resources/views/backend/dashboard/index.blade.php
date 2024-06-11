@extends('layouts.master')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            @if(Auth::user()->role_id === 2)
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">{{'Assigned Course List'}}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            @php
                                 $previousCourseId = null;
                            @endphp
                            @if(!empty($data['dashboardInfo']))
                                @foreach($data['dashboardInfo']->routines as $routine)
                                    @if ($routine->course->id === $previousCourseId)
                                        @break
                                    @endif
                                    <div class="info-box mb-3 m-4 bg-gradient-cyan">
                                        <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">{{$routine->course->course_name}}</span>
                                        </div>
                                        <div class="info-box-content text-right">
                                            <span class="info-box-text mb-3"><a href="" class="btn btn-secondary btn-xs"><em class="fa fa-eye"></em> {{' Content'}}</a></span>
                                            <span class="info-box-text"><a href="{{route('contents.getContentById',$routine->course->id)}}" class="btn btn-secondary btn-xs"><em class="fa fa-plus-circle"></em> {{' Content'}}</a></span>
                                        </div>

                                    </div>
                                        @php
                                            $previousCourseId = $routine->course->id;
                                        @endphp
                                @endforeach
                            @endif

                        </div>

                    </div>

                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">{{'Routines for last 7 days'}}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($data['dashboardInfo']))
                                        @foreach($data['dashboardInfo']->routines as $routine)
                                        <tr>
                                            <td>{{$routine->course->course_name}}</td>
                                            <td>{{$routine->start_time}}</td>
                                            <td>{{$routine->end_time}}</td>
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
            @else
                <div class="row" style="margin-top:20%">
                    <div class="col-12 text-center">
                        <h3>{{'Under Construction'}}</h3>
                    </div>
                </div>

            @endif
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
@endsection
