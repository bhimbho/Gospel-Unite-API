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
                        <h4 class="page-title">Tags</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12">
                                {{-- error display --}}

                                <div class="error_list">

                                </div>

                                {{-- end error --}}
                                <h4 class="header-title">Add Tags</h4>
                                <form method="post" id="tag_form" action="{{ Route('tags.store') }}">
                                    <div class="form-group">
                                        <label>Tags</label>
                                        <input type="text" name="tags" id="tags" class="form-control rounded-0"
                                        placeholder="Tag Name" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" id="submit"
                                        class="btn btn-primary btn-block rounded-0 click">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-box">
                        <h4 class="header-title">Modify Tags</h4>
                        <table id="datatable" class="table table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Tags</th>
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
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tag Name</label>
            <input type="text" class="form-control tag" value="">
          </div>
          <div class="form-group">
          <button type="button" id="tags_update" class="btn btn-primary btn-block">Update Tag</button></div>
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
        var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('tags.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {data: 'name', name: 'name'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    }


                ],

            });

        // Tags Submit/Store Event
        $('#submit').click(function(e){
            e.preventDefault();
            var error_display= "";
            var name = $('#tags').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "/tags",
                data: { tags: name },
                dataType: 'json',
            })
            .done(function( msg ) {

                //    console.log(msg);
                    // console.log(msg);
                    $('.error_list').append(onsuccess(msg));
                    table.ajax.reload();
                    $('#tag_form')[0].reset();
            })
            .fail(function( msg ) {

                    $('.error_list').append(onfail(msg));
                });

            });
        // End of Tags Submit/Store Event
        
        // Ajax Delete Event for Tags

        $('#datatable').on('click','.form_delete',function(e){
                    e.preventDefault();
                    var delete_id = $(this).data('id');
                    // alert(delete_id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "tags/"+delete_id,
                        data: {'_method': 'DELETE'},
                        method: "POST",
                    })
                    .done(function (response) {
                        // console.log(response);
                        table.ajax.reload();
                        $('.error_list').append(onsuccess(response));
                    });
        });
         // End of Ajax Delete Event for Tags

        // Edit event and data fetch
        $('#datatable').on('click','.edit',function(e){
                    e.preventDefault();
                    var tag_id = $(this).data('id');
                    $.ajax({
                        url: "tags/"+tag_id,
                        data: {},
                        method: "GET",
                    })
                    .done(function (response) {
                        $('.tag').val(response['name']);
                    });

                    // Savings Tags Update
                        $('#tags_update').click(function(e){
                            e.preventDefault();
                            $('#tags_update').attr('disabled');
                            var error_display= "";
                            var name = $('.tag').val();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                method: "POST",
                                url: "tags/"+tag_id,
                                data: { tags: name, '_method': 'PUT' },
                                dataType: 'json',
                            })
                            .done(function( msg ) {

                                    $('.error_list').append(onsuccess(msg));
                                    table.ajax.reload();
                                    $('#tags_update').removeAttr('disabled').unbind('click');
                            })
                            .fail(function( msg ) {

                                    $('.error_list').append(onfail(msg));
                                    $('#tags_update').removeAttr('disabled').unbind('click');
                                });

                            });
                // End of Tags Update
        });
        // End of Edit event and data fetch
            
            
             
        });
    </script>
    @endsection
