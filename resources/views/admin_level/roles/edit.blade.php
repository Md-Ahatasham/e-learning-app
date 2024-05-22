@extends('layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-11">
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
                        <h3 class="card-title" style="font-weight: normal;font-size:16px; margin-left:50%">Update Assigned permissions </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row text">
                            <div class="col-md-3 col-lg-3 right_border">
                                {!! Form::model($data['role'], ['method' => 'PATCH','route' => ['roles.update', $data['role']['id']]]) !!}

                                <div class="form-group">
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-12 text-left col-form-label">Role Name</label>
                                        <div class="col-sm-12">
                                            <input name="name" readonly="readonly" placeholder="Enter Role Name" value="{{ $data['role']['name'] }}" id="preferred_name" type="text" class="input_field form-control-sm form-control" />
                                            @if ($errors->has('name')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                    <button type="submit" class="btn btn-info btn-sm">Update</button>
                                    <a href="{{route('roles.index')}}" class="btn btn-danger btn-sm" id="cancel">Cancel</a>
                                </div>
                            </div>

                            <div class="col-md-9 col-lg-9">
                                <div class="form-group">
                                    Permissions:
                                    <br />

                                    <div class="row">
                                        <table id="add-row" class="display table table-striped table-hover table-bordered">
                                            <thead class="cat_modal_header">
                                                <th style="font-weight: normal;font-size:14px; text-align:center">List</th>
                                                <th style="font-weight: normal;font-size:14px; text-align:center">Add</th>
                                                <th style="font-weight: normal;font-size:14px; text-align:center">Update</th>
                                                <th style="font-weight: normal;font-size:14px; text-align:center">Remove</th>

                                            </thead>
                                        </table>
                                    </div>


                                    <div class="row">
                                    <div class="col-md-12"><input id="selectAll" name="selectAll" type="checkbox"> <label for='selectAll'> <strong>Select All</strong></label></div>
                                        @foreach($data['permission'] as $value)
                                        <div class="col-md-3">
                                            <label>{{ Form::checkbox('permission[]', $value['id'], in_array($value['id'], $data['rolePermissions']) ? true : false, array('class' => 'name')) }}
                                                {{ $value['name'] }}</label>
                                        </div>
                                        @endforeach
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
</section>


@endsection