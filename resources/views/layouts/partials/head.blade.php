
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Gospel Unites -  Administrator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/FPI--Logo.png">
    <!-- DataTables -->
    <link href="{{asset('admin/libs/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/libs/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/libs/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/libs/datatables/select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />  -->
    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/libs/rwd-table/rwd-table.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/libs/dropify/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('admin/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/libs/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" />
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <style>
        .metismenu li a.active{
            background: #2E31BE !important;
            color: #fff !important;
        }
    </style>
</head>
<body>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar Start -->
        <div class="navbar-custom" style="background: #191A35">
            <ul class="list-unstyled topnav-menu float-right mb-0">
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{asset('admin/images/users/avatar-4.jpg')}}" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ml-1">
                            {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h6 class="m-0">
                                Welcome {{ Auth::user()->name }}!
                            </h6>
                        </div>
                        <a href="javascript:void(0);" class="dropdown-item notify-item">

                            {{-- <span>Logout</span> --}}
                            <a href="{{route('password.request')}}" class="dropdown-item notify-item">
                                Change Password
                            </a>
                            <a href="{{route('2FA')}}" class="dropdown-item notify-item">
                                2FA
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {!! __('  <i class="dripicons-power"></i> Logout') !!}
                                    </a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>

                    </div>
                </li>
            </ul>
            <ul class="list-unstyled menu-left mb-0">
                <li class="float-left">
                    <a href="index.html" class="logo">
                        <span class="logo-lg mt-0">
                            <img src="{{asset('admin/images/logo.png')}}" alt="" height="70">
                        </span>
                        <span class="logo-sm">
                            <img src="{{asset('admin/images/logo.png')}}" alt="" height="40">
                        </span>
                    </a>
                </li>
                <li class="float-left">
                    <a class="button-menu-mobile navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
