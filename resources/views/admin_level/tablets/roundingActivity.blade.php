@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row" style="margin-right:0px;">
            <div class="col-md-12">
                <div class="card remove-card-border">
                    <div class="card-body">
                        <div class="tab-content">
                            <h4 class="general-title">Tablets</h4>
                            <div class="active tab-pane" id="activity">
                                <div class="row mx-auto slider" style="max-width:97%;">
                                    @if(isset($data['rounder_list']) && !empty($data['rounder_list']))
                                    @foreach($data['rounder_list'] as $key=>$list)
                                    <div class="col-md-12 rounder-activity @if($key==0) first_rounder @endif" id="{{$list->id}}">
                                        <div class="info-box mb-3 ml-2 mr-1 " id="{{$list->id.'_'.'card'}}">
                                            <span class="info-box-number assignee_count">Current User: {{$list->first_name.' '.$list->last_name}}</span>
                                            <span class="info-box-number"># of assigned patients: {{sizeof($list['patient'])}}</span>
                                            <span class="info-box-number assignee_count">Time since last sync: 60 Min</span>
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

        <div class="card remove-card-border rounder-activity-log">
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <h4 class="general-title">Tablet Details</h4>
                        <table id="rounder-activity" aria-describedby="rounder-activity" class="rounderActivityLogTable table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Event</th>
                                    <th class="text-center">User</th>
                                </tr>
                            </thead>
                            <tbody>
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
</div>
@endsection