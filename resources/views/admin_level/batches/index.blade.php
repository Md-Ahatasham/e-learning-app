@extends('layouts.master')
@section('content')

    <section class="content">

        <div class="container-fluid">
            <div class="row justify-content-around body_padding_top">
                <div class="col-md-10">
                    <div class="row card add_new_button_design mr-0">
                        <div class="">
{{--                            @can('batch-create')--}}
                                <a href="" class="btn btn-info btn-sm btn-round ml-auto add_button_to_right" data-toggle="modal" data-target="#modal-default">
                                    <em class="fa fa-plus"></em> &nbsp; Add New Batch</a> <br>
{{--                            @endcan--}}
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
                                        @if(!empty($data['batchList']))
                                            @foreach($data['batchList'] as $list)
                                                <tr>
                                                    <td>{{$loop->index+1}}</td>
                                                    <td>{{$list->batch_name ?? ""}}</td>
                                                    <td class="text-center">
                                                        <div class="row form-button-action">
                                                            <div class="col-6 text-right">
{{--                                                                @can('batch-edit')--}}
                                                                    <button type="button" data-toggle="tooltip" title="" class="edit_batch btn  btn-info btn-xs " data-original-title="Edit Task" id="{{$list->id}}">
                                                                        <em class="fa fa-edit"></em>
                                                                    </button>
{{--                                                                @endcan--}}
                                                            </div>

                                                            <div class="col-6 text-left">
{{--                                                                @can('batch-delete')--}}
                                                                    <form action="{{ route('batches.destroy',$list->id) }}" method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete ?')"><em class='fas fa-trash-alt'></em> </button>
                                                                    </form>
{{--                                                                @endcan--}}
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

        <!----Batch add modal ---------------------------------------------------->

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header cat_modal_header">
                        <p class="modal-title">Add New Batch</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{route('batches.store')}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}

                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="row" id="unitTable">
                                        <div class="form-group">
                                            <label for="">Batch Name</label>
                                            <input required="required" placeholder="Enter Batch Name" class="form-control-sm form-control" id="" type="text" name="batch_name[]">
                                        </div>
                                    </div>
                                    <a class="add_button btn-sm btn-default add_more_button form-control" title="Add field"><em class="fas fa-plus add_icon"></em> </a>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <div class="col-6 text-center">
                            <span><a data-dismiss="modal" aria-label="Close" class="btn-sm btn btn-danger cancel-button text-left">Cancel&nbsp;<span class="glyphicons glyphicons-circle_minus"></span></a></span>
                            <span><input type="submit" class="btn btn-sm btn-info text-right" value="Save"><span class="glyphicons glyphicons-circle_plus"></span></button></span>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end of add batch modal--}}

       @include('admin_level.batches.edit')
        </div>

    </section>

@endsection