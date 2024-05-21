@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <table id="tablettable" aria-describedby="tablettable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tablet Number</th>
                                            <th>Time Since Last Sync</th>
                                            <th>Rounder Name</th>
                                            <th class="text-center">Assigned Patients</th>
                                            <th>Last Location</th>
                                            <th>Tablet in-service date</th>
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


    {{-- start of assign tablet add modal --}}

    <div class="modal fade" id="tabletModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <h5 class="modal-title">Assign Tablet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('tablets.store')}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}

                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="inputEmail4">Rounder Name </label>
                                    <select name="rounder_id" required="required" class="form-control-sm form-control" id="rounder_name">
                                        <option value="">--Select--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="room_noc">Tablet Name</label>
                                    <input required="required" placeholder="Enter Tablet Name" class="form-control-sm form-control" id="tablet_name" type="text" name="tablet_name" />
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="col-6 text-center">
                        <span><a data-dismiss="modal" aria-label="Close" class="btn btn-danger cancel-button btn-md text-left">Cancel&nbsp;<span class="glyphicons glyphicons-circle_minus"></span></a></span>
                        <span><button type="submit" class="btn btn-info btn-md text-right">Save</button></span>
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end of assign tablet add modal --}}


    {{-- begin edit assign tablet modal --}}

    <div class="modal fade" id="editTabletModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <h5 class="modal-title">Update Tablet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frm" action="{{route('tablets.update')}}" method="post" enctype="multipart/form-data">

                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="inputEmail4" style="font-weight: normal;font-size:14px;">Rounder Name</label>
                                    <select name="rounder_id" required="required" class="form-control-sm form-control" id="edit_rounder_name">
                                        <option value="0">--Select--</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label for="">Tablet Name</label>
                                    <input required="required" name="tablet_name" id="edit_tablet_name" type="text" class="form-control-sm form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <span><a data-dismiss="modal" aria-label="Close" class="btn btn-danger cancel-button btn-md text-left">Cancel&nbsp;<span class="glyphicons glyphicons-circle_minus"></span></a></span>
                        <input type="submit" class="btn btn-info btn-md" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>


    {{-- end of edit assign tablet modal --}}
</section>

@endsection