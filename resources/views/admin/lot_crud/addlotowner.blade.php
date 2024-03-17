@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Lots')
@section('lots', 'active')

@section('content')
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <style>
        .contact .info {
            padding: 9px !important;
        }
    </style>
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
            <a href="#">Purchase Application Form</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Purchase Application Form</div>
            </div>
            <form action="{{ route('lotowner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                                        <label for="fname">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="first_name" required value="{{ old('first_name') }}">
                                        @error('first_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mname">Middle Name</label>
                                        <input type="text" class="form-control" id="mname" placeholder="Enter Middle Name" name="middle_name" value="{{ old('middle_name') }}">
                                        @error('middle_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="lname">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="last_name" required value="{{ old('last_name') }}">
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
                                <input type="text" class="form-control" id="suffix" placeholder="Enter Suffix" name="suffix" value="{{ old('suffix') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="province">Province <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="province" placeholder="Enter Province" name="province" required value="{{ old('province') }}">
                                @error('province')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="city" placeholder="Enter City" name="city" required value="{{ old('city') }}">
                                @error('city')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="barangay">Barangay <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="barangay" placeholder="Enter Barangay" name="barangay" required value="{{ old('barangay') }}">
                                @error('barangay')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="street">Street <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="street" id="street" placeholder="Enter Street" required value="{{ old('street') }}">
                                @error('street')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="landmark">Landmark</label>
                                <input type="text" class="form-control" id="landmark" placeholder="Enter Landmark" name="landmark" value="{{ old('landmark') }}">
                                @error('landmark')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" >
                                <label for="exampleFormControlFile1">Valid ID <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="id_image" required>
                                @error('id_image')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required value="{{ old('email') }}">
                                @error('email')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_number">Cellphone # <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="contact_number" placeholder="Enter Cellphone #" name="contact_number" required value="{{ old('contact_number') }}">
                                @error('contact_number')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="occupation">Occupation <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="occupation" placeholder="Enter Occupation" name="occupation" required value="{{ old('occupation') }}">
                                @error('occupation')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birthbplace">Place Of Birth <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="birthbplace" placeholder="Enter Place Of Birth" name="place_of_birth" required value="{{ old('place_of_birth') }}">
                                @error('place_of_birth')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birthdate">Date Of Birth <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="birthdate" name="date_of_birth" required value="{{ old('date_of_birth') }}" max="{{ date('Y-m-d') }}">
                                @error('date_of_birth')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <label>Sex <span class="text-danger">*</span></label><br/>
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="sex" value="Male" required @if(old('sex') == 'Male') checked @endif>
                                    <span class="form-radio-sign">Male</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="sex" value="Female" required @if(old('sex') == 'Female') checked @endif>
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
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" required value="{{ old('username') }}">
                                @error('username')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required value="{{ old('password') }}">
                                @error('password')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" placeholder="Enter Confirm Password" name="password_confirmation" required value="{{ old('password_confirmation') }}">
                                @error('password_confirmation')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
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
                                <label for="bname">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="bname" placeholder="Enter Full Name" name="benificiary_fullname" required value="{{ old('benificiary_fullname') }}">
                                @error('benificiary_fullname')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bbirthdate">Date Of Birth <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="bbirthdate" name="benificiary_date_of_birth" required value="{{ old('benificiary_date_of_birth') }}" max="{{ date('Y-m-d') }}">
                                @error('benificiary_date_of_birth')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="brelationship">Relationship <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="brelationship" placeholder="Enter Relationship" name="relationship" required value="{{ old('relationship') }}">
                                @error('relationship')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group d-flex justify-content-between">
                                <label><h3><b>Lot Purchase Detail</b></h3></label>
                                <div>
                                    <a class="btn btn-success text-white" data-toggle="modal" data-target="#chooselotModal">
                                        <span class="btn-label">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                        Choose a Lot
                                    </a>
                                    {{-- <a href="{{ route('showmap') }}" class="btn btn-success text-white">
                                        <span class="btn-label">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                        Choose a Lot
                                    </a> --}}
                                    {{-- <a type="button" class="btn btn-icon btn-xs btn-success ml-2 add-lot-purchase text-white">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <a type="button" class="btn btn-icon btn-xs btn-danger remove-lot-purchase text-white" style="display: none;">
                                        <i class="fas fa-times"></i>
                                    </a> --}}
                                </div>
                            </div>
                            @error('lot_id')
                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    @if (session()->has('session_lot_id'))
                        @php
                            $lotIds = is_array(session('session_lot_id')) ? session('session_lot_id') : [session('session_lot_id')];
                            $counter = 0;
                        @endphp

                        @foreach ($lotIds as $lotId)
                            @php
                                $data = \App\Models\Lot::with('lotType', 'lotClass')->find($lotId);
                            @endphp

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="section">Section</label>
                                                <input type="text" class="form-control" id="section" value="{{ $data->section }}" disabled>
                                                <input type="hidden" name="lot_id[]" value="{{ $data->id }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lotno">Lot #</label>
                                                <input type="text" class="form-control" id="lotno" value="{{ $data->lot_no }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ltype">Lot Type</label>
                                        <input type="text" class="form-control" id="ltype" value="{{ $data->lotType->lot_type_name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lclass">Lot Class</label>
                                                <input type="text" class="form-control" id="lclass" value="{{ $data->lotClass->lot_class_name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" style="margin-top: 35px;">
                                                <a href="{{ route('lot.session.remove', $data->id)}}" id="delete" class="text-danger">
                                                    <span class="btn-label">
                                                        <i class="fa fa-minus"></i>
                                                    </span>
                                                    Remove lot
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ptype">Payment Type</label>
                                        <select class="form-control" name="ptype[]" id="ptype{{ $counter }}" required>
                                            <option value="">Sellect a Payment</option>
                                            @php
                                                // Fetch payment types based on $lotTypeId and $lotClassId as an array
                                                $paymentTypes = \App\Models\PaymentSetting::where('lot_type_id', $data->lotType->id)->where('lot_class_id', $data->lotClass->id)->get();
                                            @endphp
                                            @foreach ($paymentTypes as $row)
                                                <option value="{{ $row->id }}">{{  $row->payment_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 oncash" id="onCash{{ $counter }}" style="display: none;">
                                    <div class="form-group">
                                        <label for="full_payment">Cash Full Price</label>
                                        <input type="hidden" hidden name="full_payment[]" id="cash_payment{{ $counter }}">
                                        <input type="text" class="form-control" id="full_payment{{ $counter }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 oninstallmentdown" id="onInstallmentdown{{ $counter }}" style="display: none;">
                                    <div class="form-group">
                                        <label for="downpayment">Downpayment Amount</label>
                                        <input type="number" min="" max="" step=".01" class="form-control" name="downpayment[]" id="downpayment{{ $counter }}">
                                        <small id="downpaymentdetails{{ $counter }}" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-12 oninstallment" id="onInstallment{{ $counter }}" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fpayment">Installment Full Price</label>
                                                <input type="text" class="form-control" id="fpayment{{ $counter }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="mpayment">Monthly Payment</label>
                                                <input type="text" class="form-control" id="mpayment{{ $counter }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="noyear">No. Years</label>
                                                <input type="number" class="form-control" id="noyear{{ $counter }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="rebate">Rebate</label>
                                                <input type="text" class="form-control" id="rebate{{ $counter }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php
                                $counter++
                            @endphp
                        @endforeach
                    @endif

                    @php
                        $lotIds = is_array(session('session_lot_id')) ? session('session_lot_id') : [session('session_lot_id')];
                        $numberOfsessionedIds = count($lotIds);
                    @endphp
                    
                    @if($numberOfsessionedIds == 1)
                        <input type="hidden" id="full_payment1" disabled>
                        <input type="hidden" id="downpayment1">
                        <input type="hidden" id="full_payment2" disabled>
                        <input type="hidden" id="downpayment2">
                        <input type="hidden" id="full_payment3" disabled>
                        <input type="hidden" id="downpayment3">
                        <input type="hidden" id="full_payment4" disabled>
                        <input type="hidden" id="downpayment4">
                    @elseif ($numberOfsessionedIds == 2)
                        <input type="hidden" id="full_payment2" disabled>
                        <input type="hidden" id="downpayment2">
                        <input type="hidden" id="full_payment3" disabled>
                        <input type="hidden" id="downpayment3">
                        <input type="hidden" id="full_payment4" disabled>
                        <input type="hidden" id="downpayment4">
                    @elseif ($numberOfsessionedIds == 3)
                        <input type="hidden" id="full_payment3" disabled>
                        <input type="hidden" id="downpayment3">
                        <input type="hidden" id="full_payment4" disabled>
                        <input type="hidden" id="downpayment4">
                    @elseif ($numberOfsessionedIds == 4)
                        <input type="hidden" id="full_payment4" disabled>
                        <input type="hidden" id="downpayment4">
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" hidden name="date_started" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pthru">Pay Thru</label>
                                        <select class="form-control" name="pthru" id="pthru">
                                            <option value="Office">Office</option>
                                            <option value="Collector">Collector</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fpamount">Total Payment Amount</label>
                                        <input type="hidden" hidden name="total_amount_paid" id="fpamount2">
                                        <input type="text" class="form-control" value="0.00" disabled id="fpamount">
                                    </div>
                                </div>
                                @error('amount')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action" style="text-align-last: right;">
                    <a href="{{ route('lots') }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>

{{-- script for showing the toast error --}}
<script>
    $(document).ready(function() {
        @if(session('error'))
            // Show the toast notification if there is a success message in the session
            $.notify({
                icon: 'fas fa-times-circle',
                title: 'Success!',
                message: '{{ session('error') }}',
            },{
                type: 'danger',
                placement: {
                    from: "top",
                    align: "right"
                },
                time: 3000,
            });
        @endif
    });
</script>


{{-- script that calculates for the total amount paid --}}
<script>
    // Function to calculate total downpayment amount
    function calculateTotalDownpayment() {
        // Helper function to get the value of an element by ID or return 0 if the element is null
        function getElementValue(elementId) {
            var element = document.getElementById(elementId);
            return element ? parseFloat(element.value) || 0 : 0;
        }

        var cashFullPrice1 = getElementValue("full_payment0");
        var cashFullPrice2 = getElementValue("full_payment1");
        var cashFullPrice3 = getElementValue("full_payment2");
        var cashFullPrice4 = getElementValue("full_payment3");
        var cashFullPrice5 = getElementValue("full_payment4");
        var downpayment1 = getElementValue("downpayment0");
        var downpayment2 = getElementValue("downpayment1");
        var downpayment3 = getElementValue("downpayment2");
        var downpayment4 = getElementValue("downpayment3");
        var downpayment5 = getElementValue("downpayment4");

        var totalCash = cashFullPrice1 + cashFullPrice2 + cashFullPrice3 + cashFullPrice4 + cashFullPrice5;
        var totalDownpayment = totalCash + downpayment1 + downpayment2 + downpayment3 + downpayment4 + downpayment5;

        // Update the total downpayment amount fields
        document.getElementById("fpamount").value = totalDownpayment;
        document.getElementById("fpamount2").value = totalDownpayment;
    }

    // Event listeners to trigger calculation when input values change
    document.getElementById("full_payment0").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("full_payment1").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("full_payment2").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("full_payment3").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("full_payment4").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("downpayment0").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("downpayment1").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("downpayment2").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("downpayment3").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("downpayment4").addEventListener("input", calculateTotalDownpayment);
</script>


<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="{{ asset('assets/data/wholehillside.js') }}"></script>
<script src="{{ asset('assets/data/3sideshillside.js') }}"></script>


<!-- Modal choosing lot map format -->
<div class="modal fade lotmodal bd-example-modal-lg" id="chooselotModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Choose A Lot</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <!-- ======= Contact Section ======= -->
                        <section id="contact" class="contact">
                            <div class="container">
                    
                            <div class="row">
                    
                                <div class="col-lg-12 mt-5 mt-lg-0 d-flex align-items-stretch">
                                    
                                    <div id="map">
                                        <div class="leaflet-control-zoom leaflet-bar leaflet-control" style="border:none;">
                                            <div class="search-container" style="margin-left: 60px;margin-top: 20px;">
                                                <input type="text" id="lotNumberInput" placeholder="Enter Lot Number">
                                                <button onclick="searchLot()">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <script>
                                        var rectangles = {
                                            "type": "FeatureCollection",
                                            "features": [
                                                @foreach($lotstatusget as $lot)
                                                {
                                                    "type": "Feature",
                                                    "properties": {
                                                        "lotID": "{{ $lot->id }}",
                                                        "lotStatus": "{{ $lot->lot_status }}",
                                                        "lotSection": "{{ $lot->section }}",
                                                        "lotNo": "{{ $lot->lot_no }}",
                                                        "lotType": "{{ $lot->lotType->lot_type_name }}"
                                                        @if($lot->lotClass && !empty($lot->lotClass->lot_class_name)),
                                                        "lotClass": "{{ $lot->lotClass->lot_class_name }}",
                                                        @endif
                                                    },
                                                    "geometry": {
                                                        "coordinates": [[
                                                            {{ $lot->coordinates }}
                                                        ]],
                                                        "type": "Polygon"
                                                    }
                                                },
                                                @endforeach
                                            ]
                                        };
                                    </script>
                                
                                    <script>
                                        var map = L.map('map').setView([6.968534, 122.103685], 17);
                                        
                                
                                        // Create GeoJSON layers
                                        var geojsonLayer1 = L.geoJson(wholehillsidegeojson);
                                        var geojsonLayer2 = L.geoJson(sidehillsidegeojson);
                                        var geojsonLayer3 = L.geoJson(rectangles, {
                                                style: styleLayer3,
                                                onEachFeature: function (feature, layer) {
                                                    var lotID = feature.properties.lotID;
                                                    var lotStatus = feature.properties.lotStatus;
                                                    var lotSection = feature.properties.lotSection;
                                                    var lotNo = feature.properties.lotNo;
                                                    var lotType = feature.properties.lotType;
                                                    var lotClass = feature.properties.lotClass;

                                                    // Set default popup content
                                                    var popupContent = '<b>Lot Status:</b> ' + lotStatus;
                                                    popupContent += '<br><b>Section:</b> ' + lotSection; // Concatenate to add Section
                                                    popupContent += '<br><b>Lot #:</b> <span id="lot_number">' + lotNo + '</span>';       // Concatenate to add Lot No
                                                    popupContent += '<br><b>Lot Type:</b> <span id="lot_number">' + lotType + '</span>';
                                                    // Check if Lot Class is not empty before adding it to the popup
                                                    if (lotClass && lotClass.trim() !== '') {
                                                        popupContent += '<br><b>Lot Class:</b> <span id="lot_number">' + lotClass + '</span>';
                                                    }

                                                    // You can customize the popup content based on the lot status or add more information
                                                    // For example, add more details if the lot is Reserved or Intered
                                                    if (lotStatus === 'Available') {
                                                        popupContent += '<br><a class="btn" href="{{ url('lot/session-lot-store/') }}/' + lotID + '">Select Lot</a>';
                                                    } else if (lotStatus === 'Intered') {
                                                        popupContent += '<br><i>Someone has been interred in this lot.</i>';
                                                    } else if (lotStatus === 'Reserved') {
                                                        popupContent += '<br><i>This Lot is Reserved.</i>';
                                                    } else if (lotStatus === 'Unavailable') {
                                                        popupContent += '<br><i>Lot is Unavailable.</i>';
                                                    }

                                                    layer.bindPopup(popupContent);
                                                }
                                            });

                                        // Satelite Layer
                                        googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
                                        maxZoom: 25,
                                        subdomains:['mt0','mt1','mt2','mt3']
                                        });
                                        googleSat.addTo(map);
                                
                                        // Google Map Layer
                                
                                        googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                                            maxZoom: 25,
                                            subdomains:['mt0','mt1','mt2','mt3']
                                        });
                                        googleStreets.addTo(map);
                                
                                
                                        var baseLayers = {
                                            "Satellite":googleSat,
                                            "Google Map":googleStreets,
                                        };
                                
                                        L.control.layers(baseLayers).addTo(map);
                                
                                        // Add GeoJSON layers to the map initially
                                        geojsonLayer1.addTo(map);
                                
                                        var sectionLayer = L.geoJson(wholehillsidegeojson, {
                                            style: style,
                                            onEachFeature: onEachFeature
                                        }).addTo(map);

                                        // Create a legend for the colors indicating status
                                        var statusLegend = L.control({ position: 'topright' });

                                        statusLegend.onAdd = function (map) {
                                            var div = L.DomUtil.create('div', 'info legend');
                                            div.innerHTML += '<div>Lot Status</div>';
                                            
                                            // Add legend items for different statuses with color indicators
                                            div.innerHTML += '<div><i class="legend-icon" style="background: green;width: 15px;height: 15px;margin-right: 5px;border-radius: 0;"></i> Intered</div>';
                                            div.innerHTML += '<div><i class="legend-icon" style="background: black;width: 15px;height: 15px;margin-right: 5px;border-radius: 0;"></i> Unavailable</div>';
                                            div.innerHTML += '<div><i class="legend-icon" style="background: blue;width: 15px;height: 15px;margin-right: 5px;border-radius: 0;"></i> Available</div>';
                                            div.innerHTML += '<div><i class="legend-icon" style="background: yellow;width: 15px;height: 15px;margin-right: 5px;border-radius: 0;"></i> Reserved</div>';
                                            // Add more legend items as needed for other statuses
                                            
                                            return div;
                                        };

                                        statusLegend.addTo(map);
                                
                                        // Listen for zoom events on the map
                                        map.on('zoomend', function () {
                                            var currentZoom = map.getZoom();
                                
                                            // Check the current zoom level and show/hide layers accordingly
                                            if (currentZoom > 18) {
                                                map.removeLayer(hsmLayer);
                                                map.removeLayer(geojsonLayer2);
                                                map.addLayer(geojsonLayer3);
                                            } else if (currentZoom > 17 && currentZoom <= 18) {
                                                map.removeLayer(geojsonLayer1);
                                                map.removeLayer(sectionLayer);
                                                map.removeLayer(geojsonLayer3);
                                                map.addLayer(geojsonLayer2);
                                                map.addLayer(hsmLayer);
                                            } else {
                                                map.removeLayer(hsmLayer);
                                                map.removeLayer(geojsonLayer2);
                                                map.addLayer(geojsonLayer1);
                                                map.addLayer(sectionLayer);
                                            }            
                                        });
                                
                                        // Define styling for the Hsm GeoJSON layer
                                        function style(feature) {
                                            return {
                                                fillColor: '#3388ff',
                                                weight: 2,
                                                opacity: 1,
                                                color: 'white',
                                                dashArray: '3',
                                                fillOpacity: 0
                                            };
                                        }
                                
                                        // Define highlight and resetHighlight functions for the Hsm GeoJSON layer
                                        function highlightFeature(e) {
                                            var layer = e.target;
                                
                                            layer.setStyle({
                                                weight: 5,
                                                color: '#666',
                                                dashArray: '',
                                                fillOpacity: 0.7
                                            });
                                
                                            if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                                                layer.bringToFront();
                                            }
                                
                                            info.update(layer.feature.properties);
                                        }
                                
                                        function resetHighlight(e) {
                                            hsmLayer.resetStyle(e.target);
                                            info.update();
                                        }
                                
                                        // Create the Hsm GeoJSON layer with the defined style and interactions
                                        var hsmLayer = L.geoJson(sidehillsidegeojson, {
                                            style: style,
                                            onEachFeature: onEachFeature
                                        });
                                
                                        function resetHighlight(e) {
                                            sectionLayer.resetStyle(e.target);
                                            info.update();
                                        }
                                
                                        // Create the Hsm GeoJSON layer with the defined style and interactions
                                
                                
                                
                                        // Define the info control for displaying feature properties
                                        var info = L.control();
                                
                                        // Define the zoomToFeature function for zooming to a feature's bounds
                                        function zoomToFeature(e) {
                                            map.fitBounds(e.target.getBounds());
                                        }
                                
                                        // Define onEachFeature function for adding interactions to Hsm features
                                        function onEachFeature(feature, layer) {
                                            layer.on({
                                                mouseover: highlightFeature,
                                                mouseout: resetHighlight,
                                                click: zoomToFeature
                                            });
                                        }

                                        // Define styling for Layer 3 (rectangles GeoJSON layer)
                                        function styleLayer3(feature) {
                                            var lotStatus = feature.properties.lotStatus;

                                            // Set default style
                                            var defaultStyle = {
                                                weight: 2,
                                                opacity: 1,
                                                color: 'blue',
                                                dashArray: '3',
                                                fillOpacity: 0
                                            };

                                            // Check lot status and set fillColor accordingly
                                            if (lotStatus === 'Unavailable') {
                                                return { ...defaultStyle, color: 'black' };
                                            } else if (lotStatus === 'Reserved') {
                                                return { ...defaultStyle, color: 'yellow' };
                                            } else if (lotStatus === 'Intered') {
                                                return { ...defaultStyle, color: 'green' };
                                            }else {
                                                // Default color for other cases
                                                return defaultStyle;
                                            }
                                        }

                                        // Declare the searchMarker variable in the global scope
                                        var searchMarker;

                                        function searchLot() {
                                            var lotNumber = document.getElementById('lotNumberInput').value.toUpperCase(); // Convert to uppercase for case-insensitivity
                                            var found = false;

                                            // Loop through GeoJSON features to find the matching lot number
                                            geojsonLayer3.eachLayer(function (layer) {
                                                if (layer.feature.properties.lotNo.toUpperCase() === lotNumber) {
                                                    // Found the matching lot, zoom to its bounds
                                                    map.fitBounds(layer.getBounds());
                                                    map.setZoom(23); // Set the zoom level to 23

                                                    // Remove any existing markers before adding a new one
                                                    if (searchMarker) {
                                                        map.removeLayer(searchMarker);
                                                    }

                                                    // Add a marker at the center of the lot's bounds
                                                    searchMarker = L.marker(layer.getBounds().getCenter()).addTo(map);

                                                    found = true;
                                                }
                                            });

                                            // Display an alert if the lot number is not found
                                            if (!found) {
                                                alert('Lot number not found.');
                                            }
                                        }

                                    </script>

                                </div>
                    
                            </div>
                    
                            </div>
                            
                        </section><!-- End Contact Section -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('#ptype0').on('change', function(){
            var paymentType = $(this).val();

            $.ajax({
                url: '/lot/get-payment-details/' + paymentType,
                type: 'GET',
                success: function(data) {
                    if (data.payment_type === 'Cash') {
                        // For Cash payment type
                        $('#onCash0').show();
                        $('#onInstallment0').hide();
                        $('#onInstallmentdown0').hide();
                        $('#full_payment0').val(data.cash_full_price);
                        $('#cash_payment0').val(data.cash_full_price);
                        $('#ptype_name0').val(data.payment_type);
                        
                        // Set mpayment input field to none (empty string)
                        $('#mpayment0').val('');

                        // Calculate total downpayment amount when full payment values change
                        calculateTotalDownpayment();
                    } else if (data.payment_type === 'Installment') {
                        // For Installment payment type
                        $('#onCash0').hide();
                        $('#onInstallment0').show();
                        $('#onInstallmentdown0').show();
                        $('#fpayment0').val(data.installment_full_price);
                        $('#mpayment0').val('0.00');
                        $('#noyear0').val(data.no_year);
                        $('#rebate0').val(data.rebate_price);
                        $('#interest0').val(data.interest_price);
                        $('#ptype_name0').val(data.payment_type);

                        // Set minimum and maximum values for the downpayment input
                        $('#downpayment0').attr('min', data.min_amount);
                        $('#downpayment0').attr('max', data.installment_full_price);

                        // Update the content of the <small> element
                        $('#downpaymentdetails0').text('Minimum amount is ' + data.min_amount);

                        // Set full_payment input field to none (empty string)
                        $('#full_payment0').val('');

                        // Calculate total downpayment amount when full payment values change
                        calculateTotalDownpayment();
                    }
                },
                error: function(error) {
                    console.log(error);
                    // Handle error here
                }
            });
        });
    });
