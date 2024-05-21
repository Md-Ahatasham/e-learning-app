@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-12">
               
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane table-responsive" id="activitys">
                                <table id="assignRounder" aria-describedby="patienttable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Tablet In Use</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data['rounderInfo']) && !empty($data['rounderInfo']))
                                        @foreach($data['rounderInfo'] as $rounder)

                                        <tr>
                                            <td><img class="patient_image rounded-circle" alt="user_avatar" src="{{$rounder->profile_photo}}" /></td>
                                            <td>{{ $rounder->first_name.' '.$rounder->last_name }}</td>
                                            <td>{{ $rounder['rounderInfo']['assign_tab'] }}</td>
                                            <td>{{ 'Online' }}</td>
                                            <td>
                                                <form action="{{ route('patients.assign') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="status" value="2" />
                                                    <input type="hidden" name="patient_id" value="{{$data['patientInfo']['id']}}" />
                                                    <input type="hidden" name="entry_by" value="{{$data['patientInfo']['entry_by']}}" />
                                                    <input type="hidden" name="assign_rounder_id" value="{{$rounder->id}}" />
                                                    <button type="submit" class="btn btn-info btn-md">Assign</button>
                                                </form>
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