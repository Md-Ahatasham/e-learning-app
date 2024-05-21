@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class=" p-3 mb-3">
                    <div class="row invoice-info">
                        <div class="col-md-11 offset-md-1 mt-2">
                            <div class="">
                                <img class="profile-user-img img-fluid img-circle" id="imgPreview" src="@if(!empty($data['rounder']['profile_photo'])) {{$data['rounder']['profile_photo']}} @else {{asset('dist/img/default_avatar.png')}} @endif" alt="rounder picture" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-11 offset-md-1 mt-2">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="row card">
                                    <div class="col-12 table-responsive">
                                        <table class="table" aria-describedby="table">
                                            <thead>
                                                <tr>
                                                    <th>General Information</th>
                                                    <th class="text-right general_information">
                                                        @can('rounder-edit')
                                                        <a href="{{route('rounders.edit',$data['rounder']['id'])}}" class="btn btn-md btn-info table-button">Update</a>
                                                        @endcan
                                                        <a href="" class="btn btn-md btn-warning table-button" style="min-width:100px;">Reset</a>
                                                        @can('rounder-status')
                                                        @if($data['rounder']['status'] == 1)
                                                        <a href="{{route('rounders.changeStatus',$data['rounder']['id'])}}" class="btn btn-md btn-danger table-button">{{'Deactivate'}}</a>
                                                        @endif
                                                        @if($data['rounder']['status'] == 0)
                                                        <a href="{{route('rounders.changeStatus',$data['rounder']['id'])}}" class="btn btn-md btn-danger table-button">{{'Activate'}}</a>
                                                        @endif
                                                        @endcan
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>First Name</td>
                                                    <td class="text-right">{{$data['rounder']['first_name']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Last Name</td>
                                                    <td class="text-right">{{$data['rounder']['last_name']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Date of Birth</td>
                                                    <td class="text-right">{{date('j F, Y h:i A',strtotime($data['rounder']['rounderInfo']['dob']))}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Employee Id</td>
                                                    <td class="text-right">{{$data['rounder']['user_code']}}</td>
                                                </tr>
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
</section>
@endsection