@extends('layouts.master')
@section('content')

<section class="content">

    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-10">
                <div class="row card add_new_button_design mr-0">
                    <div class="">
                        @can('unit-create')
                        <a href="" class="btn btn-info btn-round ml-auto btn-md add_button_to_right" data-toggle="modal" data-target="#modal-default">
                            <em class="fa fa-plus"></em> &nbsp; Add New Unit</a> <br>
                        @endcan
                    </div>
                </div>
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <table id="unit" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data['unit_list']) && !empty($data['unit_list']))
                                        @foreach($data['unit_list'] as $unit)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$unit->name}}</td>
                                            <td class="text-center">
                                                <div class="row form-button-action">
                                                    <div class="col-6 text-right">
                                                        @can('unit-edit')
                                                        <button type="button" data-toggle="tooltip" title="" class="edit_unit btn  btn-info btn-xs " data-original-title="Edit Task" id="{{$unit->id}}">
                                                            <em class="fa fa-edit"></em>
                                                        </button>
                                                        @endcan
                                                    </div>

                                                    <div class="col-6 text-left">
                                                        @can('unit-delete')
                                                        <form action="{{ route('units.destroy',$unit->id) }}" method="post">
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

    <!---- unit add modal ---------------------------------------------------->

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <p class="modal-title">Add New Unit</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{route('units.store')}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}

                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="row" id="unitTable">
                                    <div class="form-group">
                                        <label for="">Unit Name</label>
                                        <input required="required" placeholder="Enter Unit Name" class="form-control-sm form-control" id="" type="text" name="name[]">
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
    {{-- end of add unit modal--}}

    {{-- begin edit unit modal--}}

    <div id="edit_unit_modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <p class="modal-title">Update Unit</p>
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

                                    <label>Unit Name</label>
                                    <input name="name" required="required" type="text" id="edit_unit_name" class="form-control">
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
    {{-- end of edit unit modal --}}
</section>

@endsection