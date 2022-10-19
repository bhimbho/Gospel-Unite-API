@extends('layouts.app')

@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">View Users</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title">View User Details</h4>
                        <hr>
                        <!-- <p>View or Delete User Details</p> -->
                        <div class="row mt-4 d-flex align-items-center">
                           <div class="col-md-2">
                                <img src="{{asset('admin/images/users/avatar-4.jpg')}}" alt="" class="rounded-circle">                 
                            </div>
                            <div class="col-md-9 pl-0">
                                <h2>{{ $users->fullname }}</h2>
                                <h4>{{ $users->email }}</h4> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                    <div class="row">
                            <div class="col-md-12 profile">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active font-weight-bold" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Favourite Books</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Favourite Music</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Favourite Videos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" id="activities-tab" data-toggle="tab" href="#activities" role="tab" aria-controls="activities" aria-selected="false">Activities</a>
                                </li>
                                </ul> 
                                <div class="tab-content" id="myTabContent">
                                     <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>S/N</th>
                                                <th>Book Name</th>
                                                <th>Book Author</th>
                                                <th>Book Tags</th>
                                                <th>Book Progress</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>The Chronicles of Riddick</td>
                                                <td>Vin Diesel</td>
                                                <td>Kindness, Joy, Happiness</td>
                                                <td>46%</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>The Chronicles of Riddick</td>
                                                <td>Vin Diesel</td>
                                                <td>Kindness, Joy, Happiness</td>
                                                <td>46%</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>The Chronicles of Riddick</td>
                                                <td>Vin Diesel</td>
                                                <td>Kindness, Joy, Happiness</td>
                                                <td>46%</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <table class="table table-striped">
                                            <tr>
                                                <th>S/N</th>
                                                <th>Music Title</th>
                                                <th>Music Artist</th>
                                                <th>Music Tags</th>
                                                <th>Music Type</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Mercy</td>
                                                <td>Vin Diesel</td>
                                                <td>Kindness, Joy, Happiness</td>
                                                <td>Single</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>The Chronicles of Riddick</td>
                                                <td>Vin Diesel</td>
                                                <td>Kindness, Joy, Happiness</td>
                                                <td>Album</td>

                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>The Chronicles of Riddick</td>
                                                <td>Vin Diesel</td>
                                                <td>Kindness, Joy, Happiness</td>
                                                <td>Album</td>

                                            </tr>
                                        </table>
                                    </div>
                                     <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <table class="table table-striped">
                                            <tr>
                                                <th>S/N</th>
                                                <th>Video Title</th>
                                                <th>Video Author</th>
                                                <th>Video Tags</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>The Chronicles of Riddick</td>
                                                <td>Vin Diesel</td>
                                                <td>Kindness, Joy, Happiness</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>The Chronicles of Riddick</td>
                                                <td>Vin Diesel</td>
                                                <td>Kindness, Joy, Happiness</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>The Chronicles of Riddick</td>
                                                <td>Vin Diesel</td>
                                                <td>Kindness, Joy, Happiness</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="activities" role="tabpanel" aria-labelledby="activities-tab">
                                    <table class="table table-striped">
                                            <tr>
                                                <th>S/N</th>
                                                <th>Activities</th>
                                                <th>Date/Time</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>The Chronicles of Riddick</td>
                                                <td>04/01/2020 12:00:00pm</td>
                                            </tr>
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div> <!-- end card-box -->
    </div>
</div>
<style>
    .profile .nav-tabs .nav-item .nav-link.active, .profile .nav-tabs .nav-item .nav-link:hover{
        border: none;
        border-bottom: 3px solid #2E31BE !important;
    }
</style>
@endsection

