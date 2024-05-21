@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class=" p-3 mb-3">
                    <div class="row invoice-info">
                        <div class="col-sm-1 invoice-col">
                            <a href="{{route('patients.index')}}"><em class="fas fa-less-than font-size"></em> Patients</a>
                        </div>
                        <div class="col-sm-1 invoice-col">
                            <div class="">
                                <img class="profile-user-img img-fluid img-circle" id="imgPreview" src="@if(!empty($data['patient']['patient_picture'])) {{$data['patient']['patient_picture']}} @else {{asset('dist/img/default_avatar.png')}} @endif" alt="patient picture">
                            </div>
                        </div>
                        <div class="col-sm-3 invoice-col pl-4 patient-font-size">
                            {{$data['patient']['first_name'].' '.$data['patient']['preferred_name'].' '.$data['patient']['last_name']}}
                            <address>
                                <strong>@if($data['patient']['status'] == 1) {{'Admitted'}} @elseif($data['patient']['status'] == 0){{'Discharged'}} @else {{"Queue"}} @endif</strong><br>
                                <span>Discharge Date: {{$data['patient']['status'] == 0 ? $data['patient']['updated_at']->format('m-d-Y'): 'N/A' }}</span><br>
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <!--<h5 class="text-center">Rounding Interval: {{$data['patient']['interval'].' '."Min"}}</h5>-->
                            <!--<div class="card">
                                @if(isset($data['patient']['userAsRounder']) && !empty($data['patient']['userAsRounder']))
                                <div class="card-body">
                                    <span class="mr-1"> Currently Rounding</span>
                                    <span class="mr-1 ml-4"><b> {{$data['patient']['userAsRounder']['first_name'].' '.$data['patient']['userAsRounder']['last_name']}}</b></span>
                                    <span class="view-button"><a href="/rounders/<?= $data['patient']['userAsRounder']['id']; ?>"><button class="btn btn-sm btn-info pull-right">View</button></a></span>
                                </div>
                                @endif
                            </div>-->
                        </div>
                        <div class="col-sm-3 text-right invoice-col">
                            @can('discharge-edit')
                            <a href="{{$data['patient']['status'] == 1 ? route('patients.dischargePatient',$data['patient']['id']) : ''}}" onclick="checkDischarge(event)" class="btn btn-warning btn-md color-white">{{($data['patient']['status'] == 1 || $data['patient']['status'] == 2) ? 'Discharge Patient' : 'Already Discharged' }}</a>
                            @endcan
                        </div>
                    </div>
                    <div class="row patient-tab">
                        <div class="col-md-8 col-sm-8 offset-md-2 offset-sm-2">
                            <div class="card tab">
                                <div class="card-body patient">

                                    <div class="card-header patient-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item mr-5 tab-button text-center"><a class="nav-link active" href="#activity" data-toggle="tab">Patient Information</a></li>
                                            <li class="nav-item ml-5 tab-button text-center"><a class="nav-link rounding-history" id="{{$data['patient']['id']}}" href="#timeline" data-toggle="tab">Rounding History</a></li>
                                            <li class="nav-item ml-5 tab-button text-center"><a class="nav-link activity_history" id="{{$data['patient']['id']}}" href="#settings" data-toggle="tab">Patient Stay Details</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-11 offset-md-1 mt-2">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="row card">
                                    <div class="col-12 table-responsive">
                                        <table class="table" aria-describedby="table">
                                            <thead>
                                                <tr>
                                                    <th>General Information</th>
                                                    @can('patient-edit')
                                                    <th class="text-right"><a href="{{route('patients.edit',$data['patient']['id'])}}" class="btn btn-sm btn-info table-button">Update</a></th>
                                                    @endcan
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>First Name</td>
                                                    <td class="text-right">{{$data['patient']['first_name']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Preferred Name</td>
                                                    <td class="text-right">{{$data['patient']['preferred_name']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Last Name</td>
                                                    <td class="text-right">{{$data['patient']['last_name']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Date of Birth</td>
                                                    <td class="text-right">{{date("j F, Y, h:i A", strtotime($data['patient']['dob']))}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Gender</td>
                                                    <td class="text-right">
                                                        <?php
                                                        if ($data['patient']['gender'] == 1) {
                                                            echo 'Male';
                                                        } else if ($data['patient']['gender'] == 2) {
                                                            echo 'Female';
                                                        } else {
                                                            echo 'TransGender';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Unit</td>
                                                    <td class="text-right">{{$data['patient']['units']['name']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Room</td>
                                                    <td class="text-right">{{$data['patient']['rooms']['room_no']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Bed</td>
                                                    <td class="text-right">{{$data['patient']['beds']['bed_no']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Admission Date</td>
                                                    <td class="text-right">{{date("j F, Y", strtotime($data['patient']['admission_date']))}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Admission Time</td>
                                                    <td class="text-right">@if(!empty($data['patient']['admission_time'])) {{$data['patient']['admission_time']}} @else {{'N/A'}} @endif</td>
                                                </tr>
                                                <tr>
                                                    <td>Admission Staff</td>
                                                    <td class="text-right">{{$data['patient']['userAsEntryBy']['first_name'].' '.$data['patient']['userAsEntryBy']['last_name']}} </td>
                                                </tr>
                                                <tr>
                                                    <td>Unique Stay Id</td>
                                                    <td class="text-right">@if(!empty($data['patient']['unique_stay_id'])) {{$data['patient']['unique_stay_id']}} @else {{'N/A'}} @endif</td>
                                                </tr>
                                                <tr>
                                                    <td>Rounding Interval</td>
                                                    <td class="text-right">{{$data['patient']['interval'].' '."Min"}} </td>
                                                </tr>
                                                <tr>
                                                    <td>Last sync time</td>
                                                    <td class="text-right">{{'N/A'}} </td>
                                                </tr>
                                                <tr>
                                                    <td>Last Rounder</td>
                                                    <td class="text-right">
                                                        <?php
                                                        if (isset($data['patient']['userAsRounder']) && !empty($data['patient']['userAsRounder'])) : ?>
                                                            <a href="/rounders/<?= $data['patient']['userAsRounder']['id']; ?>"><?= $data['patient']['userAsRounder']['first_name'] . ' ' . $data['patient']['userAsRounder']['last_name']; ?></a>
                                                        <?php
                                                        endif
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Last Tablet Number</td>
                                                    <td class="text-right">@if(isset($data['patient']['userAsRounder']) && !empty($data['patient']['userAsRounder'])) {{$data['patient']['rounderInfo']['assign_tab']}} @endif</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row card">
                                    <div class="col-md-12">
                                        <div class="card-header p-2">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Patient Notes</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="activity">
                                                    <div class="post">
                                                        <p>
                                                            {{$data['patient']['admission_notes']}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row card">
                                    <div class="col-md-12 mb-3">
                                        <div class="row mt-2">
                                            <div class="col-12">
                                                <h4>
                                                    Precautions
                                                    @can('precaution-edit')
                                                    <div class="float-right mr-5"><a href="{{route('patientPrecautions.edit',$data['patient']['id'])}}" class="btn btn-info btn-sm medical-button">Update</a></div>
                                                    @endcan
                                                </h4>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-9">
                                                <div class="row">
                                                    @foreach($data['patient']['preCaution'] as $precaution)
                                                    <div class="col-sm-3 mb-1">
                                                        <div class="btn btn-xs text-left precaution-text checkInput" style="color:white;background:{{$precaution['precaution']['color_code']}}" id="1">{{$precaution['precaution']['abbreviation']}}</div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="timeline">
                                <div class="row">
                                    <h5>Rounding History</h5>
                                </div>
                                <div class="row card">
                                    <div class="col-12 table-responsive">
                                        <table class="table" id="rounding_history_table" aria-describedby="rounding_history_table">
                                            <thead>
                                                <tr>
                                                    <th>Time</th>
                                                    <th>Rounder</th>
                                                    <th>Tablet</th>
                                                    <th>Location</th>
                                                    <th>Behavior</th>
                                                    <th>Affect</th>
                                                    <th>Transfer To</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="settings">
                                <div class="row">
                                    <h5>Rounding History</h5>
                                </div>
                                <div class="row card">
                                    <div class="col-12 table-responsive">
                                        <table class="table" id="activity_history_table" aria-describedby="activity_history_table">
                                            <thead>
                                                <tr>
                                                    <th>Time</th>
                                                    <th>Event</th>
                                                    <th>User</th>
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
        </div>
    </div>
    </div>
</section>
@endsection