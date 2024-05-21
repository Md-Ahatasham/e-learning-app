@extends('layouts.master')
@section('content')

<section class="content">

    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-10">
                <div class="row card add_new_button_design mr-0">
                    <div class="">
                        @can('location-create')
                        <a href="" class="btn btn-info btn-round ml-auto btn-md add_button_to_right" data-toggle="modal" data-target="#modal-default">
                            <em class="fa fa-plus"></em> &nbsp; Add New Location</a> <br>
                        @endcan
                    </div>
                </div>
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activitys">
                                <table id="location" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data['location_list']) && !empty($data['location_list']))
                                        @foreach($data['location_list'] as $location)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$location->name}}</td>
                                            <td class="text-center">
                                                <div class="row form-button-action">
                                                    <div class="col-6 text-right">
                                                        @can('location-edit')
                                                        <button type="button" data-toggle="tooltip" title="" class="edit_location btn  btn-info btn-xs " data-original-title="Edit Task" id="{{$location->id}}">
                                                            <em class="fa fa-edit"></em>
                                                        </button>
                                                        @endcan
                                                    </div>

                                                    <div class="col-6 text-left">
                                                        @can('location-delete')
                                                        <form action="{{ route('locations.destroy',$location->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete ?')"><em class='fas fa-trash-alt'></em> </button>
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
    </div>
    </div>
    </div>

    <!---- location add modal ---------------------------------------------------->

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <p class="modal-title">Add New Location</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{route('locations.store')}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}

                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="row" id="unitTable">
                                    <div class="form-group">
                                        <label for="">Location Name</label>
                                        <input required="required" placeholder="Enter Location Name" class="form-control-sm form-control" id="" type="text" name="name[]">
                                    </div>
                                </div>
                                <a class="add_button btn-sm btn-default add_more_button form-control" title="Add field"><em class="fas fa-plus add_icon"></em> </a>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="col-6 text-center">
                        <span><a data-dismiss="modal" aria-label="Close" class="btn btn-danger cancel-button btn-md text-left">Cancel&nbsp;<span class="glyphicons glyphicons-circle_minus"></span></a></span>
                        <span><input type="submit" class="btn btn-info btn-md text-right" value="Save"><span class="glyphicons glyphicons-circle_plus"></span></button></span>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end of add location modal--}}

    {{-- begin edit location modal--}}

    <div id="edit_location_modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <p class="modal-title">Update Location</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="frm" id="frm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group form-group-default">

                                    <label>Location Name</label>
                                    <input name="name" required="required" type="text" id="edit_location_name" class="form-control">
                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <span><a data-dismiss="modal" aria-label="Close" class="btn btn-danger cancel-button btn-md text-left">Cancel&nbsp;<span class="glyphicons glyphicons-circle_minus"></span></a></span>
                    <input type="submit" class="btn btn-info btn-md " value="Update">
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    {{-- end of edit location modal --}}
</section>

@endsection