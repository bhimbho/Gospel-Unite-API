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
                        <h4 class="page-title">Books</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="header-title">Add Books</h4>
                                <form method="post">
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
                                                <select class="form-control">
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
                                            <div id="editor">
                                            <textarea class="form-control" rows="5" style="resize: none">Book Description</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                                <label>Book Introduction</label>
                                            <textarea class="form-control" rows="5" style="resize: none">Book Introduction</textarea>
                                        </div> --}}
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                        </div>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title">Modify Books</h4>
                        <table id="datatable" class="table table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Book Image</th>
                                    <th>Book Title</th>
                                    <th>Book Author</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><img src="assets/images/background.jpg" width="100" height="100"></td>
                                    <td>Forgiving What You Can’t Forget</td>
                                    <td>Lysa Terkeurst</td>
                                    <td><a href="view-book.php" class="btn btn-primary">View</a> <a href="" class="btn btn-danger">Delete</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card-box -->
</div>
<script
$(()=>{
    $('.dropify').dropify()
})
</script>
@endsection


