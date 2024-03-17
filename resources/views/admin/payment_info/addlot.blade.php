@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Add Lot')
@section('payment', 'active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Purchase Application Form</div>
            </div>
            <form action="{{ route('addlot.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group d-flex justify-content-between">
                                <label><h3><b>Lot Purchase Detail</b></h3></label>
                                <input type="hidden" name="customer_id" value="{{ $customer->id }}" hidden>
                                <input type="hidden" class="form-control" name="date_started" id="date2day" value="{{ now()->format('Y-m-d') }}" hidden>
                                <div>
                                    <a type="button" class="btn btn-icon btn-xs btn-success ml-2 add-lot-purchase text-white">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <a type="button" class="btn btn-icon btn-xs btn-danger remove-lot-purchase text-white" style="display: none;">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            @error('lot_id')
                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row lotPurchaseRow">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <a class="btn btn-success text-white" data-toggle="modal" data-target="#chooselotModal">
                                            <span class="btn-label">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                            Choose a Lot
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="section">Section</label>
                                        <input type="text" class="form-control" id="section" disabled>
                                        <input type="hidden" name="lot_id[]" id="lot_id" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lotno">Lot #</label>
                                        <input type="text" class="form-control" id="lotno" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ltype">Lot Type</label>
                                <input type="text" class="form-control" id="ltype" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lclass">Lot Class</label>
                                <input type="text" class="form-control" id="lclass" readonly>
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ptype">Payment Type</label>
                                <input type="hidden" hidden name="ptype_name[]" id="ptype_name">
                                <select class="form-control" name="ptype[]" id="ptype">
                                    <option value="">Sellect a Payment</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 oncash" id="onCash" style="display: none;">
                            <div class="form-group">
                                <label for="full_payment">Cash Full Price</label>
                                <input type="hidden" hidden name="full_payment[]" id="cash_payment">
                                <input type="text" class="form-control" id="full_payment" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 oninstallmentdown" id="onInstallmentdown" style="display: none;">
                            <div class="form-group">
                                <label for="downpayment">Downpayment Amount</label>
                                <input type="number" min="" max="" step=".01" class="form-control" name="downpayment[]" id="downpayment">
                                <small id="downpaymentdetails" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-12 oninstallment" id="onInstallment" style="display: none;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fpayment">Installment Full Price</label>
                                        <input type="text" class="form-control" id="fpayment" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mpayment">Monthly Payment</label>
                                        <input type="text" class="form-control" id="mpayment" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="noyear">No. Years</label>
                                        <input type="number" class="form-control" id="noyear" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="rebate">Rebate</label>
                                        <input type="text" class="form-control" id="rebate" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row lotPurchaseRow1" style="display: none;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <a class="btn btn-success text-white" data-toggle="modal" data-target="#chooselotModal1">
                                            <span class="btn-label">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                            Choose a Lot
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="section">Section</label>
                                        <input type="text" class="form-control" id="section1" disabled>
                                        <input type="hidden" name="lot_id1" id="lot_id1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lotno">Lot #</label>
                                        <input type="text" class="form-control" id="lotno1" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ltype">Lot Type</label>
                                <input type="text" class="form-control" id="ltype1" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lclass">Lot Class</label>
                                <input type="text" class="form-control" id="lclass1" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ptype1">Payment Type</label>
                                <input type="hidden" hidden name="ptype_name1" id="ptype_name1">
                                <select class="form-control" name="ptype1" id="ptype1">
                                    <option value="">Sellect a Payment Type</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 oncash" id="onCash1" style="display: none;">
                            <div class="form-group">
                                <label for="full_payment1">Cash Full Price</label>
                                <input type="hidden" hidden name="cash_payment1" id="cash_payment1">
                                <input type="text" class="form-control" id="full_payment1" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 oninstallmentdown" id="onInstallmentdown1" style="display: none;">
                            <div class="form-group">
                                <label for="downpayment1">Downpayment Amount</label>
                                <input type="number" min="" max="" step=".01" class="form-control" name="downpayment1" id="downpayment1">
                                <small id="downpaymentdetails1" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-12 oninstallment" id="onInstallment1" style="display: none;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fpayment1">Installment Full Price</label>
                                        <input type="text" class="form-control" id="fpayment1" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mpayment1">Monthly Payment</label>
                                        <input type="text" class="form-control" id="mpayment1" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="noyear1">No. Years</label>
                                        <input type="number" class="form-control" id="noyear1" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="rebate1">Rebate</label>
                                        <input type="text" class="form-control" id="rebate1" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row lotPurchaseRow2" style="display: none;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <a class="btn btn-success text-white" data-toggle="modal" data-target="#chooselotModal2">
                                            <span class="btn-label">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                            Choose a Lot
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="section2">Section</label>
                                        <input type="text" class="form-control" id="section2" disabled>
                                        <input type="hidden" name="" id="lot_id2">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lotno2">Lot #</label>
                                        <input type="text" class="form-control" id="lotno2" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ltype2">Lot Type</label>
                                <input type="text" class="form-control" id="ltype2" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lclass2">Lot Class</label>
                                <input type="text" class="form-control" id="lclass2" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ptype1">Payment Type</label>
                                <input type="hidden" hidden name="ptype_name2" id="ptype_name2">
                                <select class="form-control" name="" id="ptype2">
                                    <option value="">Sellect a Payment Type</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 oncash" id="onCash2" style="display: none;">
                            <div class="form-group">
                                <label for="full_payment2">Cash Full Price</label>
                                <input type="text" class="form-control" id="full_payment2" name="full_payment2" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 oninstallmentdown" id="onInstallmentdown2" style="display: none;">
                            <div class="form-group">
                                <label for="downpayment2">Downpayment Amount</label>
                                <input type="number" step=".01" min="" max="" class="form-control" name="downpayment2" id="downpayment2">
                                <small id="downpaymentdetails2" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-12 oninstallment" id="onInstallment2" style="display: none;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fpayment1">Installment Full Price</label>
                                        <input type="text" class="form-control" id="fpayment2" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mpayment2">Monthly Payment</label>
                                        <input type="text" class="form-control" id="mpayment2" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="noyear2">No. Years</label>
                                        <input type="number" class="form-control" id="noyear2" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="rebate2">Rebate</label>
                                        <input type="text" class="form-control" id="rebate2" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row lotPurchaseRow3" style="display: none;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <a class="btn btn-success text-white" data-toggle="modal" data-target="#chooselotModal3">
                                            <span class="btn-label">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                            Choose a Lot
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="section3">Section</label>
                                        <input type="text" class="form-control" id="section3" disabled>
                                        <input type="hidden" name="" id="lot_id3">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lotno3">Lot #</label>
                                        <input type="text" class="form-control" id="lotno3" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ltype3">Lot Type</label>
                                <input type="text" class="form-control" id="ltype3" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lclass3">Lot Class</label>
                                <input type="text" class="form-control" id="lclass3" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ptype3">Payment Type</label>
                                <input type="hidden" hidden name="ptype_name3" id="ptype_name3">
                                <select class="form-control" name="" id="ptype3">
                                    <option value="">Sellect a Payment Type</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 oncash" id="onCash3" style="display: none;">
                            <div class="form-group">
                                <label for="full_payment3">Cash Full Price</label>
                                <input type="text" class="form-control" name="full_payment3" id="full_payment3" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 oninstallmentdown" id="onInstallmentdown3" style="display: none;">
                            <div class="form-group">
                                <label for="downpayment3">Downpayment Amount</label>
                                <input type="number" step=".01" min="" max="" class="form-control" name="downpayment3" id="downpayment3">
                                <small id="downpaymentdetails3" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-12 oninstallment" id="onInstallment3" style="display: none;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fpayment3">Installment Full Price</label>
                                        <input type="text" class="form-control" id="fpayment3" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mpayment3">Monthly Payment</label>
                                        <input type="text" class="form-control" id="mpayment3" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="noyear3">No. Years</label>
                                        <input type="number" class="form-control" id="noyear3" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="rebate3">Rebate</label>
                                        <input type="text" class="form-control" id="rebate3" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row lotPurchaseRow4" style="display: none;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <a class="btn btn-success text-white" data-toggle="modal" data-target="#chooselotModal4">
                                            <span class="btn-label">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                            Choose a Lot
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="section4">Section</label>
                                        <input type="text" class="form-control" id="section4" disabled>
                                        <input type="hidden" name="" id="lot_id4">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lotno4">Lot #</label>
                                        <input type="text" class="form-control" id="lotno4" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ltype4">Lot Type</label>
                                <input type="text" class="form-control" id="ltype4" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lclass4">Lot Class</label>
                                <input type="text" class="form-control" id="lclass4" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ptype1">Payment Type</label>
                                <input type="hidden" hidden name="ptype_name4" id="ptype_name4">
                                <select class="form-control" name="" id="ptype4">
                                    <option value="">Sellect a Payment Type</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 oncash" id="onCash4" style="display: none;">
                            <div class="form-group">
                                <label for="full_payment4">Cash Full Price</label>
                                <input type="text" class="form-control" name="full_payment4" id="full_payment4" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 oninstallmentdown" id="onInstallmentdown4" style="display: none;">
                            <div class="form-group">
                                <label for="downpayment4">Downpayment Amount</label>
                                <input type="number" step=".01" min="" max="" class="form-control" name="downpayment4" id="downpayment4">
                                <small id="downpaymentdetails4" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-12 oninstallment" id="onInstallment4" style="display: none;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fpayment4">Installment Full Price</label>
                                        <input type="text" class="form-control" id="fpayment4" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mpayment4">Monthly Payment</label>
                                        <input type="text" class="form-control" id="mpayment4" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="noyear4">No. Years</label>
                                        <input type="number" class="form-control" id="noyear4" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="rebate4">Rebate</label>
                                        <input type="text" class="form-control" id="rebate4" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date2day">Date</label>
                                        <input type="date" class="form-control" name="date_started" id="date2day" value="{{ now()->format('Y-m-d') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="monthlydue">Monthly Due</label>
                                        <input type="date" class="form-control" id="monthlydue" name="monthly_due" readonly>
                                    </div>
                                </div>
                            </div>
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
                    <a href="{{ route('paymentsdetail', $customer->id) }}" class="btn btn-danger">Cancel</a>
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

{{-- script for auto computing 1 month due --}}
<script>
    $(document).ready(function () {
        // Get the initial value of date2day input
        var initialDate = $('#date2day').val();

        // Add one month to the initial date and set it as the value of monthlydue input
        $('#monthlydue').val(addOneMonth(initialDate));

        // Function to add one month to a given date (format: 'YYYY-MM-DD')
        function addOneMonth(dateString) {
            var date = new Date(dateString);
            date.setMonth(date.getMonth() + 1);
            var month = date.getMonth() + 1; // Month is zero-based
            var day = date.getDate();
            if (month < 10) month = '0' + month;
            if (day < 10) day = '0' + day;
            var year = date.getFullYear();
            return year + '-' + month + '-' + day;
        }

        // Update monthlydue input value when date2day input changes
        $('#date2day').on('change', function () {
            var selectedDate = $(this).val();
            $('#monthlydue').val(addOneMonth(selectedDate));
        });
    });
</script>

{{-- script that shows add lot when addlotpurchase is clicked --}}
<script>
    $(document).ready(function () {
        var currentRow = 1;

        $(".add-lot-purchase").on("click", function () {
            // Show the corresponding lotPurchaseRow
            $(".lotPurchaseRow" + currentRow).show();

            // Set input names to lot_id[] and ptype[]
            $("#lot_id" + currentRow).attr("name", "lot_id[]");
            $("#ptype" + currentRow).attr("name", "ptype[]");
            $("#ptype_name" + currentRow).attr("name", "ptype_name[]");
            $("#downpayment" + currentRow).attr("name", "downpayment[]");
            $("#full_payment" + currentRow).attr("name", "full_payment[]");

            // Show the remove button
            $(".remove-lot-purchase").show();

            // Increment the currentRow for the next click
            currentRow++;

            // Hide add button if all rows are shown
            if (currentRow > 4) {
                $(".add-lot-purchase").hide();
            }

        });

        $(".remove-lot-purchase").on("click", function () {
            // Hide the last shown lotPurchaseRow
            $(".lotPurchaseRow" + (currentRow - 1)).hide();

            // Decrement the currentRow
            currentRow--;

            // Hide remove button if no rows are visible
            if (currentRow === 1) {
                $(".remove-lot-purchase").hide();
            }

            // Remove the name attribute of the corresponding lot_id and ptype inputs
            $("#lot_id" + currentRow).removeAttr("name");
            $("#ptype" + currentRow).removeAttr("name");
            $("#ptype_name" + currentRow).removeAttr("name");
            $("#downpayment" + currentRow).removeAttr("name");
            $("#full_payment" + currentRow).removeAttr("name");


            // Show add button when remove button is clicked
            $(".add-lot-purchase").show();
        });
    });
</script>


{{-- script that calculates for the total amount paid --}}
<script>
    // Function to calculate total downpayment amount
    function calculateTotalDownpayment() {
        var cashFullPrice1 = parseFloat(document.getElementById("full_payment").value) || 0;
        var cashFullPrice2 = parseFloat(document.getElementById("full_payment1").value) || 0;
        var cashFullPrice3 = parseFloat(document.getElementById("full_payment2").value) || 0;
        var cashFullPrice4 = parseFloat(document.getElementById("full_payment3").value) || 0;
        var cashFullPrice5 = parseFloat(document.getElementById("full_payment4").value) || 0;
        var downpayment1 = parseFloat(document.getElementById("downpayment").value) || 0;
        var downpayment2 = parseFloat(document.getElementById("downpayment1").value) || 0;
        var downpayment3 = parseFloat(document.getElementById("downpayment2").value) || 0;
        var downpayment4 = parseFloat(document.getElementById("downpayment3").value) || 0;
        var downpayment5 = parseFloat(document.getElementById("downpayment4").value) || 0;

        var totalCash = cashFullPrice1 + cashFullPrice2 + cashFullPrice3 + cashFullPrice4 + cashFullPrice5;
        var totalDownpayment = totalCash + downpayment1 + downpayment2 + downpayment3 + downpayment4 + downpayment5;
        
        // Update the total downpayment amount field
        document.getElementById("fpamount").value = totalDownpayment;
        // Update the total downpayment amount field
        document.getElementById("fpamount2").value = totalDownpayment;
    }

    // Event listeners to trigger calculation when input values change
    document.getElementById("full_payment").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("full_payment1").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("full_payment2").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("full_payment3").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("full_payment4").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("downpayment").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("downpayment1").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("downpayment2").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("downpayment3").addEventListener("input", calculateTotalDownpayment);
    document.getElementById("downpayment4").addEventListener("input", calculateTotalDownpayment);
</script>




<!-- Modal choosing lot -->
<div class="modal fade lotmodal" id="chooselotModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 60%;">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Lots</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="multi-filter-lots-addowner" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Section #</th>
                                <th>Lot #</th>
                                <th>Type</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Section #</th>
                                <th>Lot #</th>
                                <th>Type</th>
                                <th>Class</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($lots as $lot)
                            <tr>
                                <td>{{ $lot->section }}</td>
                                <td>{{ $lot->lot_no }}</td>
                                <td data-type-id="{{ $lot->lot_type_id }}">
                                    {{ $lot->lotType->lot_type_name }}
                                </td>
                                <td data-class-id="{{ $lot->lot_class_id }}">
                                    @if($lot->lotClass && !empty($lot->lotClass->lot_class_name))
                                        {{ $lot->lotClass->lot_class_name }}
                                    @else
                                        <!-- Handle the case when lot class is empty if necessary -->
                                    @endif
                                </td>
                                <td>{{ $lot->lot_status }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg classchoosebtn" data-original-title="Select Lot" data-lotid="{{ $lot->id }}" id="lotchoosebtn">
                                            <i class="fas fa-check-square"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- script for choosing lot modal and display on input --}}
