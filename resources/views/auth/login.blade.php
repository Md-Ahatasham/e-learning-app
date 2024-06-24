@extends('layouts.app')

@section('content')

    <div class="form-bg">
        <div class="container">
            <div class="row" style="float: left;margin-top: 10%;margin-left: 20%">
                <div class="col-md-12 col-sm-12">
                    <div class="form-container">
                        <h3 class="title">{{__('Aquariende Course Management System')}}</h3>
                        <div class="">
                            <img src="{{asset('dist/img/logo.png')}}"
                                 style="border-radius: 50%;width: 50%;margin-bottom: 5%;border: 1px solid lightgray;" />
                        </div>
                        <span class="description"></span>
                        <form method="POST" action="{{ route('login') }}" class="form-horizontal">
                            @csrf

                            <div class="form-group">

                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong style="color:red; font-size: 10px;">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color:red; font-size: 10px;">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button class="btn signin">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
