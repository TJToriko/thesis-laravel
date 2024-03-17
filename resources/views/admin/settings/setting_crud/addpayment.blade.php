@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Payment Settings')
@section('psetting', 'active')
@section('psetting_show', 'show')

@section('content')
<div class="page-header">
    <h4 class="page-title">Settings</h4>
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
            <a href="#">Settings</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="{{ route('psetting') }}">Payment Settings</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Add Payment</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add Payment Option</div>
            </div>
            <form action="{{ route('apsetting.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ltype">Lot Type</label>
                                        <select class="select2-ltype form-control" name="lot_type_id" id="ltype" required>
                                            <option value="">>>Select<<</option>
                                            @foreach($lottype as $ltype)
                                                <option value="{{ $ltype->id }}">{{ ucwords(strtolower($ltype->lot_type_name)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lclass">Lot Class</label>
                                        <select class="select2-lclass form-control" name="lot_class_id" id="lclass">
                                            <option value="">>>Select<<</option>
                                            @foreach($lotclass as $lclass)
                                                <option value="{{ $lclass->id }}">{{ ucwords(strtolower($lclass->lot_class_name)) }}</option>
                                            @endforeach
                                        </select>
                                        @error('lot_class_id')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pname">Payment Name</label>
                                        <input type="text" name="payment_name" class="form-control" id="pname" placeholder="Enter Payment Name" required>
                                        @error('payment_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                                    <li class="nav-item" id="cashlist">
                                        <label for="cashRadio" class="nav-link active" id="pills-home-tab-nobd" data-toggle="pill" href="#pills-home-nobd" role="tab" aria-controls="pills-home-nobd" aria-selected="true">Cash</label>
                                        <input class="form-check-input" type="radio" hidden name="payment_type" id="cashRadio" value="Cash" checked>
                                    </li>
                                    <li class="nav-item" id="installmentlist">
                                        <label for="installmentRadio" class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false">Installment</label>
                                        <input class="form-check-input" type="radio" hidden name="payment_type" id="installmentRadio" value="Installment">
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                                <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fullprice">Full Price</label>
                                            <input type="text" name="cash_full_price" class="form-control" id="fullprice" placeholder="Enter Full Price">
                                            @error('cash_full_price')
                                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="fprice">Full Price</label>
                                                <input type="text" class="form-control" id="fprice" placeholder="Enter Full Price" name="installment_full_price" value="">
                                                @error('installment_full_price')
                                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="noyear">No. Of Years</label>
                                                <input type="number" class="form-control" id="noyear" placeholder="Enter Number Of Years" min="1" value="1" name="no_year">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mprice">Monthly Price</label>
                                                <input type="text" class="form-control" id="mprice" placeholder="Enter Monthly Price" name="installment_monthly_price" value="">
                                                @error('installment_monthly_price')
                                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" value="yes" checked name="with_rebate" id="with_rebate">
                                                            <span class="form-check-sign">With Rebate</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-top: -19px;">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="rebate_price" placeholder="Enter Rebate Price" name="rebate_price">
                                                        @error('rebate_price')
                                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" >
                                            <div class="form-group">
                                                <label for="min_amount">Min. Price</label>
                                                <input type="text" class="form-control" id="min_amount" placeholder="Enter Minimum Price Amount" name="min_amount">
                                                @error('min_amount')
                                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{ route('psetting') }}" class="btn btn-danger">Back</a>
                </div>
            </form>
        </div>
    </div>

</div>


{{-- script for auto computing the full price and the monthly price --}}
<script>
    // Wait for the document to be ready
    $(document).ready(function() {
        // Get references to the input fields
        var fpriceInput = $('#fprice');
        var noyearInput = $('#noyear');
        var mpriceInput = $('#mprice');

        // Add input event listener for fprice input
        fpriceInput.on('input', function() {
            calculateMonthlyPriceFromFullPrice();
        });

        // Add input event listener for mprice input
        mpriceInput.on('input', function() {
            calculateFullPriceFromMonthlyPrice();
        });

        // Add input event listener for noyear input
        noyearInput.on('input', function() {
            calculateMonthlyPriceFromFullPrice();
        });

        function calculateMonthlyPriceFromFullPrice() {
            // Get values from input fields
            var fpriceValue = parseFloat(fpriceInput.val()) || 0; // Convert to float or default to 0
            var noyearValue = parseFloat(noyearInput.val()) || 1; // Convert to float or default to 0

            // Calculate monthly price
            var monthlyPrice = (fpriceValue / (noyearValue * 12)).toFixed(2);

            // Update the monthly price input field
            mpriceInput.val(monthlyPrice);
        }

        function calculateFullPriceFromMonthlyPrice() {
            // Get values from input fields
            var mpriceValue = parseFloat(mpriceInput.val()) || 0; // Convert to float or default to 0
            var noyearValue = parseFloat(noyearInput.val()) || 1; // Convert to float or default to 0

            // Calculate full price
            var fullPrice = (mpriceValue * noyearValue * 12).toFixed(2);

            // Update the full price input field
            fpriceInput.val(fullPrice);
        }
    });
</script>

{{-- listener that would mark check the input radio --}}
<script>
    // Get the list elements by their IDs
    const cashList = document.getElementById("cashlist");
    const installmentList = document.getElementById("installmentlist");

    // Get the radio buttons by their IDs
    const cashRadio = document.getElementById("cashRadio");
    const installmentRadio = document.getElementById("installmentRadio");

    // Add click event listeners to the list elements
    cashList.addEventListener("click", function () {
        // Check the cash radio button when the cash list is clicked
        cashRadio.checked = true;
    });

    installmentList.addEventListener("click", function () {
        // Check the installment radio button when the installment list is clicked
        installmentRadio.checked = true;
    });
</script>

{{-- script for hiding the rebate price when its unchecked --}}
<script>
    $(document).ready(function() {
        // Add change event listener to the checkbox
        $('#with_rebate').change(function() {
            if ($(this).prop('checked')) {
                // If checkbox is checked, show the rebate price input
                $('#rebate_price').show();
            } else {
                // If checkbox is unchecked, hide the rebate price input and clear its value
                $('#rebate_price').hide().val('');
            }
        });
    });
</script>
@endsection