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
                        <h4 class="page-title">Videos</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12">
                                @if (Session::has('message'))
                                    <div class="alert alert-success">{{ Session::get('message') }} 2</div>
                                @endif
                                <h4 class="header-title">Add Videos</h4>
                            </div>

                            
                            <div class="col-md-12">
                                <div class="error_list">

                                </div>
                            <form method="post"  id="video_form" action="{{route('videos.store')}}" enctype="multipart/form-data">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Video Cover</label>
                                                <input type="file" id="cover" name="cover" class="form-control dropify">
                                            </div>
                                        </div>
                                        <div class="col-md-6" >
                                            <div style="padding-top:30px">
                                            <div class="form-group" >
                                                <label>Video File</label>
                                                <input type="file" name="pond-upload" class="my-pond" >
                                                <input type="hidden" name="video" id="video_response">
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Video Title</label>
                                                <input type="text" id="title" name="title" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Artist Name</label>
                                                <input type="text" id="artist" name="artist" class="form-control">
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Video Link (Youtube)</label>
                                                <input type="text" id="file" name="file" class="form-control">
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Video Tags</label>
                                                <select name="tags[]" id="tags" class="form-control selectpicker"  multiple data-selected-text-format="count > 5" data-style="btn-light">
                                                    <option >--Select Tags--</option>
                                                    @foreach ($tags as $tags )


                                                <option value="{{$tags->id}}">{{$tags->name}}</option>

                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Decription</label>
                                                <textarea name="description" id="description" class="form-control" id="" cols="10" rows="2"> </textarea>
                                                {{-- <input type="text" name="file" class="form-control"> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <button type="submit" id="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
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
                        <h4 class="header-title">Modify Video List</h4>
                        <table id="datatable" class="table table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Video Title</th>
                                    <th>Video artist</th>
                                    {{-- <th>Video Tags</th> --}}
                                    <th>Video Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card-box -->
</div>

<!-- Modal for Update -->
<div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Video Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post"  id="video_form" action="">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Video Name</label>
                        <input type="text" id="update_title" name="title" class="form-control update_title">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Artist Name</label>
                        <input type="text" id="update_artist_name" name="artist" class="form-control update_artist_name">
                    </div>
                </div>

                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label>Video Link (Youtube)</label>
                        <input type="text" id="update_file" name="file" class="form-control update_file">
                    </div>
                </div> --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Video Tags</label>
                        <select name="update_tags[]" id="tag_list" class="form-control tag_list" multiple data-selected-text-format="count > 5" data-style="btn-light">
                            <!-- <option >--Select Tags--</option>
                            <option value=""></option> -->
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="update_description" class="form-control update_description" cols="10" rows="2"> </textarea>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <button type="button" id="video_details_update" class="btn btn-primary btn-block click">Submit</button>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
    </div>
  </div>
</div>

{{-- Modal Video File Edit --}}
<div class="modal fade bd-example-modal-sm modal2" id="modal" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel1" aria-hidden="true"> --}}
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Replace Video FIle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data" id="update_video_form">
            <div class="modal_error_list">

            </div>
            <div class="form-group">
                <label for="video" class="col-form-label">Video File</label>
                <input type="file" name="pond-upload" class="update-pond">
                <input type="hidden" class="form-control" id="update_video_file" name="video">
              </div>
              {{-- <input type="text" value="" id="video_id" name="video_id"> --}}
            <div class="form-group">
            <button type="button"  id="update_video" class="btn btn-primary btn-block">Update Video</button></div>
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
    video_upload();
    video_file = $('.update-pond').filepond();
    video_upload();

    function video_upload($filetypes){
        FilePond.setOptions({
        acceptedFileTypes: ['video/mp4', 'video/x-flv', 'video/x-msvideo'],
        server: {
        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
        // fieldName is the name of the input field
        // file is the actual file object to send
        
        const formData = new FormData();
        formData.append(fieldName, file, file.name);
        const request = new XMLHttpRequest();
        request.open('POST', '/video_upload');
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
                $('#video_response').val(request.response)
                $('#update_video_file').val(request.response)
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
        
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ Route('videos.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'title', name: 'title' },
                { data: 'artist', name: 'artist' },
                { data: 'file', name: 'file' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                }
            ],

        });

        $('#video_form').submit(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "{{ Route('videos.store') }}",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                enctype: 'multipart/form-data',
            })
            .done(function( msg ) {
                $('.error_list').append(onsuccess(msg));
                table.ajax.reload();
                $('#video_form')[0].reset();
                $('.dropify-clear').trigger('click');
                $('.filepond--file-action-button').trigger('click');
            })
            .fail(function( msg ) {
                $('.error_list').append(onfail(msg));
            });

        });


  // ---------------------- Ajax Delete Button -------------------------
        $('#datatable').on('click','.form_delete',function(e){
                    e.preventDefault();
                    var delete_id = $(this).data('id');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "videos/"+delete_id,
                        data: {'_method': 'DELETE'},
                        method: "POST",
                    })
                    .done(function (response) {
                        // console.log(response);
                        table.ajax.reload();
                        $('.error_list').append(onsuccess(response));
                    });
        });
        // -------------------------------- video information edit------------
        $('#datatable').on('click','.edit',function(e){
                    e.preventDefault();
                    var video_id = $(this).data('id');
                    var saved_tags = [];
                    $.ajax({
                        url: "videos/"+video_id+"/edit",
                        data: {},
                        method: "GET",
                    })
                    .done(function (response) {
                        // console.log(response);
                        $('.update_title').val(response[0]['title']);
                        $('.update_artist_name').val(response[0]['artist']);
                        $('.update_description').text(response[0]['description']);
                        // $('.update_author').val(response[0]['author']);
                        $('.file').val(response[0]['file']);
                       
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
                }); 
    //---------------------- video Information Update--------------------------------------
                     
        $('#datatable').on('click','.edit',function(e){
                    e.preventDefault();
                    var video_id = $(this).data('id');
                    //   alert(video_id);

                    $.ajax({
                        url: "videos/"+video_id,
                        data: {},
                        method: "GET",
                    })
                    .done(function (response) {
                        $('.title').val(response['title']);
                        $('.artist').val(response['artist']);
                        $('.tags').val(response['tags']);
                        // $('.file').val(response['file']);
                        $('.description').text(response['description']);
                    });

                    //  Video Update
                        $('#video_details_update').click(function(e){
                            e.preventDefault();
                            var error_display= "";
                            var title = $('#update_title').val();
                            var artist = $('#update_artist_name').val();
                            // var file = $('#file').val();
                            var tags = $('#tag_list').val();
                            var description = $('#update_description').val();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                method: "POST",
                                url: "videos/"+video_id,
                                data: { title:title, artist:artist, tags:tags, description:description, '_method': 'PUT' },
                                dataType: 'json',
                            })
                            .done(function( msg ) {

                                    $('.error_list').append(onsuccess(msg));
                                    table.ajax.reload();
                            })
                            .fail(function( msg ) {
                                    $('.error_list').append(onfail(msg));
                                });

                            });
        });

