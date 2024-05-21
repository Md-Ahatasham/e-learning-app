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
                                {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}

                                <div class="form-group">
                                    Role Name:

                                    <select name="name" class="form-control input_field form-control-sm" id="name">
                                        <option value="">Select Role</option>
                                        @if(isset($roles) && !empty($roles))
                                        @foreach($roles as $key =>$all)
                                        <option value="{{$key}}" @if($key==$role['name']) {{ 'selected' }} @endif>{{$key}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('name')) <p class="help-block icon_color">
                                        <em class="fa fa-times-circle-o"></em>{{ $errors->first('name') }}
                                    </p>
                                    @endif
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
                                        @foreach($permission as $value)
                                        <div class="col-md-3">
                                            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                {{ $value->name }}</label>
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