@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-10">
                <div class="row card add_new_button_design mr-0">
                    <div class="">
                        @can('location-create')
                        <a href="" class="bed btn btn-info btn-round ml-auto btn-md add_button_to_right" data-toggle="modal">
                            <em class="fa fa-plus"></em>&nbsp; Add New Bed</a> <br>
                        @endcan
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <table id="bed" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Room No</th>
                                            <th>Bed No</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data['bed_list']) && !empty($data['bed_list']))
                                        @foreach($data['bed_list'] as $bed)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$bed['room']['room_no']}}</td>
                                            <td>{{$bed->bed_no}}</td>
                                            <td class="text-center">
                                                <div class="row form-button-action">
                                                    <div class="col-6 text-right">
                                                        @can('location-edit')
                                                        <button type="button" data-toggle="tooltip" title="" class="edit_bed btn  btn-info btn-xs " data-original-title="Edit Task" id="{{$bed->id}}">
                                                            <em class="fa fa-edit"></em>
                                                        </button>
                                                        @endcan
                                                    </div>

                                                    <div class="col-6 text-left">
                                                        @can('location-delete')
                                                        <form action="{{ route('beds.destroy',$bed->id) }}" method="post">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- start of room add modal --}}

    <div class="modal fade" id="bedModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <h5 class="modal-title" style="font-size:16px;">Add New Bed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('beds.store')}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group ">
                                    <label for="inputEmail4">Room No </label>
                                    <select name="room_id" required="required" class="form-control-sm form-control" id="room_no">
                                        <option value="0">--Select--</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="row" id="unitTable">

                                    <div class="form-group">
                                        <label for="">Bed No</label>
                                        <input class="form-control-sm form-control" id="" placeholder="Enter Bed No" type="text" required="required" name="bed_no[]">
                                    </div>
                                </div>
                                <a class="add_button btn-sm btn-default add_more_button form-control" title="Add field"><em class="fas fa-plus add_icon"></em></a>
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


    {{-- begin edit Room modal @author:Ahatasham @date:13-03-2022 --}}

    <div class="modal fade" id="editBedModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <h5 class="modal-title" style="font-weight: normal;font-size:16px;">Update Bed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frm" action="{{route('beds.update')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="inputEmail4">Room No</label>
                                    <select name="room_id" required="required" class="form-control-sm form-control" id="edit_room_no">
                                        <option value="0">--Select--</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group form-group-default">
                                    <label style="font-weight: normal;font-size:14px;">Bed No</label>
                                    <input required="required" name="bed_no" id="edit_bed_no" type="text" class="form-control-sm form-control">
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


    {{-- end of edit room modal @author:Ahatasham @date:13-03-2022 --}}
</section>

@endsection