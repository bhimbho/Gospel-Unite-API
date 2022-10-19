<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Gospel Unites - Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/FPI--Logo.png">

        <!-- App css -->
        <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        <style type="text/css">
            body.authentication-bg-pattern{
                background-image:url({{asset('admin/images/background.jpg')}}),linear-gradient( #fff, #191A35, #191A35);
                background-position: center !important;
                background-color: ;
                background-blend-mode: overlay;
            }
            button{
                background: #191A35 !important;
            }
            button:focus{
                box-shadow: none !important;
                color: white;
            }
        </style>
    </head>

    <body class="authentication-bg authentication-bg-pattern d-flex align-items-center">

        
        <div class="account-pages w-100 mt-4 mb-5">
            <div class="container">
                <img src="admin/images/logo.png" class="d-block mx-auto mb-2" width="240px" height="150px">
                <div class="row justify-content-center">

                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-text pt-3">
                                <h3 class="text-center">Gospel Unites</h3>
                                <h4 class="text-center">Admin Login</h4>
                            </div>
                            <div class="card-body px-4 pb-4">
                                
                                <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class=" col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group mb-0">
                            
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Login') }}
                                </button>

                        </div>
                    </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor js -->
        <script src="{{asset('admin/js/vendor.min.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('admin/js/app.min.js')}}"></script>
        
    </body>
</html>
