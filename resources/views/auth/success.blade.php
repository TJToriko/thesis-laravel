<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Hillside Memorial Garden | Signup</title>
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
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="mt-5">Account Registration Successful!</h3>
                        <p class="mt-3">Thank you for registering. Your account is pending approval by the administrators.</p>
                        <p>Please wait for approval to access your account.</p>
                        <p>For any inquiries, please contact support.</p>
                        <!-- You can add additional information or links as needed -->
                        <div class="mt-3">
                            <a href="{{ route('login') }}" class="btn btn-primary">Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            {{-- script for showing the toast after successfully adding --}}
            <script>
                $(document).ready(function() {
                    @if(session('success'))
                        // Show the toast notification if there is a success message in the session
                        $.notify({
                            icon: 'fas fa-check',
                            title: 'Success!',
                            message: '{{ session('success') }}',
                        },{
                            type: 'success',
                            placement: {
                                from: "top",
                                align: "right"
                            },
                            time: 3000,
                        });
                    @endif
                });
            </script>
            <script src="{{ asset('adminassets/js/core/jquery.3.2.1.min.js') }}"></script>
            <script src="{{ asset('adminassets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
            <script src="{{ asset('adminassets/js/core/popper.min.js') }}"></script>
            <script src="{{ asset('adminassets/js/core/bootstrap.min.js') }}"></script>
            <script src="{{ asset('adminassets/js/ready.js') }}"></script>
            <!-- Sweet Alert -->
            <script src="{{ asset('adminassets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    </body>
</html>