@extends('layouts.master')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
                <div class="row mt-5">
                    <div class="col-md-10 offset-1">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="routine" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{'Course Name'}}</th>
                                            <th>{{'Batch Name'}}</th>
                                            <th>{{'Start Time'}}</th>
                                            <th>{{'End Time'}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($data['routineList']))
                                            @foreach($data['routineList']->routines as $routine)
                                                <tr>
                                                    <td>{{$routine->course->course_name}}</td>
                                                    <td>{{$routine->batch->batch_name}}</td>
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
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
@endsection
