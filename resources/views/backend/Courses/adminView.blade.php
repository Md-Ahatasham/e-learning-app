<table id="location" class="table table-bordered">
    <thead>
    <tr>
        <th>Serial</th>
        <th>Name</th>
        <th>Details</th>
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>

    @if(!empty($courseData = Auth::user()->role_id !== 1 ? $data['courseList']['courses'] : $data['courseList']))
        @foreach($courseData as $list)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$list->course_name ?? ""}}</td>
                <td>{{$list->course_details ?? ""}}</td>
                <td class="text-center">
                    <div class="row form-button-action">
                        <div class="col-4 text-right">
                            {{--                                                                @can('batch-edit')--}}
                            <button type="button" data-toggle="tooltip" title=""
                                    class="edit_course btn  btn-info btn-xs "
                                    data-original-title="Edit Task"
                                    id="{{$list->id}}">
                                <em class="fa fa-edit"></em> {{'Edit Course'}}
                            </button>
                            {{--                                                                @endcan--}}
                        </div>

                        <div class="col-4 text-left">
                            <a href="{{route('contents.getContentById',$list->id)}}" class="btn  btn-info btn-xs ">
                                <em class="fas fa-eye"></em> {{'View Content'}}
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>

</table>