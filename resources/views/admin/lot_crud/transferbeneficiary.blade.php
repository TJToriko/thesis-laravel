@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Lots')
@section('lots', 'active')

@section('content')
    <div class="page-header">
        <h4 class="page-title">Lots</h4>
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
                <a href="{{ route('lots') }}">Lots</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Transfer Lot</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Transfer Lot to Beneficiary Form</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Transfer of Ownership to Beneficiary</div>
                    <div>
                        <a href="{{ route('transfer') }}" class="btn btn-success">
                            Back
                        </a>
                    </div>
                </div>
                <form action="{{ route('transferbeneficiary.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lot_detail">Lot Details</label>
                                            <select class="select2-suffix form-control" name="transfer_opt" id="transfer_opt" hidden>
                                                <option value="transfer_beneficiary">Transfer to Beneficiary</option>
                                            </select>
                                            <select class="select2-suffix form-control" name="lot_id" id="lot_detail" required>
                                                <option value="">Select Lot</option>
                                                @foreach ($lots as $lot)
                                                <option value="{{ $lot->lot_id }}">{{ $lot->lot->section }}, {{ $lot->lot->lot_no }}, {{ $lot->lot->lotType->lot_type_name }}, @if(!empty($lot->lot->lotClass->lot_class_name))
                                                    {{ $lot->lot->lotClass->lot_class_name }}
                                                    @else
                                                        
                                                    @endif</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mname">Previous Owner</label>
                                            <input type="hidden" hidden name="prev_owner_id" id="prev_owner_id">
                                            <input type="text" class="form-control" id="prev_owner" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="transfer_opt">Beneficiary Full Name</label>
                                            <input type="text" class="form-control" id="beneficiary" placeholder="" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <h3><strong>New Owner Details</strong></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 new-owner">
                                <div class="row px-xl-3">
                                    <div class="col-md-3 form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name">
                                        @error('first_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Enter Middle Name">
                                        @error('middle_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name">
                                        @error('last_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="suffix">Suffix</label>
                                        <select name="suffix" class="form-control" id="section">
                                            <option value=""></option>
                                            <option value="Jr.">Jr.</option>
                                            <option value="Sr.">Sr.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row px-xl-3">
                                    <div class="col-md-3 form-group">
                                        <label for="date_of_birth">Date of Birth</label>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                                        @error('date_of_birth')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="place_of_birth">Place of Birth</label>
                                        <input type="text" class="form-control" id="place_of_birth" name="place_of_birth">
                                        @error('place_of_birth')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="occupation">Occupation</label>
                                        <input type="text" class="form-control" name="occupation" id="occupation" placeholder="Enter Occupation">
                                        @error('occupation')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="">Sex</label><br>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="sex" value="Male">
                                            <span class="form-radio-sign">Male</span>
                                        </label>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="sex" value="Female">
                                            <span class="form-radio-sign">Female</span>
                                        </label>
                                        @error('sex')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row px-xl-3">
                                    <div class="col-md-4 form-group">
                                        <label for="province">Province <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="province" placeholder="Enter Province" name="province" required value="{{ old('province') }}">
                                        @error('province')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="city">City <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="city" placeholder="Enter City" name="city" required value="{{ old('city') }}">
                                        @error('city')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="barangay">Barangay <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="barangay" placeholder="Enter Barangay" name="barangay" required value="{{ old('barangay') }}">
                                        @error('barangay')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row px-xl-3">
                                    <div class="col-md-4 form-group">
                                        <label for="street">Street</label>
                                        <input type="text" class="form-control" name="street" id="street" placeholder="Enter Street">
                                        @error('street')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="landmark">Landmark</label>
                                        <input type="text" class="form-control" name="landmark" id="landmark" placeholder="Enter Landmark">
                                        @error('landmark')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="cp_no">Cellphone Number</label>
                                        <input type="text" class="form-control" name="cp_no" id="cp_no">
                                        @error('cp_no')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row px-xl-3">
                                    <div class="col-md-4 form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                                        @error('email')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Valid ID</label>
                                        <input type="file" class="form-control" name="id_image" id="">
                                        @error('id_image')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <h3><strong>Name of Beneficiary/ies</strong></h3>
                                    </div>
                                </div>
                                <div class="row px-xl-3">
                                    <div class="col-md-4 form-group">
                                        <label for="fullname_beneficiary">Full Name</label>
                                        <input type="text" class="form-control" name="benificiary_fullname" id="fullname_beneficiary" placeholder="Enter Complete Name">
                                        @error('benificiary_fullname')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="fullname_date_of_birth">Date of Birth</label>
                                        <input type="date" class="form-control" name="benificiary_date_of_birth" id="fullname_date_of_birth">
                                        @error('benificiary_date_of_birth')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="relationship">Relationship</label>
                                        <input type="text" class="form-control" name="relationship" id="relationship" placeholder="Enter Relationship">
                                        @error('relationship')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    

{{-- script for Auto Putting owner details when lot details choosed --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#lot_detail').on('change', function(){
            var customerId = $(this).val();

            $.ajax({
                url: '/admin/get-customerwithbeneficiary/' + customerId,
                type: 'GET',
                success: function(data) {
                    // Assuming the returned data has a 'customer' property
                    var customer = data.customer;
                    var customerId = customer.id;
                    var customerBeneficiary = customer.benificiary_fullname;

                    // Concatenate the full name
                    var fullName = customer.first_name + ' ' + (customer.middle_name ? customer.middle_name + ' ' : '') + customer.last_name + ' ' + (customer.suffix ? customer.suffix : '');

                    // Set the concatenated full name in the 'prev_owner' field
                    $('#prev_owner').val(fullName);
                    $('#prev_owner_id').val(customerId);
                    $('#beneficiary').val(customerBeneficiary);
                },
                error: function(error) {
                    console.log(error);
                    // Handle error here
                }
            });
        });
    });
</script>

@endsection