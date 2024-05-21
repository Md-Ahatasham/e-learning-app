@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-around body_padding_top">
            <div class="col-md-10">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card-header">
                        <h3 class="card-title" style="font-weight: normal;font-size:16px;">OK</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row text">
                            <div class="col-md-6 col-lg-6" style="border-right:1px solid black;">


                                <div class="form-group">
                                    Name:
                                    {{ $role->name }}
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    Role:
                                    <br />
                                    @if(!empty($rolePermissions))
                                    @foreach($rolePermissions as $v)
                                    <label class="label label-success">{{ $v->name }}
                                        @if(!($loop->last))
                                        ,
                                        @endif
                                    </label>
                                    <br />
                                    @endforeach
                                    @endif


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