<script>
    $(document).ready(function() {
        $('.classchoosebtn').click(function() {
            // Get the lot details from the selected row
            var lotId = $(this).data('lotid');
            var section = $(this).closest('tr').find('td:eq(0)').text();
            var lotNumber = $(this).closest('tr').find('td:eq(1)').text();
            var lotType = $(this).closest('tr').find('td:eq(2)').text().trim();
            var lotTypeId = $(this).closest('tr').find('td:eq(2)').data('type-id'); // Get Lot Type ID from data attribute
            var lotClass = $(this).closest('tr').find('td:eq(3)').text().trim();
            var lotClassId = $(this).closest('tr').find('td:eq(3)').data('class-id'); // Get Lot Class ID from data attribute

            // Populate the input fields with the lot details
            $('#section').val(section);
            $('#lotno').val(lotNumber);
            $('#ltype').val(lotType);
            $('#ltypeid').val(lotTypeId); // Set Lot Type ID
            $('#lclass').val(lotClass);
            $('#lclassid').val(lotClassId); // Set Lot Class ID

            // You can also store the selected lot ID if needed
            $('#lot_id').val(lotId);

            // Make an AJAX request to get payment type
            $.ajax({
                url: '/lot/get-payment-type/' + lotTypeId + '/' + lotClassId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                        // Clear existing options in the dropdown
                        $('#ptype').empty();
                        $('#ptype').append('<option value="">Sellect a Payment</option>');
                        // Populate Payment Type dropdown
                        $.each(data.paymentTypes, function(index, paymentType) {
                            $('#ptype').append('<option value="' + paymentType.id + '">' + paymentType.payment_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
            });

            // Close the modal (assuming you are using Bootstrap modal)
            $('#chooselotModal').modal('hide');
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#ptype').on('change', function(){
            var paymentType = $(this).val();

            $.ajax({
                url: '/lot/get-payment-details/' + paymentType,
                type: 'GET',
                success: function(data) {
                    if (data.payment_type === 'Cash') {
                        // For Cash payment type
                        $('#onCash').show();
                        $('#onInstallment').hide();
                        $('#onInstallmentdown').hide();
                        $('#full_payment').val(data.cash_full_price);
                        $('#cash_payment').val(data.cash_full_price);
                        $('#ptype_name').val(data.payment_type);
                        
                        // Set mpayment input field to none (empty string)
                        $('#mpayment').val('');

                        // Calculate total downpayment amount when full payment values change
                        calculateTotalDownpayment();
                    } else if (data.payment_type === 'Installment') {
                        // For Installment payment type
                        $('#onCash').hide();
                        $('#onInstallment').show();
                        $('#onInstallmentdown').show();
                        $('#fpayment').val(data.installment_full_price);
                        $('#mpayment').val('0.00');
                        $('#noyear').val(data.no_year);
                        $('#rebate').val(data.rebate_price);
                        $('#interest').val(data.interest_price);
                        $('#ptype_name').val(data.payment_type);

                        // Set minimum and maximum values for the downpayment input
                        $('#downpayment').attr('min', data.min_amount);
                        $('#downpayment').attr('max', data.installment_full_price);

                        // Update the content of the <small> element
                        $('#downpaymentdetails').text('Minimum amount is ' + data.min_amount);

                        // Set full_payment input field to none (empty string)
                        $('#full_payment').val('');
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
        var downpayment = parseFloat($('#downpayment').val()) || 0;
        var numberOfYears = parseInt($('#noyear').val()) || 1;

        // Calculate total loan amount (full price - down payment)
        var fullPrice = parseFloat($('#fpayment').val()) || 0;
        var loanAmount = fullPrice - downpayment;

        // Calculate number of payments
        var numberOfPayments = numberOfYears * 12;

        // Calculate monthly payment
        var monthlyPayment = loanAmount / numberOfPayments;

        // Update the monthly payment field
        $('#mpayment').val(monthlyPayment.toFixed(2));
    }

    // Bind the function to the input fields' change event
    $('#downpayment, #noyear, #fpayment').on('input', calculateMonthlyPayment);
</script>


{{-- ika1 --}}
<!-- Modal choosing lot -->
<div class="modal fade lotmodal" id="chooselotModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 60%;">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Lots</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="multi-filter-lots-addowner-1" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Section #</th>
                                <th>Lot #</th>
                                <th>Type</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Section #</th>
                                <th>Lot #</th>
                                <th>Type</th>
                                <th>Class</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($lots as $lot)
                            <tr>
                                <td>{{ $lot->section }}</td>
                                <td>{{ $lot->lot_no }}</td>
                                <td data-type-id="{{ $lot->lot_type_id }}">
                                    {{ $lot->lotType->lot_type_name }}
                                </td>
                                <td data-class-id="{{ $lot->lot_class_id }}">
                                    @if($lot->lotClass && !empty($lot->lotClass->lot_class_name))
                                        {{ $lot->lotClass->lot_class_name }}
                                    @else
                                        <!-- Handle the case when lot class is empty if necessary -->
                                    @endif
                                </td>
                                <td>{{ $lot->lot_status }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg classchoosebtn1" data-original-title="Select Lot" data-lotid="{{ $lot->id }}" id="lotchoosebtn">
                                            <i class="fas fa-check-square"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- script for choosing lot modal and display on input --}}
<script>
    $(document).ready(function() {
        $('.classchoosebtn1').click(function() {
            // Get the lot details from the selected row
            var lotId = $(this).data('lotid');
            var section = $(this).closest('tr').find('td:eq(0)').text();
            var lotNumber = $(this).closest('tr').find('td:eq(1)').text();
            var lotType = $(this).closest('tr').find('td:eq(2)').text().trim();
            var lotTypeId = $(this).closest('tr').find('td:eq(2)').data('type-id'); // Get Lot Type ID from data attribute
            var lotClass = $(this).closest('tr').find('td:eq(3)').text().trim();
            var lotClassId = $(this).closest('tr').find('td:eq(3)').data('class-id'); // Get Lot Class ID from data attribute

            // Populate the input fields with the lot details
            $('#section1').val(section);
            $('#lotno1').val(lotNumber);
            $('#ltype1').val(lotType);
            $('#ltypeid1').val(lotTypeId); // Set Lot Type ID
            $('#lclass1').val(lotClass);
            $('#lclassid1').val(lotClassId); // Set Lot Class ID

            // You can also store the selected lot ID if needed
            $('#lot_id1').val(lotId);

            // Make an AJAX request to get payment type
            $.ajax({
                url: '/lot/get-payment-type1/' + lotTypeId + '/' + lotClassId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                        // Clear existing options in the dropdown
                        $('#ptype1').empty();
                        $('#ptype1').append('<option value="">Sellect a Payment</option>');

                        // Populate Payment Type dropdown
                        $.each(data.paymentTypes1, function(index, paymentType1) {
                            $('#ptype1').append('<option value="' + paymentType1.id + '">' + paymentType1.payment_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
            });

            // Close the modal (assuming you are using Bootstrap modal)
            $('#chooselotModal1').modal('hide');
        });
    });
</script>


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
<!-- Modal choosing lot -->
<div class="modal fade lotmodal" id="chooselotModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 60%;">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Lots</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="multi-filter-lots-addowner-2" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Section #</th>
                                <th>Lot #</th>
                                <th>Type</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Section #</th>
                                <th>Lot #</th>
                                <th>Type</th>
                                <th>Class</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($lots as $lot)
                            <tr>
                                <td>{{ $lot->section }}</td>
                                <td>{{ $lot->lot_no }}</td>
                                <td data-type-id="{{ $lot->lot_type_id }}">
                                    {{ $lot->lotType->lot_type_name }}
                                </td>
                                <td data-class-id="{{ $lot->lot_class_id }}">
                                    @if($lot->lotClass && !empty($lot->lotClass->lot_class_name))
                                        {{ $lot->lotClass->lot_class_name }}
                                    @else
                                        <!-- Handle the case when lot class is empty if necessary -->
                                    @endif
                                </td>
                                <td>{{ $lot->lot_status }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg classchoosebtn2" data-original-title="Select Lot" data-lotid="{{ $lot->id }}" id="lotchoosebtn">
                                            <i class="fas fa-check-square"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- script for choosing lot modal and display on input --}}
<script>
    $(document).ready(function() {
        $('.classchoosebtn2').click(function() {
            // Get the lot details from the selected row
            var lotId = $(this).data('lotid');
            var section = $(this).closest('tr').find('td:eq(0)').text();
            var lotNumber = $(this).closest('tr').find('td:eq(1)').text();
            var lotType = $(this).closest('tr').find('td:eq(2)').text().trim();
            var lotTypeId = $(this).closest('tr').find('td:eq(2)').data('type-id'); // Get Lot Type ID from data attribute
            var lotClass = $(this).closest('tr').find('td:eq(3)').text().trim();
            var lotClassId = $(this).closest('tr').find('td:eq(3)').data('class-id'); // Get Lot Class ID from data attribute

            // Populate the input fields with the lot details
            $('#section2').val(section);
            $('#lotno2').val(lotNumber);
            $('#ltype2').val(lotType);
            $('#ltypeid2').val(lotTypeId); // Set Lot Type ID
            $('#lclass2').val(lotClass);
            $('#lclassid2').val(lotClassId); // Set Lot Class ID

            // You can also store the selected lot ID if needed
            $('#lot_id2').val(lotId);

            // Make an AJAX request to get payment type
            $.ajax({
                url: '/lot/get-payment-type2/' + lotTypeId + '/' + lotClassId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                        // Clear existing options in the dropdown
                        $('#ptype2').empty();
                        $('#ptype2').append('<option value="">Sellect a Payment</option>');
                        // Populate Payment Type dropdown
                        $.each(data.paymentTypes2, function(index, paymentType2) {
                            $('#ptype2').append('<option value="' + paymentType2.id + '">' + paymentType2.payment_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
            });

            // Close the modal (assuming you are using Bootstrap modal)
            $('#chooselotModal2').modal('hide');
        });
    });
</script>


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
<!-- Modal choosing lot -->
<div class="modal fade lotmodal" id="chooselotModal3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 60%;">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Lots</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="multi-filter-lots-addowner-3" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Section #</th>
                                <th>Lot #</th>
                                <th>Type</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Section #</th>
                                <th>Lot #</th>
                                <th>Type</th>
                                <th>Class</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($lots as $lot)
                            <tr>
                                <td>{{ $lot->section }}</td>
                                <td>{{ $lot->lot_no }}</td>
                                <td data-type-id="{{ $lot->lot_type_id }}">
                                    {{ $lot->lotType->lot_type_name }}
                                </td>
                                <td data-class-id="{{ $lot->lot_class_id }}">
                                    @if($lot->lotClass && !empty($lot->lotClass->lot_class_name))
                                        {{ $lot->lotClass->lot_class_name }}
                                    @else
                                        <!-- Handle the case when lot class is empty if necessary -->
                                    @endif
                                </td>
                                <td>{{ $lot->lot_status }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg classchoosebtn3" data-original-title="Select Lot" data-lotid="{{ $lot->id }}" id="lotchoosebtn">
                                            <i class="fas fa-check-square"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- script for choosing lot modal and display on input --}}
<script>
    $(document).ready(function() {
        $('.classchoosebtn3').click(function() {
            // Get the lot details from the selected row
            var lotId = $(this).data('lotid');
            var section = $(this).closest('tr').find('td:eq(0)').text();
            var lotNumber = $(this).closest('tr').find('td:eq(1)').text();
            var lotType = $(this).closest('tr').find('td:eq(2)').text().trim();
            var lotTypeId = $(this).closest('tr').find('td:eq(2)').data('type-id'); // Get Lot Type ID from data attribute
            var lotClass = $(this).closest('tr').find('td:eq(3)').text().trim();
            var lotClassId = $(this).closest('tr').find('td:eq(3)').data('class-id'); // Get Lot Class ID from data attribute

            // Populate the input fields with the lot details
            $('#section3').val(section);
            $('#lotno3').val(lotNumber);
            $('#ltype3').val(lotType);
            $('#ltypeid3').val(lotTypeId); // Set Lot Type ID
            $('#lclass3').val(lotClass);
            $('#lclassid3').val(lotClassId); // Set Lot Class ID

            // You can also store the selected lot ID if needed
            $('#lot_id3').val(lotId);

            // Make an AJAX request to get payment type
            $.ajax({
                url: '/lot/get-payment-type3/' + lotTypeId + '/' + lotClassId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                        // Clear existing options in the dropdown
                        $('#ptype3').empty();
                        $('#ptype3').append('<option value="">Sellect a Payment</option>');
                        // Populate Payment Type dropdown
                        $.each(data.paymentTypes3, function(index, paymentType3) {
                            $('#ptype3').append('<option value="' + paymentType3.id + '">' + paymentType3.payment_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
            });

            // Close the modal (assuming you are using Bootstrap modal)
            $('#chooselotModal3').modal('hide');
        });
    });
</script>


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
<!-- Modal choosing lot -->
<div class="modal fade lotmodal" id="chooselotModal4" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 60%;">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Lots</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="multi-filter-lots-addowner-4" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Section #</th>
                                <th>Lot #</th>
                                <th>Type</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Section #</th>
                                <th>Lot #</th>
                                <th>Type</th>
                                <th>Class</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($lots as $lot)
                            <tr>
                                <td>{{ $lot->section }}</td>
                                <td>{{ $lot->lot_no }}</td>
                                <td data-type-id="{{ $lot->lot_type_id }}">
                                    {{ $lot->lotType->lot_type_name }}
                                </td>
                                <td data-class-id="{{ $lot->lot_class_id }}">
                                    @if($lot->lotClass && !empty($lot->lotClass->lot_class_name))
                                        {{ $lot->lotClass->lot_class_name }}
                                    @else
                                        <!-- Handle the case when lot class is empty if necessary -->
                                    @endif
                                </td>
                                <td>{{ $lot->lot_status }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg classchoosebtn4" data-original-title="Select Lot" data-lotid="{{ $lot->id }}" id="lotchoosebtn">
                                            <i class="fas fa-check-square"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- script for choosing lot modal and display on input --}}
<script>
    $(document).ready(function() {
        $('.classchoosebtn4').click(function() {
            // Get the lot details from the selected row
            var lotId = $(this).data('lotid');
            var section = $(this).closest('tr').find('td:eq(0)').text();
            var lotNumber = $(this).closest('tr').find('td:eq(1)').text();
            var lotType = $(this).closest('tr').find('td:eq(2)').text().trim();
            var lotTypeId = $(this).closest('tr').find('td:eq(2)').data('type-id'); // Get Lot Type ID from data attribute
            var lotClass = $(this).closest('tr').find('td:eq(3)').text().trim();
            var lotClassId = $(this).closest('tr').find('td:eq(3)').data('class-id'); // Get Lot Class ID from data attribute

            // Populate the input fields with the lot details
            $('#section4').val(section);
            $('#lotno4').val(lotNumber);
            $('#ltype4').val(lotType);
            $('#ltypeid4').val(lotTypeId); // Set Lot Type ID
            $('#lclass4').val(lotClass);
            $('#lclassid4').val(lotClassId); // Set Lot Class ID

            // You can also store the selected lot ID if needed
            $('#lot_id4').val(lotId);

            // Make an AJAX request to get payment type
            $.ajax({
                url: '/lot/get-payment-type4/' + lotTypeId + '/' + lotClassId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                        // Clear existing options in the dropdown
                        $('#ptype4').empty();
                        $('#ptype4').append('<option value="">Sellect a Payment</option>');
                        // Populate Payment Type dropdown
                        $.each(data.paymentTypes4, function(index, paymentType4) {
                            $('#ptype4').append('<option value="' + paymentType4.id + '">' + paymentType4.payment_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
            });

            // Close the modal (assuming you are using Bootstrap modal)
            $('#chooselotModal4').modal('hide');
        });
    });
</script>


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