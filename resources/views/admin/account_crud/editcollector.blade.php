@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Edit Collector')
@section('account', 'active')

@section('content')
<div class="page-header">
    <h4 class="page-title">Collector</h4>
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
            <a href="{{ route('account') }}">Collector</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Edit Collector</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Collector Form</div>
            </div>
            <form action="{{ route('collector.update', $collector->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><h3><b>Personal Information</b></h3></label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">First Name</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="first_name" value="{{ $collector->first_name }}" required>
                                        @error('first_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mname">Middle Name</label>
                                        <input type="text" class="form-control" id="mname" placeholder="Enter Middle Name" name="middle_name" value="{{ $collector->middle_name }}">
                                        @error('middle_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>
                                        <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="last_name" required value="{{ $collector->last_name }}">
                                        @error('last_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="suffix">Suffix</label>
                                <select class="select2-suffix form-control" name="suffix" id="suffix">
                                    <option value=""></option>
                                    <option value="Jr." {{ $collector->suffix == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                    <option value="Sr." {{ $collector->suffix == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" class="form-control" id="province" placeholder="Enter Province" name="province" required value="province">
                                @error('province')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" placeholder="Enter City" name="city" required value="{{ $collector->city }}">
                                @error('city')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="barangay">Barangay</label>
                                <input type="text" class="form-control" id="barangay" placeholder="Enter Barangay" name="barangay" required value="{{ $collector->barangay }}">
                                @error('barangay')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="street">Street</label>
                                <input type="text" class="form-control" name="street" id="street" placeholder="Enter Street" required value="{{ $collector->street }}">
                                @error('street')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="landmark">Landmark</label>
                                <input type="text" class="form-control" id="landmark" placeholder="Enter Landmark" name="landmark" value="{{ $collector->landmark }}">
                                @error('landmark')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" >
                                <label for="exampleFormControlFile1">Valid ID (Driver's License)</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="valid_id">
                                @error('valid_id')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required value="{{ $collector->email }}">
                                @error('email')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cpno">Cellphone #</label>
                                <input type="text" class="form-control" id="cpno" placeholder="Enter Cellphone #" name="contact_number" required value="{{ $collector->contact_number }}">
                                @error('contact_number')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birthbplace">Place Of Birth</label>
                                <input type="text" class="form-control" id="birthbplace" placeholder="Enter Place Of Birth" name="place_of_birth" required value="{{ $collector->place_of_birth }}">
                                @error('place_of_birth')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birthdate">Date Of Birth</label>
                                <input type="date" class="form-control" id="birthdate" name="date_of_birth" required value="{{ $collector->date_of_birth }}">
                                @error('date_of_birth')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <label>Sex</label><br/>
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="sex" value="Male" required {{ $collector->sex == 'Male' ? 'checked' : '' }}>
                                    <span class="form-radio-sign">Male</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="sex" value="Female" required {{ $collector->sex == 'Female' ? 'checked' : '' }}>
                                    <span class="form-radio-sign">Female</span>
                                </label>
                            </div>
                            @error('sex')
                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Username">Username</label>
                                <input type="text" class="form-control" id="Username" placeholder="Enter Username" name="username" required value="{{ $collector->username }}">
                                @error('place_of_birth')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action" style="text-align-last: right;">
                    <a href="{{ route('account') }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection