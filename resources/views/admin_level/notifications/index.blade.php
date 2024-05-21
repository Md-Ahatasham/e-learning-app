@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <table id="notificationTable" aria-describedby="notificationTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Patient</th>
                                            <th>Rounder</th>
                                            <th>Notification Details</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- start of user add modal --}}

    <div class="modal fade" id="edit_notification">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <h5 class="modal-title">Assign Patient to New Rounder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="frm" id="frm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mx-auto">
                                <div class="form-group">
                                    <label for="first_name">Patient Name</label>
                                    <input name="first_name" placeholder="Enter First Name" readonly="readonly" required="required" id="patient_name" type="text" class=" form-control" />
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 margin-right">
                                <div class="form-group">
                                    <label for="last_name">Rounder Name</label>
                                    <select name="rounder_id" required="required" class=" form-control select2 rounder_name" id="rounder_id">
                                        <option value="0">--Select--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
            

            <div class="modal-footer justify-content-center">
                <div class="col-6 text-center">
                    <span><a data-dismiss="modal" aria-label="Close" class="btn btn-danger cancel-button btn-md text-left">Cancel&nbsp;<span class="glyphicons glyphicons-circle_minus"></span></a></span>
                    <span><button type="submit" name="submit" class="btn btn-info btn-md text-right">Save</button></span>
                </div>
            </div>
            </div>

            </form>
        </div>
    </div>
    </div>
    {{-- end of user add modal --}}
</section>

@endsection