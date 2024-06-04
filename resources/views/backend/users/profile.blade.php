@extends('layouts.master')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{asset($data['userDetails']['result']['profile_photo'])}}" alt="profile pic">
                            </div>
                            <h3 class="profile-username text-center">{{$data['userDetails']['result']['first_name'].' '. $data['userDetails']['result']['last_name']}}</h3>
                            <p class="text-muted text-center">{{Auth::user()->getRoleNames()->first()}}</p>
                        </div>

                    </div>


                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>

                        <div class="card-body">
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> {{'Email'}}</strong>
                            <p class="text-muted">{{$data['userDetails']['result']['email']}}</p>
                            <hr>
                            <strong><i class="fas fa-pencil-alt mr-1"></i> {{'Skills'}}</strong>
                            <p class="text-muted">
                                <span class="tag tag-danger">{{$data['userDetails']['result']['speciality'] ?? ""}}</span>

                            </p>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                        </div>

                    </div>

                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <div class="row">
                                <div class="col-md-6">{{'Details'}}</div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('users.editProfile',Auth::user()->id)}}" class="btn btn-info btn-sm">{{'Update Profile'}}</a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="active tab-pane" id="timeline">

                                    <div class="timeline timeline-inverse">
                                        <div>
                                            <i class="fas fa-comments bg-warning"></i>
                                            <div class="timeline-item">
                                                <span class="time"> </span>
                                                <h3 class="timeline-header">{{'SSC Information'}}</h3>
                                                <div class="timeline-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <ul style="float:right">
                                                                <li>{{'Org Name: '.$data['userDetails']['educationalQualification']['ssc_org_name'] ??  ""}}</li>
                                                                <li>{{'Board: '.$data['userDetails']['educationalQualification']['ssc_board'] ??  ""}}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <ul>
                                                                <li>{{'Passing Year: '.$data['userDetails']['educationalQualification']['ssc_passing_year'] ??  ""}}</li>
                                                                <li>{{'GPA: '.$data['userDetails']['educationalQualification']['ssc_gpa'] ??  ""}}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-footer">
{{--                                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>--}}
                                                </div>
                                            </div>
                                        </div>


                                        <div>
                                            <i class="fas fa-comments bg-warning"></i>
                                            <div class="timeline-item">
                                                <span class="time"> </span>
                                                <h3 class="timeline-header">{{'HSC Information'}}</h3>
                                                <div class="timeline-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <ul style="float:right">
                                                                <li>{{'Org Name: '.$data['userDetails']['educationalQualification']['hsc_org_name'] ??  ""}}</li>
                                                                <li>{{'Board: '.$data['userDetails']['educationalQualification']['hsc_board'] ??  ""}}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <ul>
                                                                <li>{{'Passing Year: '.$data['userDetails']['educationalQualification']['hsc_passing_year'] ??  ""}}</li>
                                                                <li>{{'GPA: '.$data['userDetails']['educationalQualification']['hsc_gpa'] ??  ""}}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-footer">
{{--                                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>--}}
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <i class="fas fa-comments bg-warning"></i>
                                            <div class="timeline-item">
                                                <span class="time"></span>
                                                <h3 class="timeline-header">{{'Graduation Information'}}</h3>
                                                <div class="timeline-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <ul style="float:right">
                                                                <li>{{'Org Name: '.$data['userDetails']['educationalQualification']['honors_org_name'] ??  ""}}</li>
                                                                <li>{{'Board: '.$data['userDetails']['educationalQualification']['honors_board'] ??  ""}}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <ul>
                                                                <li>{{'Passing Year: '.$data['userDetails']['educationalQualification']['honors_passing_year'] ??  ""}}</li>
                                                                <li>{{'GPA: '.$data['userDetails']['educationalQualification']['honors_gpa'] ??  ""}}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-footer">
                                                    {{--                                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>--}}
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <i class="fas fa-comments bg-warning"></i>
                                            <div class="timeline-item">
                                                <span class="time"></span>
                                                <h3 class="timeline-header">{{'Post Graduation Information'}}</h3>
                                                <div class="timeline-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <ul style="float:right">
                                                                <li>{{'Org Name: '.$data['userDetails']['educationalQualification']['masters_org_name'] ??  ""}}</li>
                                                                <li>{{'Board: '.$data['userDetails']['educationalQualification']['masters_board'] ??  ""}}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <ul>
                                                                <li>{{'Passing Year: '.$data['userDetails']['educationalQualification']['masters_passing_year'] ??  ""}}</li>
                                                                <li>{{'GPA: '.$data['userDetails']['educationalQualification']['masters_gpa'] ??  ""}}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-footer">
                                                    {{--                                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>--}}
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <i class="fas fa-camera bg-purple"></i>
                                            <div class="timeline-item">
                                                <span class="time"></span>
                                                <h3 class="timeline-header">{{'All Certifications'}}</h3>
                                                <div class="timeline-body">
                                                    <img src="{{$data['userDetails']['educationalQualification']['ssc_certificate'] ?? ''}}"  style="width: 250px; height: 200px" alt="...">
                                                    <img src="{{$data['userDetails']['educationalQualification']['hsc_certificate'] ?? ''}}"  style="width: 250px; height: 200px" alt="...">
                                                    <img src="{{$data['userDetails']['educationalQualification']['honors_certificate'] ?? ''}}"  style="width: 250px; height: 200px" alt="...">
                                                    <img src="{{$data['userDetails']['educationalQualification']['masters_certificate'] ?? ''}}"  style="width: 250px; height: 200px" alt="...">
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
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