</script>


{{-- script for auto computation of downpayment and monthly amount --}}
<script>    
    // Function to calculate monthly payment without interest
    function calculateMonthlyPayment() {
        var downpayment = parseFloat($('#downpayment0').val()) || 0;
        var numberOfYears = parseInt($('#noyear0').val()) || 1;

        // Calculate total loan amount (full price - down payment)
        var fullPrice = parseFloat($('#fpayment0').val()) || 0;
        var loanAmount = fullPrice - downpayment;

        // Calculate number of payments
        var numberOfPayments = numberOfYears * 12;

        // Calculate monthly payment
        var monthlyPayment = loanAmount / numberOfPayments;

        // Update the monthly payment field
        $('#mpayment0').val(monthlyPayment.toFixed(2));
    }

    // Bind the function to the input fields' change event
    $('#downpayment0, #noyear0, #fpayment0').on('input', calculateMonthlyPayment);
</script>


{{-- ika1 --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#ptype1').on('change', function(){
            var paymentType1s = $(this).val();

            $.ajax({
                url: '/lot/get-payment-details1/' + paymentType1s,
                type: 'GET',
                success: function(datas) {
                    if (datas.payment_type === 'Cash') {
                        // For Cash payment type
                        $('#onCash1').show();
                        $('#onInstallment1').hide();
                        $('#onInstallmentdown1').hide();
                        $('#full_payment1').val(datas.cash_full_price);
                        $('#cash_payment1').val(datas.cash_full_price);s

                        // Set mpayment input field to none (empty string)
                        $('#mpayment1').val('');

                        // Calculate total downpayment amount when full payment values change
                        calculateTotalDownpayment();
                    } else if (datas.payment_type === 'Installment') {
                        // For Installment payment type
                        $('#onCash1').hide();
                        $('#onInstallment1').show();
                        $('#onInstallmentdown1').show();
                        $('#fpayment1').val(datas.installment_full_price);
                        $('#mpayment1').val(0.00);
                        $('#noyear1').val(datas.no_year);
                        $('#rebate1').val(datas.rebate_price);
                        $('#interest1').val(datas.interest_price);

                        // Update the content of the <small> element
                        $('#downpaymentdetails1').text('Minimum amount is ' + datas.min_amount);

                        // Set full_payment1 input field to none (empty string)
                        $('#full_payment1').val('');

                        // Calculate total downpayment amount when full payment values change
                        calculateTotalDownpayment();
                    }
                },
                error: function(error) {
                    console.log(error);
                    // Handle error here
                }
            });
        });
    });
