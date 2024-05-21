@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-11">
                <div class="row card add_new_button_design mr-0">
                    <div class="">
                        @can('rounder-create')
                        <a href="{{ route('rounders.create') }}" class="btn btn-info btn-round ml-auto btn-md add_button_to_right">
                            <em class="fa fa-plus"></em> &nbsp; Add New Rounder</a> <br>
                        @endcan
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <table id="roundertable" aria-describedby="roundertable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Employee Id</th>
                                            <th>Date of Birth</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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