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

            <div class="container container-login animated fadeIn" style=" width:800px;">
                <h3 class="text-center">Sign Up</h3>
                <div class="login-form">
                    <form action="{{ route('signup.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name" class="placeholder"><b>First Name</b> <span class="text-danger">*</span></label>
                                            <input value="{{ old('first_name') }}" id="first_name" name="first_name" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="middle_name" class="placeholder"><b>Middle Name</b></label>
                                            <input value="{{ old('middle_name') }}" id="middle_name" name="middle_name" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name" class="placeholder"><b>Last Name</b> <span class="text-danger">*</span></label>
                                            <input value="{{ old('last_name') }}" id="last_name" name="last_name" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="suffix" class="placeholder"><b>Suffix</b></label>
                                    <select class="form-control" name="suffix" id="suffix">
                                        <option value=""></option>
                                        <option value="Jr.">Jr.</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="province" class="placeholder"><b>Province</b> <span class="text-danger">*</span></label>
                                    <input value="{{ old('province') }}" id="province" name="province" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city" class="placeholder"><b>City</b> <span class="text-danger">*</span></label>
                                    <input value="{{ old('city') }}" id="city" name="city" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="barangay" class="placeholder"><b>Barangay</b> <span class="text-danger">*</span></label>
                                    <input value="{{ old('barangay') }}" id="barangay" name="barangay" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="street">Street <span class="text-danger">*</span></label>
                                    <input value="{{ old('street') }}" type="text" class="form-control" name="street" id="street" placeholder="Enter Street" required>
                                    @error('street')
                                        <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="landmark">Landmark</label>
                                    <input value="{{ old('landmark') }}" type="text" class="form-control" id="landmark" placeholder="Enter Landmark" name="landmark">
                                    @error('landmark')
                                        <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" >
                                    <label for="valid_id">Valid ID <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control-file" id="valid_id" name="valid_id" required>
                                    @error('valid_id')
                                        <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input value="{{ old('email') }}" type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
                                    @error('email')
                                        <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contact_number">Cellphone # <span class="text-danger">*</span></label>
                                    <input value="{{ old('contact_number') }}" type="text" class="form-control" id="contact_number" placeholder="Enter Cellphone #" name="contact_number" required>
                                    @error('contact_number')
                                        <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="occupation">Occupation <span class="text-danger">*</span></label>
                                    <input value="{{ old('occupation') }}" type="text" class="form-control" id="occupation" placeholder="Enter Occupation" name="occupation" required>
                                    @error('occupation')
                                        <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="place_of_birth">Place Of Birth <span class="text-danger">*</span></label>
                                    <input value="{{ old('place_of_birth') }}" type="text" class="form-control" id="place_of_birth" placeholder="Enter Place Of Birth" name="place_of_birth" required>
                                    @error('place_of_birth')
                                        <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date_of_birth">Date Of Birth <span class="text-danger">*</span></label>
                                    <input value="{{ old('date_of_birth') }}" type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                                    @error('date_of_birth')
                                        <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <label>Sex <span class="text-danger">*</span></label><br/>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="sex" value="Male" required>
                                        <span class="form-radio-sign">Male</span>
                                    </label>
                                    <label class="form-radio-label ml-3">
                                        <input class="form-radio-input" type="radio" name="sex" value="Female" required>
                                        <span class="form-radio-sign">Female</span>
                                    </label>
                                </div>
                                @error('sex')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="username" class="placeholder"><b>Username</b> <span class="text-danger">*</span></label>
                                    <input value="{{ old('username') }}" id="username" name="username" type="text" class="form-control" required>
                                    @error('username')
                                        <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password" class="placeholder"><b>Password</b> <span class="text-danger">*</span></label>
                                    <input  id="password" name="password" type="password" class="form-control" required>
                                    @error('password')
                                        <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="confirm_password" class="placeholder"><b>Confirm Password</b> <span class="text-danger">*</span></label>
                                    <input  id="confirm_password" name="confirm_password" type="password" class="form-control" required>
                                    @error('confirm_password')
                                        <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row form-sub m-0">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="terms_and_conditions" id="terms_and_conditions" required>
                                <label class="custom-control-label" for="terms_and_conditions">I Agree the terms and conditions.</label>
                            </div>
                        </div>
                        <div class="row form-action">
                            <div class="col-md-6">
                                <a href="{{ route('login') }}" id="show-signin" class="btn btn-danger btn-link w-100 fw-bold">back</a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary w-100 fw-bold">Sign Up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            <script src="{{ asset('adminassets/js/core/jquery.3.2.1.min.js') }}"></script>
            <script src="{{ asset('adminassets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
            <script src="{{ asset('adminassets/js/core/popper.min.js') }}"></script>
            <script src="{{ asset('adminassets/js/core/bootstrap.min.js') }}"></script>
            <script src="{{ asset('adminassets/js/ready.js') }}"></script>
    </body>
</html>