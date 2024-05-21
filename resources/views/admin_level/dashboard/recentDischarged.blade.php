<div class="card mb-5">
    <div class="card-header">
        Recently Discharged Patients
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="active tab-pane" id="activity">
                <table id="dashboardDischargedPatientTable" aria-describedby="dashboardDischargedPatientTable" class="table table-bordered table-striped">
                    <tbody>
                        @foreach($data['recent_discharged_patient'] as $recent)
                        <tr>
                            <td><img class="patient_image rounded-circle" alt="patient_avatar" src="{{$recent->patient_picture}}"></td>
                            <td>
                                <p>{{$recent->first_name.' '.$recent->last_name}}</p>
                                @foreach($recent['preCaution'] as $precaution)
                                <a class="btn btn-primary btn-xs first mr-1" href="" style="background-color:{{$precaution['precaution']['color_code']}}">{{$precaution['precaution']['pre_caution_name']}} </a>
                                @endforeach
                            </td>
                            <td>
                                <div>{{$recent->unit}}</div>
                                <div>{{'Room #'. $recent->room}}</div>
                                <div>{{'Bed #'. $recent->room}}</div>
                                <div>{{'Discharge on: '. $recent['updated_at']->format('m-d-Y')}}</div>

                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-12"><a href="{{route('rounders.show',$recent['userAsRounder']['id'])}}"> Current Rounder</a></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="patient_image rounded-circle" alt="patient_avatar" src="@if(!empty($recent['userAsRounder']['profile_photo'])) {{$recent['userAsRounder']['profile_photo']}} @else {{asset('dist/img/default_avatar.png')}} @endif">
                                    </div>
                                    <div class="col-md-8">
                                        <div>{{$recent['userAsRounder']['first_name'].' '.$recent['userAsRounder']['last_name']}}</div>
                                        <div>{{'ID #'. $recent['userAsRounder']['user_code']}}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <a href="{{route('patients.show',$recent->id)}}" class="btn btn-md btn-info">View Patient</a>
                            </td>

                        </tr>

                        @endforeach
                        <tr>

                            <td colspan="5" class="text-right"><a href="{{route('patients.index')}}" class="btn btn-md btn-info">View All Patients</a> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>