@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-sm-10 patient">
                <div class="card-header patient-header">
                    <h3 class="card-title top_headline">Add Patient Details General Info </h3>
                </div>
            </div>
            <div class="col-sm-10  patient-form">
                <div class="card patient-card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                {!! Form::open(array('route' => 'patients.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
                                @csrf
                                <div class="card-body">
                                    <div class="row text">
                                        <div class="col-sm-11">

                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Patient Picture</label>
                                                <div class="col-sm-9">
                                                    <div class="">
                                                        <img class="profile-user-img img-fluid img-circle" id="imgPreview" src="{{asset('dist/img/default_avatar.png')}}" alt="patient picture">
                                                    </div>
                                                    <input name="patient_photo" value="{{ old('patient_photo') }}" id="profile_image" type="file" class="form-control-sm form-control" />
                                                    @if ($errors->has('patient_photo')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('patient_photo') }}</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">First Name</label>
                                                <div class="col-sm-9">
                                                    <input name="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}" id="first_name" type="text" class="form-control-sm form-control" />
                                                    @if ($errors->has('first_name')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('first_name') }}</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Preferred First Name</label>
                                                <div class="col-sm-9">
                                                    <input name="preferred_name" placeholder="Enter Preferred Name" value="{{ old('preferred_name') }}" id="preferred_name" type="text" class="form-control-sm form-control" />
                                                    @if ($errors->has('preferred_name')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('preferred_name') }}</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Last Name</label>
                                                <div class="col-sm-9">
                                                    <input name="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}" id="last_name" type="text" class="form-control-sm form-control" />
                                                    @if ($errors->has('last_name')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('last_name') }}</p>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Date of Birth</label>
                                                <div class="col-sm-9">
                                                    <input name="dob" value="{{ old('dob') }}" id="date_of_birth" type="date" class="form-control-sm form-control" />
                                                    @if ($errors->has('dob')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('dob') }}</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Gender</label>
                                                <div class="col-sm-9">
                                                    <select name="gender" class="form-control form-control-sm select2" id="gender">
                                                        <option value="">Select Gender</option>
                                                        @if(isset($data['gender']) && !empty($data['gender']))

                                                        @foreach($data['gender'] as $gender)
                                                        <option value="{{$gender['id']}}" @if(old('gender')==$gender['id']) {{ 'selected' }} @endif>{{$gender['name']}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    @if ($errors->has('gender')) <p class="help-block icon_color">
                                                        <em class="fa fa-times-circle-o"></em>{{ $errors->first('gender') }}
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Unit</label>
                                                <div class="col-sm-9">
                                                    <input name="unit" placeholder="Enter Unit Name" value="{{ old('unit') }}" id="" type="text" class="form-control-sm form-control" />
                                                    @if ($errors->has('unit')) <p class="help-block icon_color">
                                                        <em class="fa fa-times-circle-o"></em>{{ $errors->first('unit') }}
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Room</label>
                                                <div class="col-sm-9">
                                                    <input name="room" placeholder="Enter Room Name" value="{{ old('room') }}" id="" type="text" class="form-control-sm form-control" />
                                                    @if ($errors->has('room')) <p class="help-block icon_color">
                                                        <em class="fa fa-times-circle-o"></em>{{ $errors->first('room') }}
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Bed</label>
                                                <div class="col-sm-9">
                                                    <input name="bed" placeholder="Enter Bed Name" value="{{ old('bed') }}" id="" type="text" class="form-control-sm form-control" />
                                                    @if ($errors->has('bed')) <p class="help-block icon_color">
                                                        <em class="fa fa-times-circle-o"></em>{{ $errors->first('bed') }}
                                                    </p>
                                                    @endif
                                                </div>
                                            </div> -->

                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Unit</label>
                                                <div class="col-sm-9">

                                                    <select name="unit" class="form-control form-control-sm select2 unit">
                                                        <option value="">Select Unit</option>
                                                        @if(isset($data['unit_list']) && !empty($data['unit_list']))
                                                        @foreach($data['unit_list'] as $unit)
                                                        <option value="{{$unit['id']}}" value="old('unit')">{{$unit['name']}}</option>
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
                                                    <select name="room" class="form-control form-control-sm select2 room">
                                                        <option value="">Select Room No</option>
                                                        @if(isset($data['room_list']) && !empty($data['room_list']))

                                                        @foreach($data['room_list'] as $room)
                                                        <option value="{{$room['id']}}" value="old('room')">{{$room['room_no']}}</option>
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
                                                    <select name="bed" class="form-control form-control-sm select2 bed">
                                                        <option value="">Select Bed No</option>
                                                        @if(isset($data['bed_list']) && !empty($data['bed_list']))

                                                        @foreach($data['bed_list'] as $bed)
                                                        <option value="{{$bed['id']}}" value="old('bed')">{{$bed['bed_no']}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    @if ($errors->has('bed')) <p class="help-block icon_color">
                                                        <em class="fa fa-times-circle-o"></em>{{ $errors->first('bed') }}
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!--<div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Admission Date</label>
                                                <div class="col-sm-9">
                                                    <input name="admission_date" value="{{ old('admission_date') }}" id="admission_date" type="date" class="form-control-sm form-control" />
                                                    @if ($errors->has('admission_date')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('admission_date') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Admission Time</label>
                                                <div class="col-sm-9">
                                                    <div class="timepicker_div">
                                                        <input type="text" value="{{ old('admission_time') }}" name="admission_time" class="form-control-sm form-control timepicker" placeholder=" Select Time">
                                                    </div>
                                                </div>
                                            </div>-->
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Unique Stay Id</label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="{{ old('unique_stay_id') }}" name="unique_stay_id" class="form-control-sm form-control" placeholder=" Unique Id">
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
                                                        <option value="{{$key}}" @if(old('interval')==$key) {{ 'selected' }} @endif>{{$interval}}</option>
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
                                                    <select name="preferred_language" class="form-control form-control-sm select2" id="sex">
                                                        <option value="English">Select Preferred Language</option>
                                                        @if(isset($data['language']) && !empty($data['language']))

                                                        @foreach($data['language'] as $key=>$language)
                                                        <option value="{{$key}}" @if(old('preferred_language')==$key) {{ 'selected' }} @endif>{{$language}}</option>
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
                                                    <input name="address" value="no address" placeholder="Enter Address" id="address" type="text" class="form-control-sm form-control" />
                                                    @if ($errors->has('address')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em> {{ $errors->first('address') }}</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row d-none">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Phone Number</label>
                                                <div class="col-sm-9">
                                                    <input name="phone_number" value="9876543212345" placeholder="Enter Phone Number" id="phone_number" type="text" class="form-control-sm form-control" />
                                                    @if ($errors->has('phone_number')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em> {{ $errors->first('phone_number') }}</p>
                                                    @endif
                                                    <span id="phone_max-length-message"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row d-none">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Emergency Contact Number</label>
                                                <div class="col-sm-9">
                                                    <input type="hidden" name="assigned_rounder_id" value="0" />
                                                    <input name="emergency_contact" value="9876543212345" placeholder="Enter Emergency Contact" id="emergency_contact" type="text" class="form-control-sm form-control" />
                                                    @if ($errors->has('emergency_contact')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em> {{ $errors->first('emergency_contact') }}</p>
                                                    @endif
                                                    <span id="emergency_max-length-message"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row pre-caution">
                                                <label for="patient_note" class="col-sm-3 col-form-label">Precautions</label>
                                                <div class="col-sm-9">
                                                    <div class="row precaution">
                                                        @foreach($data['precaution_list'] as $precaution)
                                                        <div class="col-sm-4 mb-3">
                                                            <input type="checkbox" class="patient-precaution-checkbox" name="precaution[]" value="{{$precaution->id}}" id="{{$precaution->id}}" class="chk" />
                                                            <div class="btn btn-xs text-left precaution-text checkInput" id="{{$precaution->id}}">{{$precaution->abbreviation}}</div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @if ($errors->has('precaution')) <p class="help-block icon_color">
                                                        <em class="fa fa-times-circle-o"></em>{{ $errors->first('precaution') }}
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="patient_note" class="col-sm-3 col-form-label">Patient Notes</label>
                                                <div class="col-sm-9">
                                                    <textarea name="admission_notes" placeholder="Enter Patient Notes..." cols="50" rows="5" class="form-control text-aria-form-control" value="{{ old('admission_notes') }}"></textarea>
                                                    @if ($errors->has('admission_notes')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em> {{ $errors->first('admission_notes') }}</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="patient_note" class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">

                                                    <a href="{{route('patients.index')}}" class="btn btn-danger cancel-button btn-md mr-4 px-5" id="cancel">Cancel</a>
                                                    <button type="submit" name="action" value="save_to_tablet" class="btn btn-info mr-3 btn-md px-5">Send Patient To Tablet</button>
                                                    <button type="submit" name="action" value="save_to_queue" class="btn btn-info btn-md px-5">Send Patient To Queue</button>
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