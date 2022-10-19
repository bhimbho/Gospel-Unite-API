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
                        <h4 class="page-title">Users Activity</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                       <span class="badge badge-success"> Users Recently Joined (7days default)</span><hr>
                       <form action="" method="get" id="join_search_form">
                            <div class="row">
                                <div class="col-auto">
                                    <label for="">From</label>
                                    <input type="date" name="from" id="from" class="form-control" id="">
                                </div>
                                <div class="col-auto">
                                    <label for="">To</label>
                                    <input type="date" name="to" id="to" class="form-control">
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-dark mt-3" id="joined_search">Search</button>
                                </div>
                            </div>
                       </form>
                        </div>
                        <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title">Modify Books</h4>
                        <table id="datatable1" class="table table-bordered wrap">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>FUll Name</th>
                                    <th>Email</th>
                                    <th>Date Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card-box -->
</div>


@endsection
@section('scripts')
<script>
    $(()=>{
        $('.dropify').dropify();
    });
</script>
    <script>
         $(()=>{
            // $.fn.dataTable.ext.errMode = 'throw';
        var table = $('#datatable1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('recently-joined.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {
                        data: 'fullname', 
                        name: 'fullname', 
                        "orderable": true,
                        "searchable": true
                    },
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                    
                ],
                
            });

            // ------------------ end table display ---------------------------

            //------------------------------ add book event ---------------------------------------
            $('#joined_search').click(function(e){
            e.preventDefault();
            var to = $('#to').val();
            var from = $('#from').val();
            var table = $('#datatable1').DataTable({
                processing: true,
                serverSide: true,
                destroy:true,
                // ajax: "{{ Route('recently-joined.search',["+from+","+to+"]) }}",
                
                ajax: "recently-joined/"+from+"/"+to,
                // alert(data);
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', 'orderable':false, 'searchable':false },
                    {
                        data: 'fullname', 
                        name: 'fullname', 
                        "orderable": true,
                        "searchable": true
                    },
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                    
                ],
            });
            
                
        });
        // ------------------------------ end -------------------------------------------------------



        
         });
    </script>
@endsection


