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
                        <h4 class="page-title">Privacy Policy</h4>
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
                                <h4 class="header-title">Add Privacy Policy</h4>
                                <form method="post" action="/privacypolicy">
                                    @csrf
                                    <div class="form-group">
                                        <label>Privacy Policya</label>

                                        <textarea  name="privacypolicy" id="privacypolicy" class="form-control rounded-0 editor"
                                        required rows='9'>{{ $privacy_policy->privacy_policy ?? ''}}</textarea>

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
        // Policy Submit/Stosre Event
        $('#submit').click(function(e){
            e.preventDefault();
            var error_display= "";
            var name = $('#privacypolicy').val();
            console.log(ClassicEditor.instances)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "/privacypolicy",
                data: { privacypolicy: name },
                dataType: 'json',
            })
            .done(function( msg ) {
                    $('.error_list').append(onsuccess(msg));
                    table.ajax.reload();
                    $('#policy_form')[0].reset();
                    $('#privacypolicy').text(name);
            })
            .fail(function( msg ) {

                    $('.error_list').append(onfail(msg));
                });

            });

        });
    </script>
    @endsection
