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
                        <h4 class="page-title">Add Admin</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            <div class="row">
                <div class="col-md-4">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="header-title">Add Admin Details</h4>
                                <p><span class="font-weight-bold">NOTE:</span> Administrators are in different forms</p>
                            </div>
                            <div class="col-md-12">
                                <form method="post" action="" id="add_admin_form">
                                    <div class="error_list"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="Enter First Name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control" placeholder="Enter Username">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Admin Type</label>
                                                <select class="form-control" name="roles">
                                                    <option selected disabled value="">--Select Admin Type--</option>
                                                    <option value="0">Super Admin</option>
                                                    <option value="1">Sub Admin</option>
                                                    <option value="2">Moderator</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-block" id="submit_admin">Add Administrator</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-box">
                        <h4 class="header-title">Modify Admin Details</h4>
                        <p>Delete Admin Details</p>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="table-responsive" style="border: none">
                                    <table id="datatable1" class="table table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Admin Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
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
{{-- Edit Modal --}}
<div class="modal fade bd-example-modal-sm first_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Song's Information</h5>
          <button type="button" class="close song_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" id="admin_update_info_form">
            <div class="modal_error_list_info">

            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Full Name</label>
              <input type="text" class="form-control name_update" id="name_update" value="">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Email</label>
                <input type="text" class="form-control email_update" id="email_update" value="">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Role</label>
                <select name="role_list" id="" class="form-control role_list">
                    <option value="0">Super Admin</option>
                    <option value="1">Sub Admin</option>
                    <option value="2">Moderator</option>
                </select>
              </div>
              
            <div class="form-group">
            <div class="form-group">
                <div class="text-danger">**Specify a password or leave empty to retain default **</div>
                <label for="recipient-name" class="col-form-label">Password</label>
                <input type="password" class="form-control password_update" id="password_update" value="">
                </div>
            <button type="button" id="admin_update" class="btn btn-primary btn-block">Update Song Info</button></div>
          </form>
        </div>
      </div>
      </div>
    </div>
  </div>
{{-- Modal End --}}
@endsection
@section('scripts')
<script type="text/javascript">
    $(()=>{
      // $.fn.dataTable.ext.errMode = 'throw';
      var table = $('#datatable1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('admins.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {
                        data: 'name', 
                        name: 'name', 
                        "orderable": true,
                        "searchable": true
                    },
                    {data: 'email', name: 'email'},
                    {data: 'roles', name: 'roles'},

                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: true, 
                        searchable: true
                    }
                   
                    
                ],
                
            });

            // ------------------ end table display ---------------------------
             //------------------------------ add admin event ---------------------------------------
             $('#add_admin_form').submit(function(e){
            e.preventDefault();
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "{{ Route('admins.store') }}",
                data:  new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                // enctype: 'multipart/form-data',
            })
            .done(function( msg ) {
                
                    $('.error_list').append(onsuccess(msg));
                    table.ajax.reload();
                    $('#add_admin_form')[0].reset();
            })
            .fail(function( msg ) {
                $('.error_list').append(onfail(msg));
            });
                
        });
        // ------------------------------ end -------------------------------------------------------
        // ---------------------- Ajax Delete Button -------------------------

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
                        url: "admins/"+delete_id,
                        data: {'_method': 'DELETE'},
                        method: "POST",
                    })
                    .done(function (response) {
                        table.ajax.reload();
                        $('.error_list').append(onsuccess(response));
                    });
                    // console.log('hi');
        });
        //-------------------------- end delete event -----------------------------------------------
        //---------------------- Edit Administrator Information and data fetch --------------------------------------------------//
 $('#datatable1').on('click','.edit',function(e){
                    e.preventDefault();
                    var admin_id = $(this).data('id');
                    var saved_tags = [];
                    $.ajax({
                        url: "admins/"+admin_id+"/edit",
                        data: {},
                        method: "GET",
                    })
                    .done(function (response) {
                        $('.name_update').val(response['name']);
                        $('.email_update').val(response['email']);                     
                        $(".role_list > option").each(function() {
                            if(this.value == response['roles']){
                                $(this).attr('selected','selected');
                            }
                        });
                            //     match stored index with listed options
                    });

        //---------------------- Book Information Update--------------------------------------
                    $('#admin_update').click(function(e){
                            e.preventDefault();
                            var error_display= "";
                            $(this).attr('disabled');
                            var name = $('.name_update').val();
                            var email = $('.email_update').val();
                            var roles = $('.role_list').val();
                            var password = $('.password_update').val();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                method: "POST",
                                url: "admins/"+admin_id,
                                data: { name: name, email:email, role:roles, password:password, '_method': 'PUT' },
                                dataType: 'json',
                            })
                            .done(function( msg ) {
                                
                                    $('.modal_error_list_info').append(onsuccess(msg));
                                    $('#admin_update').removeAttr('disabled').unbind('click');
                                    $('#admin_update_info_form')[0].reset();
                                    table.ajax.reload();
                                    // $(this).removeAttr('disabled');
                            })
                            .fail(function( msg ) {
                                    $('.modal_error_list_info').append(onfail(msg));
                                    $('#admin_update').removeAttr('disabled').unbind('click');
                                    $('#admin_update_info_form')[0].reset();
                                });
                                
                });
                
    
        }); 
        // ---------------------------- End Administrator Information Edit -----------------------------
        
// $('.first_modal').on('hidden.bs.modal', function () {
//     $('.role_list').find('option').remove();
// });
    })
</script>

@endsection