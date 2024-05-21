@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane table-responsive" id="activit">
                                <table id="dischargepatienttable" aria-describedby="patienttabled" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Picture</th>
                                            <th>First Name</th>
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