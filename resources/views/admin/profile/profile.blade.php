@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Profile')

@section('content')
<div class="page-header">
    <h4 class="page-title">User Profile</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="{{ route('dashboard') }}">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="{{ route('profile', auth()->user()->id) }}">User Profile</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-with-nav">
            <div class="card-header">
                <div class="row row-nav-line">
                    <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                        <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-selected="true">Profile</a> </li>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mt-3">
                        <div class="col-md-4 form-group-default" style="text-align-last: center;">
                            <img src="{{ asset('adminassets/img/userprofile.png') }}" alt="..." style="height: 6rem; width: 6rem;">
                                <input type="file" name="profile_image" class="form-control-file mt-2" id="exampleFormControlFile1">
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group form-group-default">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="{{ $user->first_name }}">
                                                @error('first_name')
                                                    <small class="form-text text-muted text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-group-default">
                                                <label>Middle Name</label>
                                                <input type="text" class="form-control" name="middle_name" placeholder="Enter Middle Name" value="{{ $user->middle_name }}">
                                                @error('middle_name')
                                                    <small class="form-text text-muted text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-group-default">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="{{ $user->last_name }}">
                                                @error('last_name')
                                                    <small class="form-text text-muted text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-default">
                                        <label>Suffix</label>
                                        <select class="form-control" name="suffix">
                                            <option value=""></option>
                                            <option value="Jr." {{ $user->suffix == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                            <option value="Sr." {{ $user->suffix == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Cellphone #</label>
                                        <input type="text" class="form-control" name="contact_number" placeholder="Enter Phone Number" value="{{ $user->contact_number }}">
                                        @error('contact_number')
                                            <small class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ $user->email }}">
                                        @error('email')
                                            <small class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="">
                                <label>Province</label>
                                <select class="" id="province" name="province">
                                    <option value="">Select a Province</option>
                                    @foreach ($province as $showprovince)
                                    <option value="{{ $showprovince->provCode }}" {{ $user->province == $showprovince->provCode ? 'selected' : '' }}>{{ ucwords(strtolower($showprovince->provDesc)) }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="">
                                <label>City</label>
                                <select class="" id="city" name="city">
                                    <option value="">Select a City</option>
                                    @foreach ($city as $showcity)
                                        <option value="{{ $showcity->citymunCode }}" {{ $user->city == $showcity->citymunCode ? 'selected' : '' }}>{{ ucwords(strtolower($showcity->citymunDesc)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="">
                                <label>Barangay</label>
                                <select class="" id="barangay" name="barangay">
                                    <option value="">Select a Barangay</option>
                                    @foreach ($barangay as $showbarangay)
                                            <option value="{{ $showbarangay->brgyCode }}" {{ $user->barangay == $showbarangay->brgyCode ? 'selected' : '' }}>{{ ucwords(strtolower($showbarangay->brgyDesc)) }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-group-default">
                                <label>Sex</label>
                                <select class="form-control" id="gender" name="sex">
                                    <option value="Male" {{ $user->sex == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $user->sex == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="form-group form-group-default">
                                <label>Street</label>
                                <input type="text" class="form-control" name="street" placeholder="Enter Street" value="{{ $user->street }}">
                                @error('street')
                                    <small class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-group-default">
                                <label>Landmark</label>
                                <input type="text" class="form-control" placeholder="Enter Landmark" id="landmark" name="landmark" value="{{ $user->landmark }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="">
                                <label>Birth Date</label>
                                <input type="date" class="form-control" id="datepicker" name="date_of_birth" value="{{ $user->date_of_birth }}">
                                @error('date_of_birth')
                                    <small class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-group-default">
                                <label>Username</label>
                                <input type="text" class="form-control" value="{{ $user->username }}" name="username" placeholder="Enter Username">
                                @error('username')
                                    <small class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-3 mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
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
@endsection