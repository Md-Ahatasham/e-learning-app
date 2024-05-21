@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-10">
                <div class="row card add_new_button_design mr-0">
                    <div class="">
                        <a href="" class="btn btn-info btn-round ml-auto btn-md add_button_to_right" data-toggle="modal" data-target="#specialty-modal">
                            <em class="fa fa-plus"></em>&nbsp; Add New Speciality</a> <br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <table id="specialty" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Specialty</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data['specialty_list']) && !empty($data['specialty_list']))
                                        @foreach($data['specialty_list'] as $specialty)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$specialty->specialty_name}}</td>
                                            <td class="text-center">
                                                <div class="row form-button-action">
                                                    <div class="col-6 text-right">
                                                        <button type="button" data-toggle="tooltip" title="" class="edit_specialty btn  btn-info btn-xs " data-original-title="Edit Task" id="{{$specialty->id}}">
                                                            <em class="fa fa-edit"></em>
                                                        </button>
                                                    </div>

                                                    <div class="col-6 text-left">
                                                        <form action="{{ route('specialties.destroy',$specialty->id) }}" method="post">
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


    <!---- specialty add modal ---------------------------------------------------->

    <div class="modal fade" id="specialty-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <p class="modal-title">Add New Specialty</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('specialties.store')}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}

                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="row" id="unitTable">

                                    <div class="form-group">
                                        <label for="">Specialty Name</label>
                                        <input class="form-control-sm form-control" placeholder="Enter Specialty Name" type="text" required="required" name="specialty_name[]">
                                    </div>
                                </div>
                                <a class="add_button btn-sm btn-default add_more_button form-control" title="Add field"><em class="fas fa-plus add_icon"></em> Add More</a>
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
    <!-- /end of specialty add modal -------------->

    {{-- begin edit specialty modal @author:Ahatasham @date:13-03-2022 --}}

    <div id="edit_specialty_modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <p class="modal-title" style="font-size:16px;">Update Specialty</p>
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
                                    <label style="font-weight: normal;font-size:14px;">Specialty Name</label>
                                    <input name="specialty_name" required="required" type="text" id="edit_specialty_name" class="form-control">
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
    {{-- end of edit specialty modal @author:Ahatasham @date:13-03-2022 --}}
</section>

@endsection