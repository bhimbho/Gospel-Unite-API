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
                      
                    <div class="error_list">

                    </div>
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="header-title">Add Sermon</h4>
                            </div>
                            {{-- <div class="col-md-4 d-flex justify-content-end">
                                <a class="btn btn-primary" href="{{ Route('sermon.index') }}">Add Sermon</a>
                            </div> --}}
                            <div class="col-md-12">
                                <form method="post" enctype="multipart/form-data" id="songform">
                                    <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-center">Sermon Cover</label>
                                                    <input type="file" name="cover" id="cover" class="form-control dropify">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-center">Sermon File</label>
                                                    <input type="file" name="pond-upload" class="my-pond">
                                                    <input type="hidden" name="song" id="song_response">
                                                </div>
                                            </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sermon Title</label>
                                                <input type="text" name="title" id="title" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Artist/Preacher Name</label>
                                                <input type="text" name="artist" id="artist" class="form-control">
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sermon Tags</label>
                                                <select class="form-control selectpicker" name="tags[]" id="tags"  multiple data-selected-text-format="count > 5" data-style="btn-light">
                                                    @foreach ($tags as $tags)
                                                        <option value="{{ $tags->id }}">{{ $tags->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sermon Type</label>
                                                <select class="form-control selectpicker" name="sermon" id="sermon" data-selected-text-format="count > 5" data-style="btn-light">
                                                    <option value="0" selected>--Select Sermon --</option>
                                                    @foreach ($sermons as $sermon)
                                                    
                                                        <option value="{{ $sermon->id }}">{{ $sermon->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Release Date</label>
                                                <input type="date" name="release_date" id="release_date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea type="text" name="description" id="description" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                            <button type="submit" id="song_submit_button" class="btn btn-primary btn-block btn-lg">Submit <i class="fa fa-spinner fa-spin spinner"></i></button> 
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
                        <h4 class="header-title">Modify Sermon Library</h4>
                        <table id="datatable1" class="table table-bordered wrap" wrap>
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Cover</th>
                                    <th>Sermon Title</th>
                                    <th>Art/Preacher Name</th>
                                    <th>Release Date</th>
                                    {{-- <th>Sermon</th> --}}
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
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Sermon Information</h5>
          <button type="button" class="close song_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" id="update_audio_info_form">
            <div class="modal_error_list_info">

            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Sermon Title</label>
              <input type="text" class="form-control update_title" id="update_title" value="">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Artist/Preacher Name</label>
                <input type="text" class="form-control update_artist_name" id="update_artist_name" value="">
              </div>
              {{-- <div class="form-group">
                <label for="recipient-name" class="col-form-label">Sermon</label>
                <select name="sermon_list" id="" class="form-control sermon_list">
                    <option value="">-- Select Sermon Type --</option>  
                </select>
              </div> --}}
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Tags</label>
                <select name="update_tags[]" id="#tag_list" class="form-control tag_list" multiple data-selected-text-format="count > 5" data-style="btn-light">
                    {{-- <option value="0">No Album</option>   --}}
                </select>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Release Date</label>
                <input type="date" class="form-control update_release_date" name="update_release_date" value="">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Description</label>
                <input type="text" class="form-control update_description" id="update_description" value="">
              </div>
            <div class="form-group">
            <button type="button" id="song_update" class="btn btn-primary btn-block">Update Sermon</button></div>
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
          <h5 class="modal-title" id="exampleModalLabel">Replace Audio FIle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data" id="update_audio_form">
            <div class="modal_error_list">

            </div>
            <div class="form-group">
                <label for="cover" class="col-form-label">Audio File</label>
                <input type="file" class="update-pond" name="pond-upload">
                <input type="hidden" class="form-control" id="update_song_file" name="song">
              </div>
            <div class="form-group">
            <button type="button"  id="update_audio" class="btn btn-primary btn-block">Update Sermon Audio</button></div>
          </form>
        </div>
      </div>
      </div>
    </div>
  </div>
{{-- Modal End --}}
@endsection
@section('scripts')
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
    <script>
        FilePond.registerPlugin(FilePondPluginFileValidateType);
    $('.my-pond').filepond();
    audio_upload();
    video_file = $('.update-pond').filepond();
    audio_upload();

    function audio_upload($filetypes){
        FilePond.setOptions({
        acceptedFileTypes: ['audio/mp3', 'audio/3gpp', 'audio/mpeg4-generic', 'audio/mpeg', 'audio/ogg'],
        server: {
        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
        // fieldName is the name of the input field
        // file is the actual file object to send
        
        const formData = new FormData();
        formData.append(fieldName, file, file.name);
        const request = new XMLHttpRequest();
        request.open('POST', '/song_upload');
        request.setRequestHeader('X-CSRF-TOKEN','{{ csrf_token() }}')
        // Should call the progress method to update the progress to 100% before calling load
        // Setting computable to false switches the loading indicator to infinite mode
        request.upload.onprogress = (e) => {
            progress(e.lengthComputable, e.loaded, e.total);
        };

        // Should call the load method when done and pass the returned server file id
        // this server file id is then used later on when reverting or restoring a file
        // so your server knows which file to return without exposing that info to the client
        request.onload = function () {
            if (request.status >= 200 && request.status < 300) {
                // the load method accepts either a string (id) or an object
                load();
                $('#song_response').val(request.response)
                $('#update_song_file').val(request.response)
                // FilePond.removefile();
            } else {
                // Can call the error method if something is wrong, should exit after
                error('oh no');
            }
        };

        request.send(formData);

        // Should expose an abort method so the request can be cancelled
        return {
            abort: () => {
                // This function is entered if the user has tapped the cancel button
                request.abort();

                // Let FilePond know the request has been cancelled
                abort();
            },
        };
        },
        },
        });
    }
        $(function(){
            spinnerShowHide('.spinner')
            // $.fn.dataTable.ext.errMode = 'throw';
        var table = $('#datatable1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('songs.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {
                        data: 'song_cover', 
                        name: 'song_cover', 
                        orderable: true, 
                        searchable: true
                    },
                    {data: 'title', name: 'title'},
                    {data: 'artist', name: 'artist'},
                   
                    {data: 'released_Date', name: 'released_Date'},
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: true, 
                        searchable: true
                    }
                   
                    
                ],
                
            });


         $('#songform').submit(function(e){
            e.preventDefault();
            $('#song_submit_button').attr('disabled', true)
            spinnerShowHide('.spinner', 'show')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "{{ Route('songs.store') }}",
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
                $('#songform')[0].reset();
                $("input[type=hidden]").val(null);
                $('.dropify-clear').trigger('click');
                $('.filepond--file-action-button').trigger('click');
                
                $('#song_submit_button').attr('disabled', false)
                spinnerShowHide('.spinner')
            })
            .fail(function( msg ) {
                $('.error_list').append(onfail(msg));
                $('#song_submit_button').attr('disabled', false)
                spinnerShowHide('.spinner')
            });
                
        });
        
        
 //---------------------- Edit Song Information and data fetch --------------------------------------------------//
 $('#datatable1').on('click','.edit',function(e){
                    e.preventDefault();
                    var music_id = $(this).data('id');
                    var saved_tags = [];
                    $.ajax({
                        url: "songs/"+music_id+"/edit",
                        data: {},
                        method: "GET",
                    })
                    .done(function (response) {
                        $('.update_title').val(response[0]['title']);
                        $('.update_artist_name').val(response[0]['artist']);
                        $('.update_description').val(response[0]['description']);
                        $('.update_release_date').val(response[0]['released_Date']);
                        // $(".album_list").append(new Option("No Album", "0"));
                    //    $.each(response[1], function( index ) {
                    //         //     check if song album id exist in sermon & make it selected
                    //         if(response[0]['sermon_id'] == response[1][index]['id']){
                    //             $(".sermon_list").append(new Option(response[1][index]['title'], response[1][index]['id'],  true, true));
                    //         }
                    //         else{
                    //             $(".sermon_list").append(new Option(response[1][index]['title'],response[1][index]['id']));
                    //         }
                    //     });
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
                        });
                      
                    });

                    // Savings Album Information Update
                    $('#song_update').click(function(e){
                            e.preventDefault();
                            var error_display= "";
                            $(this).attr('disabled');
                            var title = $('.update_title').val();
                            var description = $('.update_description').val();
                            var artist_name = $('.update_artist_name').val();
                            var release_date = $('.update_release_date').val();
                            var tags = $('.tag_list').val();
                            // var album_type = $('.album_list').val();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                method: "POST",
                                url: "songs/"+music_id,
                                data: { title: title, release_date:release_date, tags:tags, description:description, artist_name:artist_name, '_method': 'PUT' },
                                dataType: 'json',
                            })
                            .done(function( msg ) {
                                
                                    $('.modal_error_list_info').append(onsuccess(msg));
                                    table.ajax.reload();
                                    $(this).removeAttr('disabled');
                                    $('#song_update').removeAttr('disabled').unbind('click');
                            })
                            .fail(function( msg ) {
                                
                                    $('.modal_error_list_info').append(onfail(msg));
                                    $('#song_update').removeAttr('disabled').unbind('click');
                                });
                                
                            });
                          //End Album Info Update   
        });

         //  -------------------- Audio  Replace ----------------------------------------------------

         $('#datatable1').on('click','.edit_song',function(e){
                    e.preventDefault();
                    var music_id = $(this).data('id');
                    
                    // Savings Audio Information Update
                    $('#update_audio').click(function(e){
                        e.preventDefault();
                            $('#update_audio').attr('disabled');
                            const song_file = $('#update_song_file').val();
                           
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                method: "POST",
                                url: "song_file_update/"+music_id,
                                data: {song:song_file, '_method':'PUT'},
                                dataType: 'json',
                            })
                            .done(function( msg ) {
                                
                                    $('.modal_error_list').append(onsuccess(msg));
                                    table.ajax.reload();
                                    $('#update_audio').removeAttr('disabled').unbind('click');
                                    $('#update_audio_form')[0].reset();
                                    $('.filepond--file-action-button').trigger('click');
                                   
                            })
                            .fail(function( msg ) {                                
                                    $('.modal_error_list').append(onfail(msg));
                                    $('#update_audio').removeAttr('disabled').unbind('click');
                                    $('#update_audio_form')[0].reset();
                                  
                                });
                    });
        });
        
        // ------------------- Audio Replace end ---------------------------------------------------------
  
  // ---------------------- Ajax Delete Button -------------------------

  $('#datatable1').on('click','.form_delete',function(e){
                    e.preventDefault();
                    var delete_id = $(this).data('id');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "songs/"+delete_id,
                        data: {'_method': 'DELETE'},
                        method: "POST",
                    })
                    .done(function (response) {
                        // console.log(response);
                        table.ajax.reload();
                        $('.error_list').append(onsuccess(response));
                    });
                    // console.log('hi');
        });

// Clear Select option for album List
$('.first_modal').on('hidden.bs.modal', function () {
    // $('.album_list').find('option').remove();
    $('.tag_list').find('option').remove();
});
         
        })
    </script>
@endsection

