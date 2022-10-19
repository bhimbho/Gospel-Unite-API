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
                                <li class="breadcrumb-item active">2FA</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Settings</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="header-title">2FA Authentication</h4>
                                <div class="card">
                                    {{-- <div class="card-title"> 
                                        Set Up Google Authentication
                                    </div> --}}
                                    <div class="card-body"> 
                                        <div>Setup your 2FA by scanning the barcode below. 
                                            {{-- Alternatively, you can use the code {{$security_code}}  --}}
                                        </div>
                                        {!!$g!!}
                                    </div>
                                </div>
                               
                                {{-- <form method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="col-md-4 offset-md-4">
                                            <div class="form-group">
                                                <label class="text-center">Book Image</label>
                                                <input type="file" name="" class="form-control dropify">
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Book Name/Title</label>
                                                <input type="text" name="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Book Author</label>
                                                <input type="text" name="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Book Tags</label>
                                                <select class="form-control selectpicker"  multiple data-selected-text-format="count > 5" data-style="btn-light">
                                                    <option>--Select Tags--</option>
                                                    <option>Prosperity</option>
                                                    <option>Love</option>
                                                    <option>Kindness</option>
                                                    <option>Hope</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                <label>Book Description</label>
                                            <textarea class="form-control" rows="5" style="resize: none">Book Description</textarea>
                                        </div>
                                        <div class="col-md-6">
                                                <label>Book Introduction</label>
                                            <textarea class="form-control" rows="5" style="resize: none">Book Introduction</textarea>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                        </div>
                                        </div>

                                    </div>

                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
             
            </div>
        </div>
    </div> <!-- end card-box -->
</div>
<script>
    $(()=>{
        $('.dropify').dropify()
    })
</script>
@endsection