</script>

{{-- script for auto computation of downpayment and monthly amount --}}
<script>    
    // Function to calculate monthly payment without interest
    function calculateMonthlyPayment() {
        var downpayment = parseFloat($('#downpayment1').val()) || 0;
        var numberOfYears = parseInt($('#noyear1').val()) || 1;

        // Calculate total loan amount (full price - down payment)
        var fullPrice = parseFloat($('#fpayment1').val()) || 0;
        var loanAmount = fullPrice - downpayment;

        // Calculate number of payments
        var numberOfPayments = numberOfYears * 12;

        // Calculate monthly payment
        var monthlyPayment = loanAmount / numberOfPayments;

        // Update the monthly payment field
        $('#mpayment1').val(monthlyPayment.toFixed(2));
    }

    // Bind the function to the input fields' change event
    $('#downpayment1, #noyear1, #fpayment1').on('input', calculateMonthlyPayment);
</script>

{{-- ika2 --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#ptype2').on('change', function(){
            var paymentType2s = $(this).val();

            $.ajax({
                url: '/lot/get-payment-details2/' + paymentType2s,
                type: 'GET',
                success: function(datas) {
                    if (datas.payment_type === 'Cash') {
                        // For Cash payment type
                        $('#onCash2').show();
                        $('#onInstallment2').hide();
                        $('#onInstallmentdown2').hide();
                        $('#full_payment2').val(datas.cash_full_price);

                        // Set mpayment2 input field to none (empty string)
                        $('#mpayment2').val('');
                        // Calculate total downpayment amount when full payment values change
                        calculateTotalDownpayment();
                    } else if (datas.payment_type === 'Installment') {
                        // For Installment payment type
                        $('#onCash2').hide();
                        $('#onInstallment2').show();
                        $('#onInstallmentdown2').show();
                        $('#fpayment2').val(datas.installment_full_price);
                        $('#mpayment2').val('0.00');
                        $('#noyear2').val(datas.no_year);
                        $('#rebate2').val(datas.rebate_price);
                        $('#interest2').val(datas.interest_price);

                        // Update the content of the <small> element
                        $('#downpaymentdetails2').text('Minimum amount is ' + datas.min_amount);

                        // Set full_payment2 input field to none (empty string)
                        $('#full_payment2').val('');
                        // Calculate total downpayment amount when full payment values change
                        calculateTotalDownpayment();
                    }
                },
                error: function(error) {
                    console.log(error);
                    // Handle error here
                }
            });
        });
    });
