@extends('layouts.master')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div style="margin:auto;width:236px;">
        </div>
        <div class="row">
            <div class="col-md-9 offset-md-2 patient">
                <div class="card-header patient-header">
                    <h3 class="card-title top_headline_precaution">Add Pre-Cautions </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 offset-md-2 patient-form">
                <div class="card patient-card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                <form action="{{route('precautions.update',$data['precaution']['id'])}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row text">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Name of Pre-Caution</label>
                                                    <div class="col-sm-9">
                                                        <input name="pre_caution_name" value="{{$data['precaution']['pre_caution_name'] }}" id="pre_caution_name" type="text" class="form-control-sm form-control" />
                                                        @if ($errors->has('pre_caution_name')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('pre_caution_name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Abbreviation</label>
                                                    <div class="col-sm-9">
                                                        <input name="abbreviation" value="{{$data['precaution']['abbreviation'] }}" id="abbreviation" type="text" class="form-control-sm form-control" />
                                                        @if ($errors->has('abbreviation')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('abbreviation') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-3 col-form-label">Select Color</label>
                                                    <div class="col-sm-4">
                                                        <img class="color-picker-image" src="{{asset('dist/img/img_colormap.gif')}}" usemap="#colormap" alt="colormap">
                                                        @include('admin_level.preCautions.map')
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <label for="inputPassword" class="col-sm-12 col-form-label">Preview</label>
                                                        <input name="color_code" value="{{$data['precaution']['color_code'] }}" id="color_code" type="text" class="form-control" style="background-color:{{$data['precaution']['color_code'] }}" />
                                                        @if ($errors->has('color_code')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('color_code') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-12 col-md-8 text-right">
                                                    <div class="form-group">
                                                        <a href="{{route('precautions.index')}}" class="btn cancel-button btn-danger btn-md" id="cancel">Cancel</a>
                                                        <button type="submit" class="btn btn-info btn-md">Update</button>
                                                    </div>
                                                </div>
                                            </div>
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
</section>

@endsection