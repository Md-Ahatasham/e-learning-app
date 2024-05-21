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
                                        {{--                                            <input name="role_id" value="1" type="hidden" />--}}
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
                                        {!! Form::select('role_id', $data['allRoles'],'', array('data-placeholder' => 'Select Role','class' => 'form-control-sm form-control','required'=>'required')) !!}
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