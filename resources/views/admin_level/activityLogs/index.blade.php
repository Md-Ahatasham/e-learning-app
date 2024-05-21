@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="font-weight: normal;font-size:16px;">User's activity log</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                    <th>Details</th>
                                    <th>IP</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($users_log) && !empty($users_log))
                                @foreach ($users_log as $key => $ulog)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{ $ulog['userInfo']['first_name'].' '.$ulog['userInfo']['last_name'] }}</td>
                                    <td style="word-break: break-all;">{{ $ulog->url }} </td>
                                    <td style="word-break: break-all;">{{ serialize(json_decode($ulog->body)) }}</td>
                                    <td>{{ $ulog->ip }}</td>
                                    <td>{{ $ulog->created_at }}</td>
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