//----------------------- Video Update Function--------------------------------------------------------
         $('#datatable').on('click','.edit_video',function(e){
                    e.preventDefault();
                    var video_id = $(this).data('id');
                    
                    // Savings Video Information Update
                    $('#update_video').click(function(e){
                        e.preventDefault();
                            $(this).attr('disabled');
                            var video_file = $('#update_video_file').val();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                method: "POST",
                                url: "video_file_update/"+video_id,
                                data: {video:video_file, '_method':'PUT'},
                                dataType: 'json',
                            })
                            .done(function( msg ) {
                                // console.log(msg);
                                    $('.modal_error_list').append(onsuccess(msg));
                                    table.ajax.reload();
                                    $('#update_video').removeAttr('disabled').unbind('click');
                                    $('#update_video_form')[0].reset();
                                    $('.filepond--file-action-button').trigger('click');
                            })
                            .fail(function( msg ) {
                                // console.log(msg);
                                    $('.modal_error_list').append(onfail(msg));
                                    $('#update_video').removeAttr('disabled').unbind('click');
                                    $('#update_video_form')[0].reset();
                                  
                                });
                    });
        });
        
        // ------------------- Video Replace end ---------------------------------------------------------


// Clear Select option for Tag List
$('.first_modal').on('hidden.bs.modal', function () {
    $('.tag_list').find('option').remove();
});

        });
    </script>
    @endsection



