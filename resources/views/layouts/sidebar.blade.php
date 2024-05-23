<aside class="main-sidebar sidebar-dark-primary elevation-14 admin-sidebar">

    <div class="sidebar" style="margin-top: -1%">
        <div class="user-panel pb-3 mb-3 text-center">
            <div class="image">
                <img src="{{asset('dist/img/sidebar_logo.png')}}" class="img-circle" alt="RR">
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @if(Auth::user()->can('user-list') || Auth::user()->can('role-list') || Auth::user()->can('permission-list'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user"></i>
                            <p>
                                User Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('user-list')
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon sub_menu_icon_size"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                            @endcan

                            @can('role-list')
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon sub_menu_icon_size"></i>
                                        <p>User Role</p>
                                    </a>
                                </li>
                            @endcan

                            @can('permission-list')
                                <li class="nav-item">
                                    <a href="{{ route('permission.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon sub_menu_icon_size"></i>
                                        <p>Permission</p>
                                    </a>
                                </li>
                            @endcan


                        </ul>
                    </li>
                @endif

                @can('teacher-list')
                    <li class="nav-item">
                        <a href="{{ route('teachers.index') }}" class="nav-link">
                            <i class="fas fa-chart-bar"></i>
                            <p>
                                Teachers
                            </p>
                        </a>
                    </li>
                @endcan

                @can('student-list')
                    <li class="nav-item">
                        <a href="{{ route('students.index') }}" class="nav-link">
                            <i class="fas fa-chart-bar"></i>
                            <p>
                                Students
                            </p>
                        </a>
                    </li>
                @endcan


                @if(Auth::user()->can('user-list') || Auth::user()->can('location-list') || Auth::user()->can('role-list') || Auth::user()->can('behavior-list') || Auth::user()->can('affect-list'))
                <li class="nav-item has-treeview d-none">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        <p>
                            Admin
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        @can('user-list')

                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon sub_menu_icon_size"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        @endcan


                        @can('permission-list')
                        <li class="nav-item">
                            <a href="{{ route('permission.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon sub_menu_icon_size"></i>
                                <p>Permission</p>
                            </a>
                        </li>
                        @endcan
                        @can('role-list')
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon sub_menu_icon_size"></i>
                                <p>User Role</p>
                            </a>
                        </li>
                        @endcan


                        @can('location-list')
                        <li class="nav-item">
                            <a href="{{route('locations.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon sub_menu_icon_size"></i>
                                <p>Location</p>
                            </a>
                        </li>
                        @endcan
                        @can('unit-list')
                        <li class="nav-item">
                            <a href="{{route('units.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon sub_menu_icon_size"></i>
                                <p>Unit</p>
                            </a>
                        </li>
                        @endcan

                        <li class="nav-item">
                            <a href="{{route('rooms.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon sub_menu_icon_size"></i>
                                <p>Room</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('beds.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon sub_menu_icon_size"></i>
                                <p>Bed</p>
                            </a>
                        </li>

                        @can('behavior-list')
                        <li class="nav-item">
                            <a href="{{route('behaviors.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon sub_menu_icon_size"></i>
                                <p>behavior</p>
                            </a>
                        </li>
                        @endcan

                        @can('affect-list')
                        <li class="nav-item">
                            <a href="{{route('affects.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon sub_menu_icon_size"></i>
                                <p>Affect</p>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </li>
                @endif

                @can('report-list')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chart-bar"></i>
                            <p>
                                Reports
                            </p>
                        </a>
                    </li>
                @endcan

                @can('log-list')

                <li class="nav-item">
                    <a href="{{route('activityLogs.index')}}" class="nav-link">
                        <i class="fas fa-history"></i>
                        <p>
                            Activity logs
                        </p>
                    </a>
                </li>
                @endcan

                <li class="nav-item">
                    <a class="nav-link pl-3" href="{{ route('logout') }}" onclick="event.preventDefault();
    		      document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <p class="pl-1">
                            {{ __('Log Out') }}
                        </p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="form-hide">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper main-page-body">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5 class="m-0">{{$data['breadcrumb']['breadcrumb'] ?? ''}}</h5>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{$data['breadcrumb']['breadcrumb'] ?? ''}}</a></li>
                            <li class="breadcrumb-item active">{{$data['breadcrumb']['title'] ?? ''}}</li>
                        </ol>
{{--                        <p class="ml-3">--}}
{{--                            @include('layouts.notification')--}}
{{--                        </p>--}}
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->