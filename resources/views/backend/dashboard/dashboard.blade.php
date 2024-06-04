@extends('layouts.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header pl-0">
                        <h3 class="card-title top_headline">Dashboard</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="tab-content">
                                <h4 class="general-title">Currently Routing</h4>
                                <div class="active tab-pane" id="activity">
                                    <div class="row mx-auto">
                                        @for($i=0;$i<6;$i++)
                                            <div class="info-box mb-3 ml-2 mr-1">
                                                <div class="info-box-content">
                                                    <span class="info-box-number stuff_name">Sally Smith</span>
                                                    <span class="info-box-number tablet_name">Tablet #30</span>
                                                </div>
                                                <span class="info-box-icon"><button
                                                            class="btn btn-info btn-xs">View</button></span>
                                                <span class="info-box-number assignee_count">5 patient assigned</span>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <table id="dashboardPatientTable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Picture</th>
                                            <th>First Name</th>
                                            <th>Preffered Name</th>
                                            <th>Last Name</th>
                                            <th>Gender</th>
                                            <th>Unit</th>
                                            <th>Room</th>
                                            <th>Bed</th>
                                            <th>Admission Date</th>
                                            <th>Rounding Interval</th>
                                            <th>Precautions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('backend.dashboard.recentAdmitted')
                    @include('backend.dashboard.recentDischarged')

                </div>
            </div>
        </div>
    </section>
    </div>
@endsection