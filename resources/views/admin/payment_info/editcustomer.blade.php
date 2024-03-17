@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Edit Customer')
@section('payment', 'active')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Customer Details</h4>
            </div>
            <form action="{{ route('customer.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">First Name</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="first_name" required value="{{ $customer->first_name }}">
                                        @error('first_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mname">Middle Name</label>
                                        <input type="text" class="form-control" id="mname" placeholder="Enter Middle Name" name="middle_name" {{ $customer->middle_name }}>
                                        @error('middle_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>
                                        <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="last_name" required value="{{ $customer->last_name }}">
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
                                    <option value="Jr." {{ $customer->suffix == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                    <option value="Sr." {{ $customer->suffix == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="province">Province</label>
                                <select class="select2-province" name="province" id="province" required>
                                <option value="">Select a Province</option>
                                @foreach ($province as $showprovince)
                                    <option value="{{ $showprovince->provCode }}" {{ $customer->province == $showprovince->provCode ? 'selected' : '' }}>{{ ucwords(strtolower($showprovince->provDesc)) }}</option>
                                @endforeach
                                </select>
                                @error('province')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City</label>
                                <select class="select2-city" name="city" id="city" required>
                                    <option value="">Select a City</option>
                                    @foreach ($city as $showcity)
                                        <option value="{{ $showcity->citymunCode }}" {{ $customer->city == $showcity->citymunCode ? 'selected' : '' }}>{{ ucwords(strtolower($showcity->citymunDesc)) }}</option>
                                    @endforeach
                                </select>
                                @error('city')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="barangay">Barangay</label>
                                <select class="select2-barangay" name="barangay" id="barangay" required>
                                    <option value="">Select a Barangay</option>
                                        @foreach ($barangay as $showbarangay)
                                        <option value="{{ $showbarangay->brgyCode }}" {{ $customer->barangay == $showbarangay->brgyCode ? 'selected' : '' }}>{{ ucwords(strtolower($showbarangay->brgyDesc)) }}</option>
                                    @endforeach
                                </select>
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
                                <input type="text" class="form-control" name="street" id="street" placeholder="Enter Street" required value="{{ $customer->street }}">
                                @error('street')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="landmark">Landmark</label>
                                <input type="text" class="form-control" id="landmark" placeholder="Enter Landmark" name="landmark" value="{{ $customer->landmark }}">
                                @error('landmark')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" >
                                <label for="exampleFormControlFile1">Valid ID</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="id_image">
                                @error('id_image')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required value="{{ $customer->email }}">
                                @error('email')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cpno">Cellphone #</label>
                                <input type="text" class="form-control" id="cpno" placeholder="Enter Cellphone #" name="cp_no" required value="{{ $customer->cp_no }}">
                                @error('cp_no')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="occupation">Occupation</label>
                                <input type="text" class="form-control" id="occupation" placeholder="Enter Occupation" name="occupation" required value="{{ $customer->occupation }}">
                                @error('occupation')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birthbplace">Place Of Birth</label>
                                <input type="text" class="form-control" id="birthbplace" placeholder="Enter Place Of Birth" name="place_of_birth" require value="{{ $customer->place_of_birth }}">
                                @error('place_of_birth')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birthdate">Date Of Birth</label>
                                <input type="date" class="form-control" id="birthdate" name="date_of_birth" required value="{{ $customer->date_of_birth }}">
                                @error('date_of_birth')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <label>Sex</label><br/>
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="sex" value="Male" required {{ $customer->sex == 'Male' ? 'checked' : '' }}>
                                    <span class="form-radio-sign">Male</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="sex" value="Female" required {{ $customer->sex == 'Female' ? 'checked' : '' }}>
                                    <span class="form-radio-sign">Female</span>
                                </label>
                            </div>
                            @error('sex')
                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><h3><b>Name Of Benificiary/ies</b></h3></label>
                            </div>
                        </div>
                    </div>
                    <div class="row row-beneficiary">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bname">Full Name</label>
                                <input type="text" class="form-control" id="bname" placeholder="Enter Full Name" name="benificiary_fullname" required value="{{ $customer->benificiary_fullname }}">
                                @error('benificiary_fullname')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bbirthdate">Date Of Birth</label>
                                <input type="date" class="form-control" id="bbirthdate" name="benificiary_date_of_birth" required value="{{ $customer->benificiary_date_of_birth }}">
                                @error('benificiary_date_of_birth')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="brelationship">Relationship</label>
                                <input type="text" class="form-control" id="brelationship" placeholder="Enter Relationship" name="relationship" required value="{{ $customer->relationship }}">
                                @error('relationship')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{ route('paymentsdetail', $customer->id) }}" class="btn btn-danger">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection