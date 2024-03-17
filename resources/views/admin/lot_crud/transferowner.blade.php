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
                <a href="#">Transfer Lot Form</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Transfer of Ownership</div>
                    <div>
                        <a href="{{ route('transferbeneficiary') }}" class="btn btn-success">
                            Transfer to Beneficiary
                        </a>
                    </div>
                </div>
                <form action="{{ route('transfer.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lot_detail">Lot Details <span class="text-danger">*</span></label>
                                            <select class="select2-suffix form-control" name="lot_id" id="lot_detail">
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
                                            <label for="transfer_opt">Transfer Option</label>
                                            <select class="select2-suffix form-control" name="transfer_opt" id="transfer_opt">
                                                <option value="new">New</option>
                                                <option value="transfer">Transfer</option>
                                            </select>
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
                                        <label for="first_name">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}">
                                        @error('first_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Enter Middle Name" value="{{ old('middle_name') }}">
                                        @error('middle_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}">
                                        @error('last_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="suffix">Suffix </label>
                                        <input type="text" class="form-control" id="suffix" placeholder="Enter Suffix" name="suffix" value="{{ old('suffix') }}">
                                    </div>
                                </div>
                                <div class="row px-xl-3">
                                    <div class="col-md-3 form-group">
                                        <label for="date_of_birth">Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                                        @error('date_of_birth')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="place_of_birth">Place of Birth <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth') }}">
                                        @error('place_of_birth')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="occupation">Occupation <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="occupation" id="occupation" placeholder="Enter Occupation" value="{{ old('occupation') }}">
                                        @error('occupation')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="">Sex <span class="text-danger">*</span></label><br>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="sex" value="Male" @if(old('sex') == 'Male') checked @endif>
                                            <span class="form-radio-sign">Male</span>
                                        </label>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="sex" value="Female" @if(old('sex') == 'Female') checked @endif>
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
                                        <input type="text" class="form-control" id="province" placeholder="Enter Province" name="province" value="{{ old('province') }}">
                                        @error('province')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="city">City <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="city" placeholder="Enter City" name="city" value="{{ old('city') }}">
                                        @error('city')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="barangay">Barangay <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="barangay" placeholder="Enter Barangay" name="barangay" value="{{ old('barangay') }}">
                                        @error('barangay')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row px-xl-3">
                                    <div class="col-md-4 form-group">
                                        <label for="street">Street <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="street" id="street" placeholder="Enter Street" value="{{ old('street') }}">
                                        @error('street')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="landmark">Landmark</label>
                                        <input type="text" class="form-control" name="landmark" id="landmark" placeholder="Enter Landmark" value="{{ old('landmark') }}">
                                        @error('landmark')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="contact_number">Cellphone Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{ old('contact_number') }}">
                                        @error('cp_no')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row px-xl-3">
                                    <div class="col-md-3 form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                                        @error('email')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="">Valid ID <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="id_image" id="">
                                        @error('id_image')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="">Lot Title <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="lot_title" id="">
                                        @error('lot_title')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="">Deed of Sale/Donation <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="deed_of_sale" id="">
                                        @error('deed_of_sale')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row px-xl-3">
                                    <div class="col-md-4 form-group">
                                        <label for="username">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" value="{{ old('username') }}">
                                        @error('username')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" value="{{ old('password') }}">
                                        @error('password')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password_confirmation" placeholder="Enter Confirm Password" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                        @error('password_confirmation')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <h3><strong>Name of Beneficiary/ies</strong></h3>
                                    </div>
                                </div>
                                <div class="row px-xl-3">
                                    <div class="col-md-4 form-group">
                                        <label for="benificiary_fullname">Full Name</label>
                                        <input type="text" class="form-control" name="benificiary_fullname" id="benificiary_fullname" placeholder="Enter Complete Name" value="{{ old('benificiary_fullname') }}">
                                        @error('benificiary_fullname')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="benificiary_date_of_birth">Date of Birth</label>
                                        <input type="date" class="form-control" name="benificiary_date_of_birth" id="benificiary_date_of_birth" value="{{ old('benificiary_date_of_birth') }}">
                                        @error('benificiary_date_of_birth')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="relationship">Relationship</label>
                                        <input type="text" class="form-control" name="relationship" id="relationship" placeholder="Enter Relationship" value="{{ old('relationship') }}">
                                        @error('relationship')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 transfer-owner" style="display: none;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="owner_id">Owner <span class="text-danger">*</span></label>
                                            <select class="select2-suffix form-control" name="customer_id" id="owner_id">
                                                <option value="">Select Owner</option>
                                                @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->middle_name }} {{ $customer->last_name }} {{ $customer->suffix }}</option>
                                                @endforeach
                                            </select>
                                            @error('customer_id')
                                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lot_title_transfer">Lot Title <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="lot_title_transfer" id="lot_title_transfer">
                                            @error('lot_title_transfer')
                                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Deed of Sale/Donation <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="deed_of_sale_transfer" id="">
                                            @error('deed_of_sale_transfer')
                                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success">Submit</button>
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
                url: '/admin/get-customer/' + customerId,
                type: 'GET',
                success: function(data) {
                    // Assuming the returned data has a 'customer' property
                    var customer = data.customer;
                    var customerId = customer.id;

                    // Concatenate the full name
                    var fullName = customer.first_name + ' ' + (customer.middle_name ? customer.middle_name + ' ' : '') + customer.last_name + ' ' + (customer.suffix ? customer.suffix : '');

                    // Set the concatenated full name in the 'prev_owner' field
                    $('#prev_owner').val(fullName);
                    $('#prev_owner_id').val(customerId);
                },
                error: function(error) {
                    console.log(error);
                    // Handle error here
                }
            });
        });
    });
</script>

{{-- script for hiding and showing of transfer or new owner --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the elements and the transfer option select
        var newOwnerDiv = document.querySelector('.new-owner');
        var transferOwnerDiv = document.querySelector('.transfer-owner');
        var transferOptSelect = document.getElementById('transfer_opt');

        // Function to handle the visibility based on the selected option
        function toggleOwnerDivs() {
            var selectedOption = transferOptSelect.value;

            // Toggle visibility based on the selected option
            if (selectedOption === 'new' || selectedOption === 'transfer_beneficiary') {
                newOwnerDiv.style.display = 'block';
                transferOwnerDiv.style.display = 'none';
            } else if (selectedOption === 'transfer') {
                newOwnerDiv.style.display = 'none';
                transferOwnerDiv.style.display = 'block';
            } else {
                newOwnerDiv.style.display = 'none';
                transferOwnerDiv.style.display = 'none';
            }
        }

        // Initial setup on page load
        toggleOwnerDivs();

        // Add event listener for the change event on the transfer option select
        transferOptSelect.addEventListener('change', toggleOwnerDivs);
    });
</script>
@endsection