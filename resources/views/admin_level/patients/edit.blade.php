@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-sm-10 patient">
                <div class="card-header patient-header">
                    <h3 class="card-title top_headline">Update Patient Details General Info </h3>
                </div>
            </div>
            <div class="col-sm-10 patient-form">
                <div class="card patient-card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                <form action="{{route('patients.update',$data['patient']['id'])}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row text">
                                            <div class="col-sm-11">

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Patient Picture</label>
                                                    <div class="col-sm-9">
                                                        <div class="">
                                                            <img class="profile-user-img img-fluid img-circle" id="imgPreview" @if(empty($data['patient']['patient_picture'])) src="{{asset('dist/img/default_avatar.png')}}" @else src="{{asset($data['patient']['patient_picture'])}}" @endif alt="patient picture">
                                                        </div>
                                                        <input name="patient_photo" value="{{ old('patient_photo') }}" id="profile_image" type="file" class="input_field form-control-sm form-control" />
                                                        @if ($errors->has('patient_photo')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('patient_photo') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row pl-2 d-none">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label"></label>
                                                    <div class="col-sm-9">
                                                        <div class="form-group row">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="old_or_new" checked class="reload mr-2" value="1">Existing Patient
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="old_or_new" class="mr-2 reset" value="0">New Patient
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">First Name</label>
                                                    <div class="col-sm-9">
                                                        <input name="first_name" placeholder="Enter First Name" value="{{ $data['patient']['first_name'] }}" id="first_name" type="text" class="input_field form-control-sm form-control" />
                                                        @if ($errors->has('first_name')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('first_name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Preferred First Name</label>
                                                    <div class="col-sm-9">
                                                        <input name="preferred_name" placeholder="Enter Preferred Name" value="{{ $data['patient']['preferred_name'] }}" id="preferred_name" type="text" class="input_field form-control-sm form-control" />
                                                        @if ($errors->has('preferred_name')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('preferred_name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Last Name</label>
                                                    <div class="col-sm-9">
                                                        <input name="last_name" placeholder="Enter Last Name" value="{{ $data['patient']['last_name'] }}" id="last_name" type="text" class="input_field form-control-sm form-control" />
                                                        @if ($errors->has('last_name')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('last_name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Date of Birth</label>
                                                    <div class="col-sm-9">
                                                        <input name="dob" value="{{$data['patient']['dob']}}" id="date_of_birth" type="date" class="input_field form-control-sm form-control" />
                                                        @if ($errors->has('dob')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('dob') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Gender</label>
                                                    <div class="col-sm-9">
                                                        <select name="gender" class="form-control input_field form-control-sm" id="gender">
                                                            <option value="">Select Gender</option>
                                                            @if(isset($data['gender']) && !empty($data['gender']))
                                                            @foreach($data['gender'] as $gender)
                                                            <option value="{{$gender['id']}}" @if($gender['id']==$data['patient']['gender']) {{ 'selected' }} @endif>{{$gender['name']}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('gender')) <p class="help-block icon_color">
                                                            <em class="fa fa-times-circle-o"></em>{{ $errors->first('gender') }}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>
<!-- 
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Unit</label>
                                                    <div class="col-sm-9">
                                                        <input name="unit" placeholder="Enter Unit Name" value="{{$data['patient']['unit'] }}" id="" type="text" class="input_field form-control-sm form-control" />
                                                        @if ($errors->has('unit')) <p class="help-block icon_color">
                                                            <em class="fa fa-times-circle-o"></em>{{ $errors->first('unit') }}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Room</label>
                                                    <div class="col-sm-9">
                                                        <input name="room" placeholder="Enter Room Name" value="{{$data['patient']['room'] }}" id="" type="text" class="input_field form-control-sm form-control" />
                                                        @if ($errors->has('room')) <p class="help-block icon_color">
                                                            <em class="fa fa-times-circle-o"></em>{{ $errors->first('room') }}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Bed</label>
                                                    <div class="col-sm-9">
                                                        <input name="bed" placeholder="Enter Bed Name" value="{{$data['patient']['bed'] }}" id="" type="text" class="input_field form-control-sm form-control" />
                                                        @if ($errors->has('bed')) <p class="help-block icon_color">
                                                            <em class="fa fa-times-circle-o"></em>{{ $errors->first('bed') }}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div> -->

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Unit</label>
                                                    <div class="col-sm-9">
                                                        <select name="unit" class="form-control input_field form-control-sm select2 unit">
                                                            <option value="">Select Unit</option>
                                                            @if(isset($data['unit_list']) && !empty($data['unit_list']))
                                                            @foreach($data['unit_list'] as $unit)
                                                            <option value="{{$unit['id']}}" @if($unit['id']==$data['patient']['unit']) {{ 'selected' }} @endif>{{$unit['name']}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('unit')) <p class="help-block icon_color">
                                                            <em class="fa fa-times-circle-o"></em>{{ $errors->first('unit') }}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Room</label>
                                                    <div class="col-sm-9">

                                                        <select name="room" class="form-control input_field form-control-sm select2 room">
                                                            <option value="">Select Room No</option>
                                                            @if(isset($data['room_list']) && !empty($data['room_list']))

                                                            @foreach($data['room_list'] as $room)
                                                            <option value="{{$room['id']}}" @if($room['id']==$data['patient']['room']) {{ 'selected' }} @endif>{{$room['room_no']}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('room')) <p class="help-block icon_color">
                                                            <em class="fa fa-times-circle-o"></em>{{ $errors->first('room') }}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Bed</label>
                                                    <div class="col-sm-9">

                                                        <select name="bed" class="form-control input_field form-control-sm select2 bed">
                                                            <option value="">Select Bed No</option>
                                                            @if(isset($data['bed_list']) && !empty($data['bed_list']))

                                                            @foreach($data['bed_list'] as $bed)
                                                            <option value="{{$bed['id']}}" @if($bed['id']==$data['patient']['bed']) {{ 'selected' }} @endif>{{$bed['bed_no']}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('bed')) <p class="help-block icon_color">
                                                            <em class="fa fa-times-circle-o"></em>{{ $errors->first('bed') }}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Admission Date</label>
                                                    <div class="col-sm-9">
                                                        <input name="admission_date" value="{{ $data['patient']['admission_date'] }}" id="admission_date" type="date" class="input_field form-control-sm form-control" />
                                                        @if ($errors->has('admission_date')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('admission_date') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Admission Time</label>
                                                    <div class="col-sm-9">
                                                        <div class="timepicker_div">
                                                            <input type="text" name="admission_time" value="{{ $data['patient']['admission_time'] }}" class="form-control-sm form-control timepicker" placeholder=" Select Time">
                                                        </div>
                                                    </div>
                                                </div> -->

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Unique Stay Id</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="{{ $data['patient']['unique_stay_id'] }}" name="unique_stay_id" class="form-control-sm form-control" placeholder=" Unique Id">
                                                        @if ($errors->has('unique_stay_id')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('unique_stay_id') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Patient Rounding Interval</label>
                                                    <div class="col-sm-9">
                                                        <select name="interval" class="form-control form-control-sm select2" id="interval">
                                                            <option value="">Select Interval</option>
                                                            @if(isset($data['interval']) && !empty($data['interval']))
                                                            @foreach($data['interval'] as $key=>$interval)
                                                            <option value="{{$key}}" @if($key==$data['patient']['interval']) {{'selected'}} @endif>{{$interval}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('interval')) <p class="help-block icon_color">
                                                            <em class="fa fa-times-circle-o"></em>{{ $errors->first('interval') }}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>



                                                <div class="form-group row d-none">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Preferred Language</label>
                                                    <div class="col-sm-9">
                                                        <select name="preferred_language" class="form-control input_field form-control-sm select2" id="sex">
                                                            <option value="">Select Preferred Language</option>
                                                            @if(isset($data['language']) && !empty($data['language']))
                                                            @foreach($data['language'] as $key=>$language)
                                                            <option value="{{$key}}" @if($key==$data['patient']['preferred_language']) {{'selected'}} @endif>{{$language}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('preferred_language')) <p class="help-block icon_color">
                                                            <em class="fa fa-times-circle-o"></em>{{ $errors->first('preferred_language') }}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row d-none">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Address</label>
                                                    <div class="col-sm-9">
                                                        <input name="address" value="{{$data['patient']['address']}}" placeholder="Enter Address" id="address" type="text" class="form-control-sm form-control" />
                                                        @if ($errors->has('language')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em> {{ $errors->first('address') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row d-none">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Phone Number</label>
                                                    <div class="col-sm-9">
                                                        <input name="phone_number" value="{{$data['patient']['phone_number']}}" placeholder="Enter Phone Number" id="phone_number" type="text" class="form-control-sm form-control" />
                                                        @if ($errors->has('phone_number')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em> {{ $errors->first('phone_number') }}</p>
                                                        @endif
                                                        <span id="phone_max-length-message"></span>
                                                    </div>
                                                </div>


                                                <div class="form-group row d-none">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Emergency Contact Number</label>
                                                    <div class="col-sm-9">
                                                        <input name="emergency_contact" value="{{$data['patient']['emergency_contact']}}" placeholder="Enter Emergency Contact" id="emergency_contact" type="text" class="form-control-sm form-control" />
                                                        @if ($errors->has('emergency_contact')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em> {{ $errors->first('emergency_contact') }}</p>
                                                        @endif
                                                        <span id="emergency_max-length-message"></span>
                                                    </div>
                                                </div>

                                                <!-- @if($data['patient']['status'] != 1)
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Change Status</label>
                                                    <div class="col-sm-9">

                                                        <select name="status" class="form-control input_field form-control-sm select2">
                                                            <option value="">Select Status</option>
                                                            @if(isset($data['status']) && !empty($data['status']))
                                                            @foreach($data['status'] as $status)
                                                            <option value="{{$status['id']}}" @if($status['id']==$data['patient']['status']) {{ 'selected' }} @endif>{{$status['name']}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('assigned_rounder_id')) <p class="help-block icon_color">
                                                            <em class="fa fa-times-circle-o"></em>{{ $errors->first('assigned_rounder_id') }}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif -->

                                                <div class="form-group row pre-caution">
                                                    <label for="patient_note" class="col-sm-3 col-form-label">Precautions</label>
                                                    <div class="col-sm-9">
                                                        <div class="row precaution">
                                                            @foreach($data['precaution_list'] as $precaution)
                                                            <div class="col-sm-4 mb-3">
                                                                <input type="checkbox" class="patient-precaution-checkbox" name="precaution[]" value="{{$precaution->id}}" id="{{$precaution->id}}" @if(isset($data['patient_precaution'][$precaution->id]) && !empty($data['patient_precaution'][$precaution->id])) checked @endif>
                                                                <div id="{{$precaution->id}}" @if(isset($data['patient_precaution'][$precaution->id]) && !empty($data['patient_precaution'][$precaution->id])) class="btn btn-xs text-left  precaution-text checkInput" style="background-color:{{$precaution->color_code}}" @else class="btn btn-xs text-left precaution-text checkInput" @endif > {{$precaution->abbreviation}}</div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        @if ($errors->has('precaution')) <p class="help-block icon_color">
                                                            <em class="fa fa-times-circle-o"></em>{{ $errors->first('precaution') }}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                @can('precaution-create')
                                                <div class="form-group row">
                                                    <label for="patient_note" class="col-sm-3 col-form-label"></label>
                                                    <div class="col-sm-9 ">
                                                        <a href="{{route('precautions.create')}}?from={{$data['patient']['id']}}" class="add_button btn-sm btn-default add_more_button form-control" title="Add New Precaution">
                                                            <em class="fas fa-plus add_icon"></em>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endcan

                                                <div class="form-group row">
                                                    <label for="patient_note" class="col-sm-3 col-form-label">Patient Notes</label>
                                                    <div class="col-sm-9">
                                                        <textarea name="admission_notes" placeholder="Enter Patient Notes..." cols="50" rows="5" class="form-control text-aria-form-control" value="{{ old('admission_notes') }}">{{$data['patient']['admission_notes']}}</textarea>
                                                        @if ($errors->has('admission_notes')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em> {{ $errors->first('admission_notes') }}</p>
                                                        @endif

                                                        <input type="hidden" name="check_incomming" value="@if(isset($data['incomming']) && $data['incomming']==1) {{1}} @else {{0}} @endif">
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="patient_note" class="col-sm-3 col-form-label"></label>
                                                    <div class="col-sm-9 text-center">
                                                        <a href="{{route('patients.index')}}" class="btn btn-danger cancel-button btn-md mr-4 px-5" id="cancel">Cancel</a>
                                                        <button type="submit" class="btn btn-info btn-md px-5">Save</button>
                                                    </div>
                                                </div>

                                            </div>

                                            {!! Form::close() !!}
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
</div>
</section>

@endsection