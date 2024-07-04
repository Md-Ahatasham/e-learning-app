@extends('layouts.master')
@section('content')
    @php
        class BanglaConverter {
            public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
            public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

            public static function bn2en($number) {
                return str_replace(self::$bn, self::$en, $number);
            }

            public static function en2bn($number) {
                return str_replace(self::$en, self::$bn, $number);
            }
        }
    @endphp
    <style>
        .highcharts-root .highcharts-title{
            font-size: 14px;
        }
        .highcharts-credits{
            display: none;
        }
        .body_padding_top{
            padding-top:2%;
        }
        @media (min-width: 1140px) {

            .col-md-7 {
                max-width: 55.333%;
            }
        }
    </style>
    @php $all_data = []; @endphp
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row justify-content-around body_padding_top">
                <div class="col-md-2">
                    <div class="row justify-content-around body_padding_top" style="padding-top:10%;">

                        <div class="col-12 col-sm-6 col-md-12" style="margin-bottom:20%;">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="far fa-bookmark"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"> {{'Courses'}}</span>
                                    <span class="info-box-number">
                                        {{Count($data['statisticalInfo'])}}
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-12" style="margin-bottom:20%;">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><i class="far fa-bookmark"></i></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"> {{'Students'}} </span>
                                    <span class="info-box-number">
                                        @php
                                             $totalStudents = 0;
                                             $totalContents = 0;
                                             $totalBatches = 0
                                        @endphp
                                        @foreach($data['statisticalInfo'] as $count)
                                            @php $totalStudents = $totalStudents + $count['user_count'] @endphp
                                            @php $totalContents = $totalContents + $count['contents_count'] @endphp
                                            @php $totalBatches = $totalBatches + $count['batch_count'] @endphp
                                        @endforeach
                                        {{$totalStudents}}
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-12" style="margin-bottom:20%;">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i class="far fa-bookmark"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"> {{'Contents'}} </span>
                                    <span class="info-box-number"> {{$totalContents}} </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-12" style="margin-bottom:20%;">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{'Batches'}}</span>
                                    <span class="info-box-number"> {{$totalBatches}} </span>

                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </div>
                </div>

                <div class="col-md-10">

                    <div class="row justify-content-around body_padding_top">

                        <div class="col-12 col-sm-12 col-md-11" style="box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);">
                            <h5 class="text-center" style="font-size: 15px;padding:1%;">{{'Course wise all information'}}


                            </h5>
                            <figure class="highcharts-figure">
                                <div id="allInfo"></div>
                            </figure>
                        </div>

                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection