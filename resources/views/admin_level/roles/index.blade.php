@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="font-weight: normal;font-size:16px;">Role List </h3>
                        @can('role-create')
                        <a href="{{ route('roles.create') }}" class="btn btn-info btn-round ml-auto btn-sm add_button_to_right">
                            <em class="fa fa-plus"></em> Add New Role</a>

                        @endcan
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Role Name</th>
                                    <th class="text-center justify-content-around">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($data['roles']))
                                @foreach ($data['roles'] as $key => $role)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{ $role->name }}</td>
                                    <td class="text-center">
                                        <div class="row form-button-action">
                                            <div class="col-6 text-right">
                                                @can('role-edit')

                                                <a class="btn btn-primary btn-xs" href="{{ route('roles.edit',$role->id) }}"><em class="fa fa-edit"></em></a>
                                                @endcan
                                            </div>

                                            <div class="col-6 text-left">
                                                @can('role-delete')
                                                <form action="{{ route('roles.destroy',$role->id) }}" method="post">
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
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

</section>

@endsection