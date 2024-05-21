@extends('layouts.master')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div style="margin:auto;width:236px;">
        </div>
        <div class="row">
            <div class="col-md-9 offset-md-2 patient">
                <div class="card-header patient-header">
                    <h3 class="card-title top_headline_precaution">Add Pre-Cautions</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 offset-md-2 patient-form">
                <div class="card patient-card">

                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane active" id="settings">
                                {!! Form::open(array('route' => 'precautions.store','method'=>'POST')) !!}
                                {{csrf_field()}}
                                <div class="card-body">
                                    <div class="row text">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Name of Pre-Caution</label>
                                                <div class="col-sm-9">
                                                    <input name="pre_caution_name" value="{{ old('pre_caution_name') }}" id="pre_caution_name" type="text" class="form-control-sm form-control" />
                                                    @if ($errors->has('pre_caution_name')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('pre_caution_name') }}</p>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Abbreviation</label>
                                                <div class="col-sm-9">
                                                    <input name="abbreviation" value="{{ old('abbreviation') }}" id="abbreviation" type="text" class="form-control-sm form-control" />
                                                    @if ($errors->has('abbreviation')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('abbreviation') }}</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Select Color</label>
                                                <div class="col-sm-4">
                                                    <input type="color" required id="html5colorpicker" onchange="clickColor(0, -1, -1, 5)" value="#4070A9">
                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="inputPassword" class="col-sm-12 col-form-label">Preview</label>
                                                    <input name="color_code" id="color_code" type="hidden" class="form-control" />
                                                    <input name="from" id="from" type="hidden" value="{{$data['from']}}">
                                                    <input  name="color_view" value="{{ old('color_view') }}" id="color_view" type="text" class="form-control" />
                                                    @if ($errors->has('color_code')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('color_code') }}</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-8 text-right">
                                                <div class="form-group">
                                                    <a onclick="history.back()" class="btn cancel-button btn-danger btn-md" id="cancel">Cancel</a>
                                                    <button type="submit" class="btn btn-info btn-md">Save</button>
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

@endsection