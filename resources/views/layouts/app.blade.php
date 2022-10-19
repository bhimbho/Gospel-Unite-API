
@include('layouts.partials.head')     <!-- end Topbar -->
@include('layouts.partials.sidebar') 

<body>
    <div id="app"> 

        <main class="">
            @yield('content')
        </main>
    </div>
                <!-- Footer Start -->
@include('layouts.partials.footer') 
<script>
    function onsuccess(msg) {
        error_display = "<div class='error_alert alert alert-success alert-dismissible fade show' role='alert'><ul>"+msg;
                    
                    error_display += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    return error_display;
    }

    function onfail(msg) {
        error_display = "<div class='error_alert alert alert-danger alert-dismissible fade show' role='alert'><ul>";
                    for(var key in msg.responseJSON.errors){
                        error_display += "<li>"+msg.responseJSON.errors[key][0]+"</li>";
                    }
                    error_display += "</ul> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    return error_display;
    }
</script>

@yield('scripts')