</script>

{{-- script for auto computation of downpayment and monthly amount --}}
<script>    
    // Function to calculate monthly payment without interest
    function calculateMonthlyPayment() {
        var downpayment = parseFloat($('#downpayment2').val()) || 0;
        var numberOfYears = parseInt($('#noyear2').val()) || 1;

        // Calculate total loan amount (full price - down payment)
        var fullPrice = parseFloat($('#fpayment2').val()) || 0;
        var loanAmount = fullPrice - downpayment;

        // Calculate number of payments
        var numberOfPayments = numberOfYears * 12;

        // Calculate monthly payment
        var monthlyPayment = loanAmount / numberOfPayments;

        // Update the monthly payment field
        $('#mpayment2').val(monthlyPayment.toFixed(2));
    }

    // Bind the function to the input fields' change event
    $('#downpayment2, #noyear2, #fpayment2').on('input', calculateMonthlyPayment);
</script>


{{-- ika3 --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#ptype3').on('change', function(){
            var paymentType3s = $(this).val();

            $.ajax({
                url: '/lot/get-payment-details3/' + paymentType3s,
                type: 'GET',
                success: function(datas) {
                    if (datas.payment_type === 'Cash') {
                        // For Cash payment type
                        $('#onCash3').show();
                        $('#onInstallment3').hide();
                        $('#onInstallmentdown3').hide();
                        $('#full_payment3').val(datas.cash_full_price);

                        // Set mpayment2 input field to none (empty string)
                        $('#mpayment3').val('');
                        // Calculate total downpayment amount when full payment values change
                        calculateTotalDownpayment();
                    } else if (datas.payment_type === 'Installment') {
                        // For Installment payment type
                        $('#onCash3').hide();
                        $('#onInstallment3').show();
                        $('#onInstallmentdown3').show();
                        $('#fpayment3').val(datas.installment_full_price);
                        $('#mpayment3').val('0.00');
                        $('#noyear3').val(datas.no_year);
                        $('#rebate3').val(datas.rebate_price);
                        $('#interest3').val(datas.interest_price);

                        // Update the content of the <small> element
                        $('#downpaymentdetails3').text('Minimum amount is ' + datas.min_amount);

                        // Set full_payment2 input field to none (empty string)
                        $('#full_payment3').val('');
                        // Calculate total downpayment amount when full payment values change
                        calculateTotalDownpayment();
                    }
                },
                error: function(error) {
                    console.log(error);
                    // Handle error here
                }
            });
        });
    });
