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
                            <h4 class="header-title">Modify User Details</h4>
                            <p>View or Delete User Details</p>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <table class="table">

                                        <tr>
                                            <th>Fullname</th>
                                            <td>{{ $user->fullname }}</td>
                                        </tr>

                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $user->status == 1 ? 'Active' : 'Not Active' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td>{{ $user->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td>{{ $user->gender }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nationality</th>
                                            <td>{{ $user->nationality }}</td>
                                        </tr>
                                    </table>


                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target=".bd-update-user{{ $user->id }}">Update Phone</button>

                                    <div class="modal fade bd-update-user{{ $user->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">User</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{route('user.phone.update', $user->id)}}">
                                                    @csrf
                                                    @method('patch')
                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            <div class="mb-3">
                                                                <input type="text" name="phone" value="{{$user->phone}}" class="form-control">
                                                            </div>
                                                        </div>


                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                                </form>
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
    </div> <!-- container -->
    </div> <!-- content -->
@endsection
