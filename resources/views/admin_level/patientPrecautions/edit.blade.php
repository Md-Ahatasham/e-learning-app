@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class=" p-3 mb-3">
                    <div class="row invoice-info">
                        <div class="col-sm-1 invoice-col">
                            <a href="{{route('patients.show',$data['patient']['id'])}}"><em class="fas fa-less-than font-size"></em> Back</a>
                        </div>
                        <div class="col-sm-1 invoice-col">
                            <div class="">
                                <img class="profile-user-img img-fluid img-circle" id="imgPreview" src="@if(!empty($data['patient']['patient_picture'])) {{$data['patient']['patient_picture']}} @else {{asset('dist/img/default_avatar.png')}} @endif" alt="patient picture" />
                            </div>
                        </div>
                        <div class="col-sm-3 invoice-col pl-4">
                            {{$data['patient']['first_name'].' '.$data['patient']['last_name']}}
                            <address>
                                <strong>@if($data['patient']['status'] == 1) {{'Admitted'}} @elseif($data['patient']['status'] == 0){{'Discharged'}} @else {{"Queue"}} @endif</strong><br>
                                <span>Unique Id: {{$data['patient']['id']}}</span><br>
                                <span>Admitted Date: {{$data['patient']['created_at']->format("m-d-Y")}}</span><br>
                                <span>Discharge Date: {{$data['patient_discharged_date']['discharged_date'] == "" ? "N/A" : date('m-d-Y',strtotime($data['patient_discharged_date']['discharged_date']))}} </span><br>
                                <span>Admitted Staff: {{$data['patient']['userAsEntryBy']['first_name'].' '.$data['patient']['userAsEntryBy']['last_name']}} </span><br>
                            </address>
                        </div>
                    </div>


                    <div class="col-md-11 offset-md-1 mt-2">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <form action="{{route('patientPrecautions.update',$data['patient']['id'])}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <h5>
                                                        Update Precautions (Click to select or remove precaution)
                                                        <div class="float-right mr-5"><input type="submit" class="btn btn-info btn-sm medical-button" value="Update"></div>
                                                    </h5>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row ">
                                                <div class="col-sm-10">
                                                    <div class="row precaution">
                                                        @if(isset($data['precaution_list']) && !empty($data['precaution_list']))
                                                        @foreach($data['precaution_list'] as $precaution)
                                                        <div class="col-sm-3 mb-2">
                                                            <input type="checkbox" class="patient-precaution-checkbox" name="precaution[]" value="{{$precaution->id}}" id="{{$precaution->id}}" @if(isset($data['patient_precaution'][$precaution->id]) && !empty($data['patient_precaution'][$precaution->id])) checked @endif />
                                                            <div id="{{$precaution->id}}" @if(isset($data['patient_precaution'][$precaution->id]) && !empty($data['patient_precaution'][$precaution->id])) class="btn btn-xs text-left btn-info precaution-text checkInput" @else class="btn btn-xs text-left precaution-text checkInput" @endif > {{$precaution->abbreviation}}</div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                    @if ($errors->has('precaution')) <p class="help-block icon_color">
                                                        <em class="fa fa-times-circle-o"></em>{{ $errors->first('precaution') }}
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
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