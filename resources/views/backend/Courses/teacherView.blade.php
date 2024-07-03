 <div class="row">
        @foreach($data['courseList']['courses'] as $list)
            <!-- /.col -->
            <div class="col-md-4">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username"><strong>{{$list->course_name}}</strong></h3>
                        <h5 class="widget-user-desc">
                            <a href="{{route('contents.getContentById',$list->id)}}" class="btn btn-sm btn-info">
                                <em class="fa fa-eye"></em> {{'View Content'}}
                            </a>
                        </h5>
                    </div>
                    <div class="widget-user-image">
                        <a href="{{route('contents.prepareContent',$list->id)}}">
                            <div class="" style="border:1px solid black;border-radius: 50%; padding:14%;width:82%;height:87px;background: ghostwhite">
                                <em class="fas fa-plus"></em> {{'Add Content'}}
                            </div>
                        </a>
                    </div>
                    <div class="card-footer">
                        @foreach($data['courseWiseCount'] as $count)
                            @if($count['id'] == $list['id'])

                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{$count['user_count']}} </h5>
                                    <span class="description-text">{{'Students'}}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{$count['contents_count']}}</h5>
                                    <span class="description-text">{{'Contents'}}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">{{$count['batch_count']}}</h5>
                                    <span class="description-text">{{'Batches'}}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
            <!-- /.col -->

            <!-- /.col -->

        @endforeach
    </div>