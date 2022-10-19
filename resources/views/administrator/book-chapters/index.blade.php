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
                        <h4 class="page-title">Chapters</h4>
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
                            <div class="col-md-12">
                                <h4 class="header-title">View Chapters</h4>
                                <div class="row">
                                    <div class="col-md-5">
                                        <form method="post" action="{{ Route('books-chapters.store') }}">
                                            @csrf
                                                <div class="form-group">
                                                    <label>Chapter Number</label>
                                                    <select name="chapter_number" class="form-control" id="">
                                                        <option value="">--Select Chapter--</option>
                                                        <option value="0">Non Chapter</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Chapter Name</label>
                                                    <input type="text" name="title" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Chapter Note</label>
{{--                                                    <div id="editor">--}}
                                                    <textarea class="form-control" rows="5" style="resize: none" placeholder="notes" name="notes"></textarea>
{{--                                                    </div>--}}
                                                </div>
                                                <div class="form-group">
                                                    <label>Chapter Content</label>
{{--                                                    <div id="editor1">--}}
                                                    <textarea name="content" id="editor" class="form-control" rows="5" style="resize: none" placeholder="Chapter Content"></textarea>
{{--                                                </div>--}}
                                                </div>
                                            <input type="hidden" name="book_id" id="book_id" value="{{ $book_id }}">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-block">Update Chapter</button>
                                                </div>
                                        </form>
                                    </div>
                                    <div class="col-md-7">
                                        <table id="datatable1" class="table table-bordered wrap">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Title</th>
                                                    <th>Book name</th>
                                                    <th>Chapter Number</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        {{-- <ul class="pl-0" style="list-style-type: none;">
                                            @foreach ($chapters as $chapter)
                                                <li>
                                                    <a href="{{ Route('books-chapters.show', $chapter->id) }}">Chapter {{ $chapter->chapter_order_no }}</a>
                                                </li>
                                            @endforeach

                                        </ul> --}}
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
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Chapter's Information</h5>
          <button type="button" class="close book_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" id="update_chapter_info_form">
            <div class="modal_error_list_info">

            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Chapter Title</label>
              <input type="text" class="form-control update_chapter_title" id="update_chapter_title" value="">
            </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Chapter Content</label>
                <textarea class="form-control update_chapter" id="update_chapter" value=""></textarea>
              </div>
            <div class="form-group">
            <button type="button" id="chapter_update" class="btn btn-primary btn-block">Update Chapter Info</button></div>
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
        var book_id = $('#book_id').val();
        var table = $('#datatable1').DataTable({

                processing: true,
                serverSide: true,
                ajax: "/books-chapters/all/"+book_id,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    // {
                    //     data: 'song_cover',
                    //     name: 'song_cover',
                    //     orderable: true,
                    //     searchable: true
                    // },
                    {data: 'chapter_title', name: 'chapter_title'},
                    {data: 'book', name: 'book'},

                    {data: 'chapter_order_no', name: 'chapter_order_no'},

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    }


                ],

            });

        // ------------------------ Chapter Form Submmit------------------------
        $('#chapter_form').submit(function(e){
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "{{ Route('books-chapters.store') }}",
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
                    $('#chapter_form')[0].reset();
                        // console.log(msg)

            })
            .fail(function( msg ) {
                $('.error_list').append(onfail(msg));
            });

        });

        // ---------------- End Chapter Form Submit --------------------------
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
                        url: "/books-chapters/"+delete_id,
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

            //---------------------- Edit Book Information/Cover and data fetch --------------------------------------------------//
    $('#datatable1').on('click','.edit',function(e){
            e.preventDefault();
            var chapter_id = $(this).data('id');
            $.ajax({
                url: "/books-chapters/"+chapter_id+"/edit",
                method: "GET",
            })
            .done(function (response) {
                $('.update_chapter_title').val(response['chapter_title']);
                $('.update_chapter').val(response['chapter']);
            });

        //---------------------- Book Information Update--------------------------------------
                    $('#chapter_update').click(function(e){
                            e.preventDefault();
                            var error_display= "";
                            $(this).attr('disabled');
                            var chapter = $('.update_chapter').val();
                            var chapter_title = $('.update_chapter_title').val();
                            // console.log(chapter)
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                method: "POST",
                                url: "/books-chapters/"+chapter_id,
                                data: { chapter: chapter, chapter_title:chapter_title, '_method': 'PUT'},
                                dataType: 'json',
                            })
                            .done(function( msg ) {

                                    $('.modal_error_list_info').append(onsuccess(msg));
                                    table.ajax.reload();
                                    $('#chapter_update').removeAttr('disabled').unbind('click');
                            })
                            .fail(function( msg ) {

                                    $('.modal_error_list_info').append(onfail(msg));
                                    $('#chapter_update').removeAttr('disabled').unbind('click');
                            });

                });


        });
        // ---------------------------- End Book Information Edit -----------------------------

    });


</script>
@endsection
