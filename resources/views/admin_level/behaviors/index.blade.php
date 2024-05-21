@extends('layouts.master')
@section('content')

<section class="content">

    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-10">
                <div class="row card add_new_button_design mr-0">
                    <div class="">
                        @can('behavior-create')
                        <a href="" class="btn btn-info btn-round ml-auto btn-md add_button_to_right" data-toggle="modal" data-target="#modal-default">
                            <em class="fa fa-plus"></em> &nbsp; Add New Behavior</a> <br>
                        @endcan
                    </div>
                </div>
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <table id="behavior" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Behavior Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data['behavior_list']) && !empty($data['behavior_list']))
                                        @foreach($data['behavior_list'] as $behavior)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$behavior->behavior_name}}</td>
                                            <td class="text-center">
                                                <div class="row form-button-action">
                                                    <div class="col-6 text-right">
                                                        @can('behavior-edit')
                                                        <button type="button" data-toggle="tooltip" title="" class="edit_behavior btn  btn-info btn-xs " data-original-title="Edit Task" id="{{$behavior->id}}">
                                                            <em class="fa fa-edit"></em>
                                                        </button>
                                                        @endcan
                                                    </div>

                                                    <div class="col-6 text-left">
                                                        @can('behavior-delete')
                                                        <form action="{{ route('behaviors.destroy',$behavior->id) }}" method="post">
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

    <!---- behavior add modal ---------------------------------------------------->

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <p class="modal-title">Add New Behavior</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{route('behaviors.store')}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}

                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="row" id="unitTable">
                                    <div class="form-group">
                                        <label for="">Behavior Name</label>
                                        <input required="required" placeholder="Enter Behavior Name" class="form-control-sm form-control" id="" type="text" name="behavior_name[]">
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
    {{-- end of add behavior modal--}}

    {{-- begin edit behavior modal--}}

    <div id="edit_behavior_modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <p class="modal-title">Update Behavior</p>
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

                                    <label>Behavior Name</label>
                                    <input name="behavior_name" required="required" type="text" id="edit_behavior_name" class="form-control">
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
    {{-- end of edit behavior modal --}}
</section>

@endsection