@extends('layouts.master')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-8 mx-auto">

                <div class="p-2 mb-3">
                    <h3 class="card-title">Update Rounder</h3>
                </div>

                <form action="{{route('rounders.update',$data['rounder']['id'])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row text">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group row">
                                <label for="first_name" class="col-sm-3 col-form-label">First name</label>
                                <div class="col-sm-9">
                                    <input name="first_name" value="{{ $data['rounder']['first_name'] }}" placeholder="Enter First Name" id="first_name" type="text" class="form-control-sm form-control" />
                                    @if ($errors->has('first_name')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('first_name') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-sm-3 col-form-label">Last name</label>
                                <div class="col-sm-9">
                                    <input name="last_name" value="{{ $data['rounder']['last_name']}}" placeholder="Enter Last Name" id="last_name" type="text" class="form-control-sm form-control" />
                                    @if ($errors->has('last_name')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('last_name') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="employee_id" class="col-sm-3 col-form-label">Employee ID</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="date_of_birth" value="1970-05-05" />
                                    <input name="employee_id" value="{{ $data['rounder']['user_code'] }}" readonly="readonly" minlength="5" maxlength="5" placeholder="Enter Employee ID" id="employee_id" type="text" class="form-control-sm form-control" />
                                    @if ($errors->has('employee_id')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('employee_id') }}</p>
                                    @endif
                                </div>
                            </div>

                            <!--<div class="form-group row">
                                <label for="date_of_birth" class="col-sm-3 col-form-label">Date of Birth</label>
                                <div class="col-sm-9">
                                    <input name="date_of_birth" value="{{ $data['rounder']['rounderInfo']['dob']  }}" placeholder="Enter Date" id="date_of_birth" type="date" class="form-control-sm form-control" />
                                    @if ($errors->has('date_of_birth')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('date_of_birth') }}</p>
                                    @endif
                                </div>
                            </div>-->

                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Reset Biometric</label>
                                <div class="col-sm-9">
                                    <button type="button" class="btn btn-warning btn-md">Reset</button>
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group text-center">
                                    <br />
                                    <a href="{{route('rounders.index')}}" class="btn btn-danger btn-md mr-3" id="cancel">Cancel</a>
                                    <button type="submit" class="btn btn-info btn-md">Save</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

</section>

@endsection