<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Hillside Memorial Garden | Login</title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <link rel="icon" href="{{ asset('adminassets/img/Hillside_logo.png') }}" type="image/x-icon"/>

        <!-- Fonts and icons -->
        <script src="{{ asset('adminassets/js/plugin/webfont/webfont.min.js') }}"></script>
        <script>
            WebFont.load({
                google: {"families":["Open+Sans:300,400,600,700"]},
                custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['{{ asset('adminassets/css/fonts.css') }}']},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>
        
        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('adminassets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminassets/css/azzara.min.css') }}">
    </head>
    <body class="login">
        <div class="wrapper wrapper-login">
            <div class="container container-login animated fadeIn">
                <form method="post" action="{{ route('login.post') }}">
                    @csrf
                    
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <a href="{{ route('index') }}"><img src="{{ asset('images/logo_images/' . $logo->logo_image) }}" alt="" class="img-fluid w-25 mb-2"></a>
                        <h3>Sign-In</h3>
                    </div>
                    <div class="login-form">
                        <div class="form-group">
                            <label for="username" class="placeholder"><b>Username</b></label>
                            <input id="username" name="username" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="placeholder"><b>Password</b></label>
                            <a href="#" class="link float-right">Forget Password ?</a>
                            <div class="position-relative">
                                <input id="password" name="password" type="password" class="form-control" required>
                                <div class="show-password">
                                    <i class="flaticon-interface"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            @foreach($errors->all() as $error)
                                <small id="errormsg" class="form-text text-danger text-muted">{{ $error }}</small>
                            @endforeach
                        </div>
                        <div class="form-group form-action-d-flex mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="rememberme">
                                <label class="custom-control-label m-0" for="rememberme">Remember Me</label>
                            </div>
                            <button type="submit" class="btn btn-primary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Sign In</button>
                        </div>
                        <div class="login-account">
                            <span class="msg">Don't have an account yet ?</span>
                            <a href="{{ route('signup') }}" id="show-signup" class="link">Sign Up</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="{{ asset('adminassets/js/core/jquery.3.2.1.min.js') }}"></script>
        <script src="{{ asset('adminassets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('adminassets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('adminassets/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('adminassets/js/ready.js') }}"></script>
    </body>
</html>