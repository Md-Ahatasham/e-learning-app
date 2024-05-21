@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-12">
                <div class="row card add_new_button_design mr-0">
                    <div class="">
                        @can('patient-create')
                        <a href="{{ route('patients.create') }}" class="btn btn-info btn-round ml-auto btn-md add_button_to_right">
                            <em class="fa fa-plus"></em> &nbsp; Add New Patient</a> <br>
                        @endcan
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane table-responsive" id="activity">
                                <table id="patienttable" aria-describedby="patienttable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Picture</th>
                                            <th>First Name</th>
                                            <th>Preferred First Name</th>
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
            </div>
        </div>
    </div>

</section>

@endsection