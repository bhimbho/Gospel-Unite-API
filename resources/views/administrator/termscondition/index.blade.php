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
                        <h4 class="page-title">Terms and Condition</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12">
                                {{-- error display --}}

                                <div class="error_list">

                                </div>

                                {{-- end error --}}
                                <h4 class="header-title">Add Terms and Condition</h4>
                                <form method="post" action="/termscondition">
                                    @csrf
                                    <div class="form-group">
                                        <label>Terms and Condition</label>

                                        <textarea name="terms" id="terms" class="form-control rounded-0 editor"
                                        required rows='9'>{{ $termscondition->terms_and_condition ?? '' }}</textarea>

                                    </div>
                                    <div class="form-group">
                                        <button type="submit"
                                        class="btn btn-primary btn-block rounded-0 click">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card-box -->
</div>

@endsection
@section('scripts')
<script>
    $(function(){
        // Policy Submit/Store Event
        $('#submit').click(function(e){
            e.preventDefault();
            var error_display= "";
            var name = $('#terms').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "/termscondition",
                data: { terms: name },
                dataType: 'json',
            })
            .done(function( msg ) {
                    $('.error_list').append(onsuccess(msg));
                    table.ajax.reload();
                    $('#condition_form')[0].reset();
                    $('#terms').text(name);
            })
            .fail(function( msg ) {

                    $('.error_list').append(onfail(msg));
                });

            });

        });
    </script>
    @endsection
