<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>E-learning | {{$data['breadcrumb']['title'] ?? ''}} </title>


    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/slick.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/slick-theme.min.css')}}">

    <link href="{{asset('krajee/css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
{{--    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous">--}}
    <link href="{{asset('krajee/themes/explorer-fa5/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/datepicker.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="{{asset('plugins/anothereditor.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/ionicons.css')}}">
{{--    <link rel="stylesheet" href="{{asset('css/fontawesome.css')}}">--}}


    <!-- Google Font: Source Sans Pro -->
{{--    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900' rel='stylesheet' type='text/css'>--}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('dist/img/favicon.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('dashboard')}}" class="nav-link">{{'Dashboard'}}</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item text-right">
                    @include('layouts.notification')
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <img src="{{asset(Auth::user()->profile_photo)}}" class="img-circle elevation-2 " style="width: 26px; height:26px;float:right" alt="{{asset('dist/img/avatar5.png')}}">
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <a href="{{route('users.profile')}}" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> {{'Profile'}}
                            <span class="float-right text-muted text-sm"></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="" class="dropdown-item" data-toggle="modal" data-target="#password-change-modal">
                            <i class="fas fa-envelope mr-2"></i> {{'Change Password'}}
                            <span class="float-right text-muted text-sm"></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="nav-link pl-3" href="{{ route('logout') }}" onclick="event.preventDefault();
    		                    document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt" style="padding-right:.5rem"></i>
                            {{ __('Log Out') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="form-hide">
                            @csrf
                        </form>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>


        </ul>
    </nav>
    <!-- /.navbar -->
    <!---- category add modal ---------------------------------------------------->

    <div class="modal fade" id="password-change-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cat_modal_header">
                    <h5 class="modal-title">Update Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <form id="updatePasswordForm">
                            <div class="form-group">
                                <label for="currentPassword">Current Password:</label>
                                <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                                <span class="error text-danger" id="currentPasswordError"></span>
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password:</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                                <span class="error text-danger" id="newPasswordError"></span>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm New Password:</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                <span class="error text-danger" id="confirmPasswordError"></span>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-info btn-sm text-right">Update</button>
                            </div>
                        </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /end of category add modal ------------------>