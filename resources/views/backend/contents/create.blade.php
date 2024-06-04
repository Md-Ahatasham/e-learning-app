@extends('layouts.master')
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-around body_padding_top">
                <div class="col-md-12">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="card card-default">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title" style="font-weight: normal;font-size:16px; margin-left:50%">Assign permission to role</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><em class="fas fa-minus"></em></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><em class="fas fa-remove"></em></button>
                            </div>
                        </div>

                        <div class="card-body">
                            <form class="row text">
                                <div class="col-md-3 col-lg-3 right_border">
                                    <form action = "{{route('contents.store')}}" method ="post" enctype="multipart/form-data">
                                        {{csrf_field()}}

                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-12 text-left col-form-label">{{'Course Title'}}</label>
                                        <div class="col-sm-12">
                                            <input name="name" placeholder="Enter Role Name" value="{{ old('name') }}" id="last_name" type="text" class="form-control-sm form-control" />
                                            @if ($errors->has('name')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-12 text-left col-form-label">{{'Content'}}</label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control-sm form-control" name="content">
                                            @if ($errors->has('name')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                        <button type="submit" class="btn btn-sm btn-info">Save </button>
                                        <a href="" class="btn btn-danger btn-sm" id="cancel">Cancel</a>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-9">
                                    <div class="form-group">
                                        Permissions:
                                        <br />
                                        <div class="row">
                                            <table id="add-row" class="display table table-striped table-hover table-bordered">
                                                <thead class="cat_modal_header">
                                                <th style="font-weight: normal;font-size:14px;text-align:center">List</th>
                                                <th style="font-weight: normal;font-size:14px;text-align:center">Add</th>
                                                <th style="font-weight: normal;font-size:14px;text-align:center">Update</th>
                                                <th style="font-weight: normal;font-size:14px;text-align:center">Remove</th>

                                                </thead>
                                            </table>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12"><input id="selectAll" type="checkbox"> <label for='selectAll'> <strong>Select All</strong></label></div>
{{--                                            @foreach($data['permission'] as $value)--}}
                                                <div class="col-md-3">
{{--                                                    <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}--}}
{{--                                                        {{ $value->name }}</label>--}}
                                                </div>
{{--                                            @endforeach--}}
                                        </div>

                                    </div>
                                </div>

                            </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

    </section>


@endsection