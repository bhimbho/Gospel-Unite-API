@extends('layouts.app')

@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12 ">
                    <div class="page-title-box  ">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Welcome {{ Auth::user()->name }}!</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            <div class="row">
                <div class="col-xl-3">
                    <div class="card-box card-one">
                        <div class="float-left">
                            <i class="dripicons-user"></i>
                        </div>
                        <div class="widget-chart-one-content text-right" style="">
                            <p class=" mb-0 mt-2">Number of Users</p>
                            <h3 class="text-white">{{ $users }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card-box card-two">
                        <div class="float-left">
                            <i class="dripicons-document-new"></i>
                        </div>
                        <div class="widget-chart-one-content text-right" style="">
                            <p class=" mb-0 mt-2">Total Number of Books</p>
                            <h3 class="text-white">{{ $books }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card-box card-three">
                        <div class="float-left">
                            <i class="dripicons-headset"></i>
                        </div>
                        <div class="widget-chart-one-content text-right" style="">
                            <p class=" mb-0 mt-2">Number of Sermons</p>
                            <h3 class="text-white">{{ $songs }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card-box card-four">
                        <div class="float-left">
                            <i class="dripicons-camcorder"></i>
                        </div>
                        <div class="widget-chart-one-content text-right" style="">
                            <p class=" mb-0 mt-2">Total Number of Videos</p>
                            <h3 class="text-white">{{ $videos }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
    <style>
        .card-one{
            background: #2E31BE;
            color: #fff;
        }
        .card-two{
            background: #191A35;
            color: #fff;
        }
        .card-three{
            background: #FFA51D;
            color: #fff;
        }
        .card-four{
            background: #434AF9;
            color: #fff;
        }
    </style>
@endsection