</script>

{{-- script for auto computation of downpayment and monthly amount --}}
<script>    
    // Function to calculate monthly payment without interest
    function calculateMonthlyPayment() {
        var downpayment = parseFloat($('#downpayment3').val()) || 0;
        var numberOfYears = parseInt($('#noyear3').val()) || 1;

        // Calculate total loan amount (full price - down payment)
        var fullPrice = parseFloat($('#fpayment3').val()) || 0;
        var loanAmount = fullPrice - downpayment;

        // Calculate number of payments
        var numberOfPayments = numberOfYears * 12;

        // Calculate monthly payment
        var monthlyPayment = loanAmount / numberOfPayments;

        // Update the monthly payment field
        $('#mpayment3').val(monthlyPayment.toFixed(2));
    }

    // Bind the function to the input fields' change event
    $('#downpayment3, #noyear3, #fpayment3').on('input', calculateMonthlyPayment);
</script>


{{-- ika4 --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#ptype4').on('change', function(){
            var paymentType4s = $(this).val();

            $.ajax({
                url: '/lot/get-payment-details4/' + paymentType4s,
                type: 'GET',
                success: function(datas) {
                    if (datas.payment_type === 'Cash') {
                        // For Cash payment type
                        $('#onCash4').show();
                        $('#onInstallment4').hide();
                        $('#onInstallmentdown4').hide();
                        $('#full_payment4').val(datas.cash_full_price);

                        // Set mpayment2 input field to none (empty string)
                        $('#mpayment4').val('');
                        // Calculate total downpayment amount when full payment values change
                        calculateTotalDownpayment();
                    } else if (datas.payment_type === 'Installment') {
                        // For Installment payment type
                        $('#onCash4').hide();
                        $('#onInstallment4').show();
                        $('#onInstallmentdown4').show();
                        $('#fpayment4').val(datas.installment_full_price);
                        $('#mpayment4').val('0.00');
                        $('#noyear4').val(datas.no_year);
                        $('#rebate4').val(datas.rebate_price);
                        $('#interest4').val(datas.interest_price);

                        // Update the content of the <small> element
                        $('#downpaymentdetails4').text('Minimum amount is ' + datas.min_amount);

                        // Set full_payment2 input field to none (empty string)
                        $('#full_payment4').val('');
                        // Calculate total downpayment amount when full payment values change
                        calculateTotalDownpayment();
                    }
                },
                error: function(error) {
                    console.log(error);
                    // Handle error here
                }
            });
        });
    });
</script>

{{-- script for auto computation of downpayment and monthly amount --}}
<script>    
    // Function to calculate monthly payment without interest
    function calculateMonthlyPayment() {
        var downpayment = parseFloat($('#downpayment4').val()) || 0;
        var numberOfYears = parseInt($('#noyear4').val()) || 1;

        // Calculate total loan amount (full price - down payment)
        var fullPrice = parseFloat($('#fpayment4').val()) || 0;
        var loanAmount = fullPrice - downpayment;

        // Calculate number of payments
        var numberOfPayments = numberOfYears * 12;

        // Calculate monthly payment
        var monthlyPayment = loanAmount / numberOfPayments;

        // Update the monthly payment field
        $('#mpayment4').val(monthlyPayment.toFixed(2));
    }

    // Bind the function to the input fields' change event
    $('#downpayment4, #noyear4, #fpayment4').on('input', calculateMonthlyPayment);
</script>


@endsection