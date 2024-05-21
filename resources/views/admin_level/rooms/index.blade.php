@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-10">
                <div class="row card add_new_button_design mr-0">
                    <div class="">
                        <a href="" class="room btn btn-info btn-round ml-auto btn-md add_button_to_right" data-toggle="modal">
                            <em class="fa fa-plus"></em>&nbsp; Add New Rooms</a> <br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <table id="room" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Unit Name</th>
                                            <th>Room No</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data['room_list']) && !empty($data['room_list']))
                                        @foreach($data['room_list'] as $room)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$room['unit']['name']}}</td>
                                            <td>{{$room->room_no}}</td>
                                            <td class="text-center">
                                                <div class="row form-button-action">
                                                    <div class="col-6 text-right">
                                                        <button type="button" data-toggle="tooltip" title="" class="edit_room btn  btn-info btn-xs " data-original-title="Edit Task" id="{{$room->id}}">
                                                            <em class="fa fa-edit"></em>
                                                        </button>
                                                    </div>

                                                    <div class="col-6 text-left">
                                                        <form action="{{ route('rooms.destroy',$room->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete ?')"><em class='fas fa-trash-alt'></em></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- start of room add modal --}}

    <div class="modal fade" id="roomModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <h5 class="modal-title">Add New Rooms</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('rooms.store')}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}

                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="inputEmail4">Unit Name </label>
                                    <select name="unit_id" required="required" class="form-control-sm form-control" id="unit_name">
                                        <option value="0">--Select--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row" id="unitTable">

                                    <div class="form-group">
                                        <label for="room_noc">Room No</label>
                                        <input required="required" placeholder="Enter Room No" class="form-control-sm form-control" id="room_no" type="text" name="room_no[]">
                                    </div>
                                </div>
                                <a class="add_button btn-sm btn-default add_more_button form-control" title="Add field"><em class="fas fa-plus add_icon"></em> </a>
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
    {{-- end of room add modal --}}


    {{-- begin edit Room modal --}}

    <div class="modal fade" id="editRoomModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <h5 class="modal-title">Update Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frm" action="{{route('rooms.update')}}" method="post" enctype="multipart/form-data">

                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="inputEmail4" style="font-weight: normal;font-size:14px;">Unit Name</label>
                                    <select name="unit_id" required="required" class="form-control-sm form-control" id="edit_unit_name">
                                        <option value="0">--Select--</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label for="">Room No</label>
                                    <input required="required" name="room_no" id="edit_room_name" type="text" class="form-control-sm form-control">
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


    {{-- end of edit room modal @author:Ahatasham @date:13-003-2022 --}}
</section>

@endsection