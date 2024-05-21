@extends('layouts.master')
@section('content')
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-11">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">User List </h4>
                        @can('user-create')
                        <a href="" class="btn btn-info btn-round ml-auto btn-sm add_button_to_right" data-toggle="modal" data-target="#modal-xl"><em class="fa fa-plus"></em> Add New</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" aria-describedby="table">
                            <thead>
                                <tr>
                                    <th>Picture</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Employee ID</th>
                                    <th>Email</th>
                                    <th class="text-center justify-content-around">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($data['users']))
                                @foreach ($data['users'] as $user)
                                <tr>
                                    <td><img class="patient_image rounded-circle" alt="user_avatar" src="{{$user->profile_photo}}" /></td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->user_code }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-center">
                                        <div class="row form-button-action">

                                            <div class="col-6 text-right">
                                                @can('user-edit')
                                                    @if((Auth::user()->roles->first()->name !== "Admin") && (Auth::user()->id == $user->id))
                                                        <a class="edit_user btn btn-primary btn-xs" id="{{$user->id}}"><em class="fa fa-edit"></em></a>
                                                    @endif
                                                    @if(Auth::user()->roles->first()->name == "Admin")
                                                        <a class="edit_user btn btn-primary btn-xs" id="{{$user->id}}"><em class="fa fa-edit"></em></a>
                                                    @endif
                                                @endcan
                                            </div>

                                            <div class="col-6 text-left">
                                                @can('user-delete')
                                                <form action="{{ route('users.destroy',$user->id) }}" method="post">
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
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>


    {{-- start of user add modal --}}

    @include('admin_level.users.create')


    {{-- start of user edit modal --}}

     @include('admin_level.users.edit')

</section>

@endsection