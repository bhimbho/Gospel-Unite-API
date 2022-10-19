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
                            <div class="table-responsive" style="border: none">
                               <table id="datatable1" class="table table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Full Name</th>
                                        <th>Email Address</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Action</th>
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
</div>
</div> <!-- container -->
</div> <!-- content -->

@endsection
@section('scripts')
<script>
    $(function(){
        // $.fn.dataTable.ext.errMode = 'throw';
        var table = $('#datatable1').DataTable({
                processing: true,
                serverSide: true,
                ajax:"{{ route('user.index') }}",
                columns: [
                    
                    {data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    
                    {
                        data: 'fullname', 
                        name: 'fullname', 
                       
                        "orderable": true,
                        "searchable": true
                    },
                    {data: 'email', name:'email'},
                    {data: 'gender', name: 'gender'},
                    {data: 'phone', name: 'phone'},
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: true, 
                        searchable: true
                    }
                ],
                
            });
        // $('.error_alert').hide();


        // Ajax Suspend Button

        $('#datatable1').on('click','.suspend',function(e){
                    e.preventDefault();
                    var suspend_id = $(this).data('id');
                   
                    $.ajax({
                        url: "user_suspend/"+suspend_id,
                        data: {},
                        method: "GET",
                    })
                    .done(function (response) {
                        // console.log(response);
                        table.ajax.reload();
                        $('.error_list').append(onsuccess(response));
                    });
                    // console.log('hi');
        });

           
            
            
             
        });
    </script>
@endsection