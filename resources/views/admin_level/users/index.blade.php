@extends('layouts.master')
@section('content')
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-11">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">User List </h4>
                        @can('user-create')
                        <a href="" class="btn btn-info btn-round ml-auto btn-sm add_button_to_right" data-toggle="modal" data-target="#modal-xl"><em class="fa fa-plus"></em> Add New</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" aria-describedby="table">
                            <thead>
                                <tr>
                                    <th>Picture</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Employee ID</th>
                                    <th>Email</th>
                                    <th class="text-center justify-content-around">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($data['users']))
                                @foreach ($data['users'] as $user)
                                <tr>
                                    <td><img class="patient_image rounded-circle" alt="user_avatar" src="{{$user->profile_photo}}" /></td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->user_code }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-center">
                                        <div class="row form-button-action">

                                            <div class="col-6 text-right">
                                                @can('user-edit')
                                                <a class="edit_user btn btn-primary btn-xs" id="{{$user->id}}"><em class="fa fa-edit"></em></a>
                                                @endcan
                                            </div>

                                            <div class="col-6 text-left">
                                                @can('user-delete')
                                                <form action="{{ route('users.destroy',$user->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete ?')"><em class='fas fa-trash-alt'></em></button>
                                                </form>
                                                @endcan
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>


    {{-- start of user add modal --}}

    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl min-width">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 mx-auto">
                                        <div class="form-group">
                                            <label for="first_name">User Photo</label>
                                            <div class="">
                                                <img class="profile-user-img img-fluid img-circle" id="imgPreview" src="{{asset('dist/img/default_avatar.png')}}" alt="User picture">
                                            </div>
                                            <input name="user_photo" value="{{ old('user_photo') }}" id="profile_image" type="file" class="form-control-sm form-control" />
                                            @if ($errors->has('user_photo')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('user_photo') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name" required="required" id="user_first_name" type="text" class="form-control-sm form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input name="last_name" value="{{ old('last_name') }}" required="required" placeholder="Enter First Name" id="user_last_name" type="text" class="form-control-sm form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input name="role_id" value="1" type="hidden" />
                                            <input name="email" value="{{ old('email') }}" required="required" placeholder="Enter Email Address" id="user_email" type="email" class="form-control-sm form-control" />
                                            <p id="email"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input name="password" value="{{ old('password') }}" required="required" placeholder="Enter Password" id="user_password" type="password" class="form-control-sm form-control" />
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label for="last_name">Employee ID</label>
                                            <input name="user_code" value="12345678" readonly="readonly" minlength="8" maxlength="8" placeholder="Enter Employee ID" id="employee_id" type="text" class="form-control-sm form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label for="email">Select Role</label>
                                            {!! Form::select('roles', $data['allRoles'],'', array('data-placeholder' => 'Select Role','class' => 'form-control-sm form-control','required'=>'required')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer justify-content-center">
                        <div class="col-6 text-center">
                            <span><a data-dismiss="modal" aria-label="Close" class="btn btn-danger cancel-button btn-sm text-left">Cancel&nbsp;<span class="glyphicons glyphicons-circle_minus"></span></a></span>
                            <span><button type="submit" name="submit" class="btn btn-info btn-sm text-right">Save</button></span>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    {{-- end of user add modal --}}


    {{-- start of user edit modal --}}

    <div class="modal fade" id="edit_user">
        <div class="modal-dialog modal-xl min-width">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <h5 class="modal-title">Update User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="frm" id="frm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label for="first_name">User Photo</label>
                                            <div class="">
                                                <img class="profile-user-img img-fluid img-circle" id="imgPreviewForEdit" alt="User picture">
                                            </div>
                                            <input name="user_photo" value="{{ old('user_photo') }}" id="edit_profile_image" type="file" class="input_field form-control-sm form-control" />
                                            @if ($errors->has('user_photo')) <p class="help-block icon_color"><em class="fa fa-times-circle-o"></em>{{ $errors->first('user_photo') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input name="first_name" placeholder="Enter First Name" required="required" id="edit_first_name" type="text" class="form-control-sm form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input name="last_name" required="required" placeholder="Enter First Name" id="edit_last_name" type="text" class="form-control-sm form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input name="role_id" value="1" type="hidden" />
                                            <input name="email" required="required" placeholder="Enter Email Address" id="edit_user_email" type="email" class="edit_email form-control-sm form-control" />
                                            <p id="edit_email"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label for="email">Select Role</label>
                                            <select name="roles" class="form-control input_field form-control-sm" id="name">

                                            </select>
                                            @if ($errors->has('name')) <p class="help-block icon_color">
                                                <em class="fa fa-times-circle-o"></em>{{ $errors->first('name') }}
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label for="last_name">Employee ID</label>
                                            <input name="user_code" readonly="readonly" minlength="5" maxlength="5" placeholder="Enter Employee ID" id="edit_employee_id" type="text" class="form-control-sm form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 mx-auto">
{{--                                        <div class="form-group">--}}
{{--                                            <label for="last_name">Last Name</label>--}}
{{--                                            <input name="last_name" required="required" placeholder="Enter First Name" id="edit_last_name" type="text" class="form-control-sm form-control" />--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>

                <div class="modal-footer justify-content-center">
                    <div class="col-6 text-center">
                        <span><a data-dismiss="modal" aria-label="Close" class="btn btn-danger cancel-button btn-sm text-left">Cancel&nbsp;<span class="glyphicons glyphicons-circle_minus"></span></a></span>
                        <span><button type="submit" name="submit" class="btn btn-info btn-sm text-right">Save</button></span>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
    {{-- end of user edit modal --}}

</section>

@endsection