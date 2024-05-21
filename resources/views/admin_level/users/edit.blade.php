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
                                        <select name="role_id" class="form-control input_field form-control-sm" id="name">

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