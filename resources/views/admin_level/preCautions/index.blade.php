@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-10">
                <div class="row card add_new_button_design mr-0">
                    <div class="">
                        @can('precaution-create')
                        <a href="{{ route('precautions.create') }}" class="btn btn-info btn-round ml-auto btn-md add_button_to_right">
                            <em class="fa fa-plus"></em> &nbsp; Add New Precaution</a> <br>
                        @endcan
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <table id="precaution" aria-describedby="precaution" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>PreCaution Name</th>
                                            <th>Abbreviation</th>
                                            <th>Color</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data['precaution_list']) && !empty($data['precaution_list']))
                                        @foreach($data['precaution_list'] as $precaution)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$precaution->pre_caution_name}}</td>
                                            <td>{{$precaution->abbreviation}}</td>
                                            <td style="background:{{$precaution->color_code}}"></td>
                                            <td class="text-center">
                                                <div class="row form-button-action">
                                                    <div class="col-6 text-right">
                                                        @can('precaution-edit')
                                                        <a href="{{route('precautions.edit',$precaution->id)}}" type="button" data-toggle="tooltip" title="" class="edit_specialty btn  btn-info btn-xs " data-original-title="Edit Task">
                                                            <em class="fa fa-edit"></em>
                                                        </a>
                                                        @endcan
                                                    </div>

                                                    <div class="col-6 text-left">
                                                        @can('precaution-delete')
                                                        <form action="{{ route('precautions.destroy',$precaution->id) }}" method="post">
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

</section>

@endsection