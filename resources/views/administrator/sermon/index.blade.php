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
                        <h4 class="page-title">Sermon</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="error_list">

                                </div>
                                <h4 class="header-title">Add Sermon</h4>
                            </div>
                            <div class="col-md-12">
                                <form method="post" id="form-submit" enctype="multipart/form-data">
                                   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sermon Title</label>
                                            <input type="text" name="title" id="title" class="form-control">
                                        </div>
                                    </div>
                                   
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                            <button type="submit" id="submit" class="btn btn-primary btn-block">Submit</button> 
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
                        <h4 class="header-title">Modify Sermon</h4>
                        <table id="datatable1" class="table table-bordered wrap" width="100%">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Sermon</th>
                                    {{-- <th>Action</th> --}}
                                    
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

{{-- Edit Modal --}}
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Sermon</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Sermon Title</label>
              <input type="text" class="form-control title" value="">
            </div>
            <div class="form-group">
            <button type="button" id="sermon_update" class="btn btn-primary btn-block">Update Sermon</button></div>
          </form>
        </div>
      </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
    $(function(){
        // $.fn.dataTable.ext.errMode = 'throw';
        var table = $('#datatable1').DataTable({
                processing: true,
                serverSide: true,
                ajax:"{{ route('sermon.index') }}",
                columns: [
                    
                    {data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    
                   
                    {name: 'title', data:'title', orderable: true, searchable: true},
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: true, 
                        searchable: true
                    }
                   
                    
                ],
                
            });
        // $('.error_alert').hide();
        $('#form-submit').submit(function(e){
            e.preventDefault();
            var error_display= "";
            

            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "/sermon",
                data:  new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                enctype: 'multipart/form-data',
            })
            .done(function( msg ) {
                
                    $('.error_list').append(onsuccess(msg));
                    table.ajax.reload();
                    $('#sermon_form')[0].reset();
                        // console.log(msg)


            })
            .fail(function( msg ) {
                
                    $('.error_list').append(onfail(msg));
                    // console.log(msg)
                });
                
            });

        // Ajax Delete Button

        $('#datatable1').on('click','.form_delete',function(e){
                    e.preventDefault();
                    var delete_id = $(this).data('id');
                    // alert(delete_id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "sermon/"+delete_id,
                        data: {'_method': 'DELETE'},
                        method: "POST",
                    })
                    .done(function (response) {
                        table.ajax.reload();
                        $('.error_list').append(onsuccess(response));
                    });
                    // console.log('hi');
        });

        // Edit event and data fetch
        $('#datatable1').on('click','.edit',function(e){
                    e.preventDefault();
                    var sermon_id = $(this).data('id');
                    $.ajax({
                        url: "sermon/"+sermon_id+"/edit",
                        data: {},
                        method: "GET",
                    })
                    .done(function (response) {
                        $('.title').val(response['title']);
                    });

                    // Savings Sermon Information Update
                    $('#sermon_update').click(function(e){
                            e.preventDefault();
                            var error_display= "";
                            $(this).attr('disabled');
                            var title = $('.title').val();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                method: "POST",
                                url: "sermon/"+sermon_id,
                                data: { title: title, '_method': 'PUT' },
                                dataType: 'json',
                            })
                            .done(function( msg ) {
                                
                                    $('.error_list').append(onsuccess(msg));
                                    table.ajax.reload();
                                    $('#sermon_update').removeAttr('disabled').unbind('click');
                            })
                            .fail(function( msg ) {
                                
                                    $('.error_list').append(onfail(msg));
                                    $('#sermon_update').removeAttr('disabled').unbind('click');
                                });
                                
                            });
                          //End Sermon Info Update   
        });
        // End of Edit Sermon Information event and data fetch
           
            
            
             
        });
    </script>
@endsection

