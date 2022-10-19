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
                        <h4 class="page-title">Push Notifications</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-md-4">
                    <h4 class="header-title">Add Push Notifications</h4>
                    <form method="post" id="add_push_notification_form" enctype="multipart/form-data">
                        <div class="error_list">
                            {{-- error message --}}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 offset-md-3">
                                    <div class="form-group">
                                        {{-- <label class="text-center">Image</label> --}}
                                        <input type="file" name="image" id="image" class="form-control dropify">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Push Title</label>
                                    <input type="text" name="title" id="title" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <label>Push Message</label>
                                <textarea class="form-control" name="message" id="message" rows="5" style="resize: none"></textarea>
                            </div>
                            {{-- <div class="col-md-6">
                                    <label>Book Introduction</label>
                                <textarea class="form-control" rows="5" name="intro" id="intro" style="resize: none">Book Introduction</textarea>
                            </div> --}}
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                <button type="submit" id="add_notification" class="btn btn-primary btn-block">Submit Notifications</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
                <div class="col-md-8">
                    <div class="card-box">
                        <h4 class="header-title">Notifications</h4>
                        <table id="datatable1" class="table table-bordered wrap">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Message</th>
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
<div class="modal fade bd-example-modal-sm first_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Book's Information</h5>
          <button type="button" class="close book_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" id="update_book_info_form">
            <div class="modal_error_list_info">

            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Song Title</label>
              <input type="text" class="form-control update_title" id="update_title" value="">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Author</label>
                <input type="text" class="form-control update_author" id="update_author" value="">
              </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Tags</label>
                <select name="update_tags[]" id="tag_list" class="form-control tag_list" multiple data-selected-text-format="count > 5" data-style="btn-light">
                    {{-- <option value="0">No Album</option>   --}}
                </select>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Description</label>
                <input type="text" class="form-control update_description" id="update_description" value="">
              </div>
            <div class="form-group">
            <button type="button" id="book_update" class="btn btn-primary btn-block">Update Book Info</button></div>
          </form>
        </div>
      </div>
      </div>
    </div>
  </div>
{{-- Modal End --}}

{{-- Modal Song File Edit --}}
<div class="modal fade bd-example-modal-sm modal2" id="modal" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Replace Book Cover</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data" id="update_book_form">
            <div class="modal_error_list">

            </div>
            <div class="form-group">
                <label for="cover" class="col-form-label">Book Cover</label>
                <input type="file" class="form-control" id="cover1" name="cover">
              </div>
              <input type="hidden" value="" id="book_id" name="book_id">
            <div class="form-group">
            <button type="button"  id="update_cover" class="btn btn-primary btn-block">Update Cover</button></div>
          </form>
        </div>
      </div>
      </div>
    </div>
  </div>
{{-- Modal End --}}

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
                ajax: "{{ Route('push-notifications.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {
                        data: 'push_image', 
                        name: 'push_image', 
                        "orderable": true,
                        "searchable": true
                    },
                    {data: 'title', name: 'title'},
                    {data: 'body', name: 'body'},

                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: true, 
                        searchable: true
                    }
                   
                    
                ],
                
            });

            // ------------------ end table display ---------------------------

            //------------------------------ add notifications event ---------------------------------------
            $('#add_push_notification_form').submit(function(e){
            e.preventDefault();
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "{{ Route('push-notifications.store') }}",
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
                    $('#add_push_notification_form')[0].reset();
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
                        url: "books/"+delete_id,
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

     //---------------------- Edit Song Information/Cover and data fetch --------------------------------------------------//
 $('#datatable1').on('click','.edit',function(e){
                    e.preventDefault();
                    var book_id = $(this).data('id');
                    var saved_tags = [];
                    $.ajax({
                        url: "books/"+book_id+"/edit",
                        data: {},
                        method: "GET",
                    })
                    .done(function (response) {
                        $('.update_title').val(response[0]['title']);
                        $('.update_artist_name').val(response[0]['artist']);
                        $('.update_description').val(response[0]['description']);
                        $('.update_author').val(response[0]['author']);
                       
                        $.each(response[2], function( index ) {
                            saved_tags.push(response[2][index]['id']);
                        });
                        $.each(response[1], function( index ) {
                            //     check if song tags id exist in tags & make it selected

                            if($.inArray(response[1][index]['id'], saved_tags) !== -1){
                                $(".tag_list").append(new Option(response[1][index]['name'], response[1][index]['id'],  false, true));
                            }
                            else{
                                $(".tag_list").append(new Option(response[1][index]['name'],response[1][index]['id']), false, false);
                            }
                            // $(".tag_list").trigger('change');
                        });
                      
                    });

        //---------------------- Book Information Update--------------------------------------
                    $('#book_update').click(function(e){
                            e.preventDefault();
                            var error_display= "";
                            $(this).attr('disabled');
                            var title = $('.update_title').val();
                            var description = $('.update_description').val();
                            var author = $('.update_author').val();
                            var tags = $('.tag_list').val();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                method: "POST",
                                url: "books/"+book_id,
                                data: { title: title, author:author, tags:tags, description:description, '_method': 'PUT' },
                                dataType: 'json',
                            })
                            .done(function( msg ) {
                                
                                    $('.modal_error_list_info').append(onsuccess(msg));
                                    table.ajax.reload();
                                    $(this).removeAttr('disabled');
                            })
                            .fail(function( msg ) {
                                
                                    $('.modal_error_list_info').append(onfail(msg));
                                    $(this).removeAttr('disabled');
                                });
                                
                });
                
    
        }); 
        // ---------------------------- End Book Information Edit -----------------------------


         //  -------------------- Book Cover  Replace ----------------------------------------------------

         $('#datatable1').on('click','.edit_cover',function(e){
                    e.preventDefault();
                    var book_id = $(this).data('id');
                    $('#book_id').val(book_id);
                    
                    
                    // Savings Audio Information Update
                    $('#update_cover').click(function(e){
                        e.preventDefault();
                            $('#update_cover').attr('disabled');
                            var book_cover_form = new FormData($('#update_book_form')[0]);
                            book_cover_form.append('_method', 'PUT');
                           
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                method: "POST",
                                url: "book_cover_update/"+book_id,
                                data: book_cover_form,
                                dataType: 'json',
                                contentType: false,
                                cache: false,
                                processData: false,
                                enctype: 'multipart/form-data',
                            })
                            .done(function( msg ) {
                                
                                    $('.modal_error_list').append(onsuccess(msg));
                                    table.ajax.reload();
                                    $('#update_cover').removeAttr('disabled').unbind('click');
                                    $('#update_cover_form')[0].reset();
                                   
                            })
                            .fail(function( msg ) {
                                // console.log(msg);
                                
                                    $('.modal_error_list').append(onfail(msg));
                                    $('#update_cover').removeAttr('disabled').unbind('click');
                                    $('#update_cover_form')[0].reset();
                                  
                                });
                    });
        });
        
        // ------------------- Audio Replace end ---------------------------------------------------------

// Clear Select option for album List
$('.first_modal').on('hidden.bs.modal', function () {
    $('.tag_list').find('option').remove();
});
         });
    </script>
@endsection


