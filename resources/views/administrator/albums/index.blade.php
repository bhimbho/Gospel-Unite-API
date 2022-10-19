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
                        <h4 class="page-title">Music Album</h4>
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
                                <h4 class="header-title">Add Music Album</h4>
                            </div>
                            <div class="col-md-12">
                                <form method="post" id="form-submit" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="col-md-4 offset-md-4">
                                            <div class="form-group">
                                                <label class="text-center">Album Cover</label>
                                                <input type="file" name="album_cover" id="album_cover" class="form-control dropify">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Album Title</label>
                                            <input type="text" name="title" id="title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Artist Name</label>
                                                <input type="text" name="artist_name" id="artist_name" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Album Description</label>
                                                <textarea type="text" name="description" id="description" class="form-control"></textarea>
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
                        <h4 class="header-title">Modify Music Library</h4>
                        <table id="datatable1" class="table table-bordered wrap" width="100%">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Music Image</th>
                                    <th>Album Title</th>
                                    <th>Artist</th>
                                    <th>No of Tracks</th>
                                    <th>Artist Description</th>
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
          <h5 class="modal-title" id="exampleModalLabel">Edit Album</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Album Title</label>
              <input type="text" class="form-control title" value="">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Artist Name</label>
                <input type="text" class="form-control artist_name" value="">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Description</label>
                <input type="text" class="form-control description" value="">
              </div>
            <div class="form-group">
            <button type="button" id="album_update" class="btn btn-primary btn-block">Update Album</button></div>
          </form>
        </div>
      </div>
      </div>
    </div>
  </div>
{{-- Modal End --}}

{{-- Modal Album Image Edit --}}
<div class="modal fade bd-example-modal-sm modal2" id="modal" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Replace Album Cover</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data" id="cover_update_form">
            <div class="modal_error_list">

            </div>
            <div class="form-group">
                <label for="cover" class="col-form-label">Album Cover</label>
                <input type="file" class="form-control" id="cover" name="cover">
              </div>
              <input type="hidden" value="" id="cover_update_id" name="cover_update_id">
            <div class="form-group">
            <button type="button"  id="update_cover" class="btn btn-primary btn-block">Update Album</button></div>
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
    $(function(){
        // $.fn.dataTable.ext.errMode = 'throw';
        var table = $('#datatable1').DataTable({
                processing: true,
                serverSide: true,
                ajax:"{{ route('albums.index') }}",
                columns: [
                    
                    {data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    
                    {
                        data: 'cover', 
                        name: 'cover', 
                        // render: function( data, type, full, meta ) {
                        //     // return "<img src=\"/storage/" + data + "\" height=\"50\"/>";
                        //     return "<img src=\"" + data + "\" height=\"50\"/>";
                        // },
                        "title": "cover",
                        "orderable": true,
                        "searchable": true
                    },
                    {name: 'title', data:'title'},
                    {name: 'artist', data:'artist'},
                    
                    {
                        data: 'songs', 
                        name: 'songs', 
                        orderable: true, 
                        searchable: true
                    },
                    {name: 'description', data:'description'},
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
            

            //image assignment
            var album_cover = new FormData();
            var files = $('#album_cover')[0].files;
            album_cover.append('album_cover',files[0]);
            //end of image assignment
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "/albums",
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
                    $('#album_form')[0].reset();
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
                        url: "albums/"+delete_id,
                        data: {'_method': 'DELETE'},
                        method: "POST",
                    })
                    .done(function (response) {
                        console.log(response);
                        table.ajax.reload();
                        $('.error_list').append(onsuccess(response));
                    });
                    // console.log('hi');
        });

        // Edit event and data fetch
        $('#datatable1').on('click','.edit',function(e){
                    e.preventDefault();
                    var album_id = $(this).data('id');
                    $.ajax({
                        url: "albums/"+album_id+"/edit",
                        data: {},
                        method: "GET",
                    })
                    .done(function (response) {
                        $('.title').val(response['title']);
                        $('.artist_name').val(response['artist']);
                        $('.description').val(response['description']);
                    });

                    // Savings Album Information Update
                    $('#album_update').click(function(e){
                            e.preventDefault();
                            var error_display= "";
                            $(this).attr('disabled');
                            var title = $('.title').val();
                            var description = $('.description').val();
                            var artist_name = $('.artist_name').val();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                method: "POST",
                                url: "albums/"+album_id,
                                data: { title: title, description:description, artist_name:artist_name, '_method': 'PUT' },
                                dataType: 'json',
                            })
                            .done(function( msg ) {
                                
                                    $('.error_list').append(onsuccess(msg));
                                    table.ajax.reload();
                                    $(this).removeAttr('disabled');
                            })
                            .fail(function( msg ) {
                                
                                    $('.error_list').append(onfail(msg));
                                    $(this).removeAttr('disabled');
                                });
                                
                            });
                          //End Album Info Update   
        });
         //  -------------------- Album Image Replace ----------------------------------------------------

        $('#datatable1').on('click','.edit_cover',function(e){
                    e.preventDefault();
                    var album_id = $(this).data('id');
                    $('#cover_update_id').val(album_id);
                    
                    
                    // Savings Album Information Update
                    $('#update_cover').click(function(e){
                        e.preventDefault();
                            $('#update_cover').attr('disabled');
                            var album_cover = new FormData($('#cover_update_form')[0]);
                            album_cover.append('_method', 'PUT');
                            // for (var pair of album_cover.entries()) {
                            //     console.log(pair[0]+ ', ' + pair[1]); 
                            // }
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                method: "POST",
                                url: "albums_cover_update/"+album_id,
                                data: album_cover,
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
                                    $('#cover_update_form')[0].reset();
                                    // album_cover.delete('cover');
                                   
                            })
                            .fail(function( msg ) {
                                // console.log(msg);
                                
                                    $('.modal_error_list').append(onfail(msg));
                                    $('#update_cover').removeAttr('disabled').unbind('click');
                                    $('#cover_update_form')[0].reset();
                                    // album_cover.delete('cover'); //remove cover from formData
                                  
                                });
                    });
        });
        
        // ------------------- Album Replace end ---------------------------------------------------------
        // End of Edit Album Information event and data fetch
           
            
            
             
        });
    </script>
@endsection

