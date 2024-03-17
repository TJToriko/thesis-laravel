@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | View Payment')
@section('payment', 'active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Customer Details</h4>
                @if(Auth::user() && Auth::user()->role == 'admin')
                    <div>
                        <button data-original-title="modal" data-target="#delete-modal-customer" data-customer-id="{{ $customer->id }}" class="btn btn-danger delete-customer">
                            Delete
                        </button>                    
                        <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-primary">
                            Edit
                        </a>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Left Portion (Customer's ID) -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ID</label>
                            <div>
                                <img src="{{ asset('images/valid_id_images/' . $customer->valid_id) }}" alt="" width="400px;" height="400px;"> 
                            </div>
                            
                        </div>
                    </div>
            
                    <!-- Middle Portion (Grouped Information) -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Full Name</label>
                            <div><h4><b>{{ $customer->first_name }} {{ $customer->middle_name }} {{ $customer->last_name }} {{ $customer->suffix }}</b></h4></div>
                        </div>
            
                        <div class="form-group">
                            <label>Address (province, city, brgy, street, landmark)</label>
                            <div>
                                <h4><b>
                                        {{ ucwords(strtolower($customer->province)) }},
                                        {{ ucwords(strtolower($customer->city)) }},
                                        {{ ucwords(strtolower($customer->barangay)) }},
                                        {{ $customer->street }}
                                        @if (!empty($customer->landmark))
                                            ({{ $customer->landmark }})
                                        @endif
                                </b></h4>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <label>Email</label>
                            <div><h4><b>{{ $customer->email }}</b></h4></div>
                        </div>
            
                        <div class="form-group">
                            <label>Cellphone #</label>
                            <div><h4><b>{{ $customer->contact_number }}</b></h4></div>
                        </div>
            
                        <div class="form-group">
                            <label>Occupation</label>
                            <div><h4><b>{{ $customer->occupation }}</b></h4></div>
                        </div>
            
                        <div class="form-group">
                            <label>Place of Birth</label>
                            <div><h4><b>{{ $customer->place_of_birth }}</b></h4></div>
                        </div>
            
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <div><h4><b>{{ $customer->date_of_birth }}</b></h4></div>
                        </div>
            
                        <div class="form-group">
                            <label>Sex</label>
                            <div><h4><b>{{ $customer->sex }}</b></h4></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><h3>Beneficiary</h3></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Right Portion (Beneficiary Details) -->
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Full Name</label>
                            <div><h4><b>{{ $customer->benificiary_fullname }}</b></h4></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <div><h4><b>{{ $customer->benificiary_date_of_birth }}</b></h4></div>
                        </div>
                    </div>
        
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Relationship</label>
                            <div><h4><b>{{ $customer->relationship }}</b></h4></div>
                        </div>
                    </div>
 
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Lot Owned Details</h4>
                @if(Auth::user() && Auth::user()->role == 'admin')
                    <div>
                        <a href="{{ route('addlot.view', $customer->id) }}" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Add Lot
                        </a>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables-paymentdetaillot" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Section</th>
                                <th>Lot #</th>
                                <th>Lot Type</th>
                                <th>Lot Class</th>
                                <th>Status</th>
                                <th>Type</th>
                                <th>Downpayment</th>
                                <th>Total Amount Paid</th>
                                <th>Total Rebate Amount</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customerlots as $customerlot)
                                <tr>
                                    <td>{{ $customerlot->lot->section }}</td>
                                    <td>{{ $customerlot->lot->lot_no }}</td>
                                    <td>{{ $customerlot->lot->lotType->lot_type_name }}</td>
                                    <td>{{ $customerlot->lot->lotClass->lot_class_name }}</td>
                                    <td>{{ $customerlot->status }}</td>
                                    <td>{{ $customerlot->paymentsetting->payment_name }}</td>
                                    <td>&#8369; {{ number_format($customerlot->downpayment, 2) }}</td>
                                    <td>&#8369; {{ number_format($customerlot->total_amount_paid, 2) }}</td>
                                    <td>&#8369; {{ number_format($customerlot->total_rebate_amount, 2) }}</td>
                                    <td>
                                        {{-- Computation for the balance --}}
                                        @php
                                            $balance = $customerlot->paymentsetting->installment_full_price - ($customerlot->total_amount_paid + $customerlot->total_rebate_amount);
                                            
                                            // If payment type is Cash, set balance to 0.00
                                            if ($customerlot->paymentsetting->payment_type == 'Cash') {
                                                $balance = 0.00;
                                            }
                                        @endphp
                                        &#8369; {{ number_format($balance, 2) }}
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

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Payments</h4>
                <div>
                    <button class="btn btn-success" data-toggle="modal" data-target="#addFullPayments">
                        <span class="btn-label">
                            <i class="fa fa-plus"></i>
                        </span>
                        Pay Full Payment
                    </button>
                    <button class="btn btn-success" data-toggle="modal" data-target="#addPayments">
                        <span class="btn-label">
                            <i class="fa fa-plus"></i>
                        </span>
                        Add Payment
                    </button>

                        <!-- Modal adding lot type -->
                        <div class="modal fade" id="addPayments" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            Date of Today ({{ now()->format('Y-m-d') }})</span> 
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('payments.add') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group d-flex justify-content-between">
                                                        <label><h3><b>Payments</b></h3></label>
                                                        <div>
                                                            <a type="button" class="btn btn-icon btn-xs btn-success ml-2 add-payment text-white">
                                                                <i class="fas fa-plus"></i>
                                                            </a>
                                                            <a type="button" class="btn btn-icon btn-xs btn-danger remove-payment text-white" style="display: none;">
                                                                <i class="fas fa-times"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="date" hidden class="form-control" id="today_date" name="today_date" value="{{ now()->format('Y-m-d') }}">

                                            <div class="row paymentRow">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lot">Lot</label>
                                                        <select id="lot" class="form-control" required>
                                                            <option value="">Select a Lot</option>
                                                            @foreach ($customerlotpayments as $customerlot)
                                                                <option value="{{ $customerlot->id }}">{{ $customerlot->lot->section }}, {{ $customerlot->lot->lot_no }}, {{ $customerlot->lot->lotType->lot_type_name }}, {{ $customerlot->lot->lotClass->lot_class_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="date">Payment's Date</label>
                                                        <select name="payment_id[]" class="form-control" id="payment_date" required>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="amount">Monthly Amount</label>
                                                        <input type="text" class="form-control" id="amount" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="rebate">Rebate</label>
                                                        <input type="text" class="form-control" id="rebate" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="total">Payment</label>
                                                        <input type="hidden" name="amount_paid[]" hidden id="amount_paid">
                                                        <input type="text" class="form-control" id="total" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row paymentRow1" style="display: none;">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lot">Lot</label>
                                                        <select name="payment_id1" id="lot1" class="form-control">
                                                            <option value="">Select a Lot</option>
                                                            @foreach ($customerlotpayments as $customerlot)
                                                                <option value="{{ $customerlot->id }}">{{ $customerlot->lot->section }}, {{ $customerlot->lot->lot_no }}, {{ $customerlot->lot->lotType->lot_type_name }}, {{ $customerlot->lot->lotClass->lot_class_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="date">Payment's Date</label>
                                                        <select name="date_id1" class="form-control" id="payment_date1">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="amount">Monthly Amount</label>
                                                        <input type="text" class="form-control" id="amount1" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="rebate">Rebate</label>
                                                        <input type="text" class="form-control" id="rebate1" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="total">Payment</label>
                                                        <input type="hidden" name="amount_paid1" hidden id="amount_paid1">
                                                        <input type="text" class="form-control" id="total1" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row paymentRow2" style="display: none;">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lot">Lot</label>
                                                        <select name="payment_id2" id="lot2" class="form-control">
                                                            <option value="">Select a Lot</option>
                                                            @foreach ($customerlotpayments as $customerlot)
                                                                <option value="{{ $customerlot->id }}">{{ $customerlot->lot->section }}, {{ $customerlot->lot->lot_no }}, {{ $customerlot->lot->lotType->lot_type_name }}, {{ $customerlot->lot->lotClass->lot_class_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="date">Payment's Date</label>
                                                        <select name="date_id2" class="form-control" id="payment_date2">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="amount">Monthly Amount</label>
                                                        <input type="text" class="form-control" id="amount2" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="rebate">Rebate</label>
                                                        <input type="text" class="form-control" id="rebate2" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="total">Payment</label>
                                                        <input type="hidden" name="amount_paid2" hidden id="amount_paid2">
                                                        <input type="text" class="form-control" id="total2" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row paymentRow3" style="display: none;">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lot">Lot</label>
                                                        <select name="payment_id3" id="lot3" class="form-control">
                                                            <option value="">Select a Lot</option>
                                                            @foreach ($customerlotpayments as $customerlot)
                                                                <option value="{{ $customerlot->id }}">{{ $customerlot->lot->section }}, {{ $customerlot->lot->lot_no }}, {{ $customerlot->lot->lotType->lot_type_name }}, {{ $customerlot->lot->lotClass->lot_class_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="date">Payment's Date</label>
                                                        <select name="date_id3" class="form-control" id="payment_date3">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="amount">Monthly Amount</label>
                                                        <input type="text" class="form-control" id="amount3" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="rebate">Rebate</label>
                                                        <input type="text" class="form-control" id="rebate3" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="total">Payment</label>
                                                        <input type="hidden" name="amount_paid3" hidden id="amount_paid3">
                                                        <input type="text" class="form-control" id="total3" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="total_payment">Total Payment</label>
                                                        <input type="hidden" name="total_payment" id="total_payment2" hidden>
                                                        <input type="text" class="form-control" id="total_payment" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer no-bd">
                                            <button type="submit" id="addRowButton" class="btn btn-success">Submit</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal adding lot type -->
                        <div class="modal fade" id="addFullPayments" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            Date of Today ({{ now()->format('Y-m-d') }})</span> 
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('payment.full') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group d-flex justify-content-between">
                                                        <label><h3><b>Payments</b></h3></label>
                                                        <div>
                                                            <a type="button" class="btn btn-icon btn-xs btn-success ml-2 add-payment text-white">
                                                                <i class="fas fa-plus"></i>
                                                            </a>
                                                            <a type="button" class="btn btn-icon btn-xs btn-danger remove-payment text-white" style="display: none;">
                                                                <i class="fas fa-times"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="lot">Lot</label>
                                                        <select id="lot_full" name="lot_id" class="form-control" required>
                                                            <option value="">Select a Lot</option>
                                                            @foreach ($customerlotpayments as $customerlot)
                                                                <option value="{{ $customerlot->id }}">{{ $customerlot->lot->section }}, {{ $customerlot->lot->lot_no }}, {{ $customerlot->lot->lotType->lot_type_name }}, {{ $customerlot->lot->lotClass->lot_class_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="amount">Monthly Amount</label>
                                                        <input type="text" class="form-control" id="fullamount" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="rebate">Rebate</label>
                                                        <input type="text" class="form-control" id="fullrebate" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="total">Total Full Monthly Amount</label>
                                                        <input type="text" class="form-control" id="totalfullmonthlyamount" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="rebate">Total Full Rebate</label>
                                                        <input type="text" class="form-control" id="totalfullrebate" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="total">Total Payment</label>
                                                        <input type="text" class="form-control" id="totalfullpayment" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer no-bd">
                                            <button type="submit" id="addRowButton" class="btn btn-success">Submit</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatables-paymentdetail" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Section</th>
                                <th>Lot #</th>
                                <th>Lot Type</th>
                                <th>Lot Class</th>
                                <th>Date Paid</th>
                                <th>Due Date</th>
                                <th>Payment Amount</th>
                                <th>Amount Paid</th>
                                <th>Status</th>
                                <th>Type</th>
                                @if(Auth::user() && Auth::user()->role == 'admin')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tfoot>
                            <th>Section</th>
                            <th>Lot #</th>
                            <th>Lot Type</th>
                            <th>Lot Class</th>
                        </tfoot>
                        <tbody>
                            @foreach ($duedates as $duedate)
                                <tr>
                                    <td>{{ $duedate->payment->lot->section }}</td>
                                    <td>{{ $duedate->payment->lot->lot_no }}</td>
                                    <td>{{ $duedate->payment->lot->lotType->lot_type_name }}</td>
                                    <td>{{ $duedate->payment->lot->lotClass->lot_class_name }}</td>
                                    <td>{{ $duedate->date }}</td>
                                    <td>{{ $duedate->due_date }}</td>
                                    <td>&#8369; {{ number_format($duedate->price_monthly, 2) }}</td>
                                    <td>
                                        @if(!empty($duedate->amount_paid))
                                            &#8369; {{ number_format($duedate->amount_paid, 2) }}
                                        @else 
                                            
                                        @endif
                                    </td>
                                    <td>{{ $duedate->payment_status }}</td>
                                    <td>{{ $duedate->type }}</td>
                                    @if(Auth::user() && Auth::user()->role == 'admin')
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-toggle="tooltip" class="btn btn-link btn-danger delete-deceased" data-original-title="Reset Payment Detail" data-deceased-id="">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var originalMonthlyPrice;
        var rebatePrice;

        $('#lot_full').on('change', function(){
            var lotId = $(this).val();

            $.ajax({
                url: '/payments/get-full-price/' + lotId,
                type: 'GET',
                success: function(datas) {
                    originalMonthlyPrice = datas.paymenttracker.price_monthly;
                    rebatePrice = datas.rebateAmount.rebate_price;
                    totalRebateAmount = datas.totalRebateAmount;
                    totalfullamount = parseFloat(datas.totalfullamount).toFixed(2); // Round to 2 decimal places
                    totalMonthlyAmount = parseFloat(datas.totalMonthlyAmount).toFixed(2);

                    $('#fullamount').val(originalMonthlyPrice);
                    $('#fullrebate').val(rebatePrice);
                    $('#totalfullpayment').val(totalfullamount);
                    $('#totalfullrebate').val(totalRebateAmount);
                    $('#totalfullmonthlyamount').val(totalMonthlyAmount);
                },
                error: function(error) {
                    console.log(error);
                    // Handle error here
                }
            });
        });
    });
</script>

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

{{-- script that shows add payment when showpayment is clicked --}}
<script>
    $(document).ready(function () {
        var currentRow = 1;

        $(".add-payment").on("click", function () {
            // Show the corresponding lotPurchaseRow
            $(".paymentRow" + currentRow).show();

            // Set input names
            $("#payment_date" + currentRow).attr("name", "payment_id[]");
            $("#amount_paid" + currentRow).attr("name", "amount_paid[]");
            // Set input as required
            $("#payment_date" + currentRow).prop("required", true);
            $("#lot" + currentRow).prop("required", true);


            // Show the remove button
            $(".remove-payment").show();

            // Increment the currentRow for the next click
            currentRow++;

            // Hide add button if all rows are shown
            if (currentRow > 4) {
                $(".add-payment").hide();
            }

        });

        $(".remove-payment").on("click", function () {
            // Hide the last shown lotPurchaseRow
            $(".paymentRow" + (currentRow - 1)).hide();

            // Decrement the currentRow
            currentRow--;

            // Hide remove button if no rows are visible
            if (currentRow === 1) {
                $(".remove-payment").hide();
            }

            // Remove the name attribute of the corresponding lot_id and ptype inputs
            $("#payment_date" + currentRow).removeAttr("name");
            // Remove the required attribute
            $("#payment_date" + currentRow).prop("required", false);
            $("#lot" + currentRow).prop("required", false);



            // Show add button when remove button is clicked
            $(".add-payment").show();
        });
    });
</script>

{{-- script that calculates all payments and display to total amount --}}
<script>
        // Function to calculate and update the total
        function updateTotal() {
            // Get the values of total1, total2, and total3
            var totalValue = parseFloat($("#total").val()) || 0;
            var total1Value = parseFloat($("#total1").val()) || 0;
            var total2Value = parseFloat($("#total2").val()) || 0;
            var total3Value = parseFloat($("#total3").val()) || 0;

            // Calculate the sum of the values
            var totalSum = totalValue + total1Value + total2Value + total3Value;

            // Display the sum in total_payment
            $("#total_payment").val(totalSum);
            $("#total_payment2").val(totalSum);
        }

        // Add an event listener for input changes in total1, total2, and total3
        $("#total, #total1, #total2, #total3").on("input", function () {
            updateTotal();
        });
</script>

<!-- Delete confirmation modal for customer -->
<div id="delete-modal-customer" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to Delete this?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger delete-customer-button">Delete</button>
            </div>
        </div>
    </div>
</div>

{{-- script for deleting and then shows toast --}}
<script>
    $(document).ready(function() {
    var customerId; // Variable to store the Lot Type ID

    $(document).on('click', '.delete-customer', function(e) {
        e.preventDefault();

        customerId = $(this).data('customer-id');

        // Show the delete confirmation modal
        $('#delete-modal-customer').modal('show');
    });

    // Handle delete button click event inside the modal
    $(document).on('click', '.delete-customer-button', function(e) {
        e.preventDefault();

        // Send an AJAX request to delete the Lot Type
        $.ajax({
            url: '{{ route('customer.destroy') }}',
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
                "customerId": customerId
            },
            success: function(response) {
                if (response.success) {
                    // Remove the Lot Type row from the DOM
                    $('[data-customer-id="' + paymentId + '"]').remove();
                    // Show the success toast message
                } else {
                    console.log(response.message); // Handle the failure message
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Handle the error response
            }
        });

        // Hide the delete confirmation modal
        $('#delete-modal-customer').modal('hide');
    });

    });
</script>



<script type="text/javascript">
    $(document).ready(function () {
        var originalMonthlyPrice;
        var rebatePrice;

        // Change event handler for the lot select
        $('#lot').on('change', function () {
            var lotId = $(this).val();

            $.ajax({
                url: '/payments/get-due-dates/' + lotId,
                type: 'GET',
                success: function (datas) {
                    // Populate the due dates dropdown
                    populateDueDatesDropdown(datas.dueDates);
                },
                error: function (error) {
                    console.log(error);
                    // Handle error here
                }
            });
        });

        // Change event handler for the payment date select
        $('#payment_date').on('change', function () {
            var paymenttrackerId = $(this).val();

            $.ajax({
                url: '/payments/get-monthly-price/' + paymenttrackerId,
                type: 'GET',
                success: function (datas) {
                    originalMonthlyPrice = datas.paymenttracker.price_monthly;
                    rebatePrice = datas.rebateAmount.rebate_price;

                    $('#amount').val(originalMonthlyPrice);
                    $('#rebate').val(rebatePrice);
                    
                    updatePaymentrow();
                },
                error: function (error) {
                    console.log(error);
                    // Handle error here
                }
            });
        });

        // Function to populate due dates in the dropdown
        function populateDueDatesDropdown(dueDates) {
            var selectDropdown = $('#payment_date');
            selectDropdown.empty();

            // Add default option
            selectDropdown.append($('<option>', {
                value: '',
                text: 'Select Payment Due Date'
            }));

            // Add options for each due date
            dueDates.forEach(function (dueDate) {
                selectDropdown.append($('<option>', {
                    value: dueDate.id,
                    text: dueDate.due_date
                }));
            });

            // Trigger the change event on page load to calculate initial total
            $('#payment_date').change();
        }

        // Function to update the total based on selected payment date
        function updatePaymentrow() {
            var dueDateText = $('#payment_date').find('option:selected').text();
            var dueDate = new Date(dueDateText);
            var today = new Date($('#today_date').val());
            var monthlyAmount = parseFloat(originalMonthlyPrice) || 0;
            var rebate = parseFloat(rebatePrice) || 0;
            var total = (today < dueDate) ? (monthlyAmount - rebate) : monthlyAmount;

            $('#total').val(total.toFixed(2));
            $('#amount_paid').val(total.toFixed(2));

            updateTotal();
        }
    });
</script>



{{-- ika 1 --}}
{{-- script for fetching the due dates base on the lot id --}}
<script type="text/javascript">
    $(document).ready(function(){
        var originalMonthlyPrice;
        var rebatePrice;

        $('#lot1').on('change', function(){
            var lotId = $(this).val();

            $.ajax({
                url: '/payments/get-monthly-price1/' + lotId,
                type: 'GET',
                success: function(datas) {
                    originalMonthlyPrice = datas.paymenttracker.price_monthly;
                    rebatePrice = datas.rebateAmount.rebate_price;

                    $('#amount1').val(originalMonthlyPrice);
                    $('#rebate1').val(rebatePrice);

                    // Populate the due dates dropdown
                    populateDueDatesDropdown(datas.dueDates);
                },
                error: function(error) {
                    console.log(error);
                    // Handle error here
                }
            });
        });

        // Function to populate due dates in the dropdown
        function populateDueDatesDropdown(dueDates) {
            var selectDropdown = $('#payment_date1');
            selectDropdown.empty();

            // Add default option
            selectDropdown.append($('<option>', {
                value: '',
                text: 'Select Payment Due Date'
            }));

            // Add options for each due date
            dueDates.forEach(function(dueDate) {
                selectDropdown.append($('<option>', {
                    value: dueDate.id, // Adjust accordingly based on your data structure
                    text: dueDate.due_date // Modify as needed
                }));
            });
        }
    });
</script>

{{-- script computes for the payment of the certain date paid --}}
<script>
    $(document).ready(function () {
        // Change event handler for the payment date select
        $('#payment_date1').change(function () {
            // Get the selected option's text (due date)
            var dueDateText = $(this).find('option:selected').text();

            // Convert due date text to a JavaScript Date object
            var dueDate = new Date(dueDateText);

            // Get today's date
            var today = new Date($('#today_date').val());

            // Get the monthly amount and rebate values
            var monthlyAmount = parseFloat($('#amount1').val()) || 0;
            var rebate = parseFloat($('#rebate1').val()) || 0;

            // Calculate the total based on the conditions
            var total = (today < dueDate) ? (monthlyAmount - rebate) : monthlyAmount;

            // Display the calculated total in the 'total' input
            $('#total1').val(total.toFixed(2));

            // If you need to update a hidden field with the calculated amount_paid value
            $('#amount_paid1').val(total.toFixed(2));

            // Call the function to update the total based on other inputs
            updateTotal();
        });

        // Trigger the change event on page load to calculate initial total
        $('#payment_date1').change();
    });
</script>

{{-- ika 2 --}}
{{-- script for fetching the due dates base on the lot id --}}
<script type="text/javascript">
    $(document).ready(function(){
        var originalMonthlyPrice;
        var rebatePrice;

        $('#lot2').on('change', function(){
            var lotId = $(this).val();

            $.ajax({
                url: '/payments/get-monthly-price2/' + lotId,
                type: 'GET',
                success: function(datas) {
                    originalMonthlyPrice = datas.paymenttracker.price_monthly;
                    rebatePrice = datas.rebateAmount.rebate_price;

                    $('#amount2').val(originalMonthlyPrice);
                    $('#rebate2').val(rebatePrice);

                    // Populate the due dates dropdown
                    populateDueDatesDropdown(datas.dueDates);
                },
                error: function(error) {
                    console.log(error);
                    // Handle error here
                }
            });
        });

        // Function to populate due dates in the dropdown
        function populateDueDatesDropdown(dueDates) {
            var selectDropdown = $('#payment_date2');
            selectDropdown.empty();

            // Add default option
            selectDropdown.append($('<option>', {
                value: '',
                text: 'Select Payment Due Date'
            }));

            // Add options for each due date
            dueDates.forEach(function(dueDate) {
                selectDropdown.append($('<option>', {
                    value: dueDate.id, // Adjust accordingly based on your data structure
                    text: dueDate.due_date // Modify as needed
                }));
            });
        }
    });
</script>

{{-- script computes for the payment of the certain date paid --}}
<script>
    $(document).ready(function () {
        // Change event handler for the payment date select
        $('#payment_date2').change(function () {
            // Get the selected option's text (due date)
            var dueDateText = $(this).find('option:selected').text();

            // Convert due date text to a JavaScript Date object
            var dueDate = new Date(dueDateText);

            // Get today's date
            var today = new Date($('#today_date').val());

            // Get the monthly amount and rebate values
            var monthlyAmount = parseFloat($('#amount2').val()) || 0;
            var rebate = parseFloat($('#rebate2').val()) || 0;

            // Calculate the total based on the conditions
            var total = (today < dueDate) ? (monthlyAmount - rebate) : monthlyAmount;

            // Display the calculated total in the 'total' input
            $('#total2').val(total.toFixed(2));

            // If you need to update a hidden field with the calculated amount_paid value
            $('#amount_paid2').val(total.toFixed(2));

            // Call the function to update the total based on other inputs
            updateTotal();
        });

        // Trigger the change event on page load to calculate initial total
        $('#payment_date2').change();
    });
</script>

{{-- ika 3 --}}
{{-- script for fetching the due dates base on the lot id --}}
<script type="text/javascript">
    $(document).ready(function(){
        var originalMonthlyPrice;
        var rebatePrice;

        $('#lot3').on('change', function(){
            var lotId = $(this).val();

            $.ajax({
                url: '/payments/get-monthly-price3/' + lotId,
                type: 'GET',
                success: function(datas) {
                    originalMonthlyPrice = datas.paymenttracker.price_monthly;
                    rebatePrice = datas.rebateAmount.rebate_price;

                    $('#amount3').val(originalMonthlyPrice);
                    $('#rebate3').val(rebatePrice);

                    // Populate the due dates dropdown
                    populateDueDatesDropdown(datas.dueDates);
                },
                error: function(error) {
                    console.log(error);
                    // Handle error here
                }
            });
        });

        // Function to populate due dates in the dropdown
        function populateDueDatesDropdown(dueDates) {
            var selectDropdown = $('#payment_date3');
            selectDropdown.empty();

            // Add default option
            selectDropdown.append($('<option>', {
                value: '',
                text: 'Select Payment Due Date'
            }));

            // Add options for each due date
            dueDates.forEach(function(dueDate) {
                selectDropdown.append($('<option>', {
                    value: dueDate.id, // Adjust accordingly based on your data structure
                    text: dueDate.due_date // Modify as needed
                }));
            });
        }
    });
</script>

{{-- script computes for the payment of the certain date paid --}}
<script>
    $(document).ready(function () {
        // Change event handler for the payment date select
        $('#payment_date3').change(function () {
            // Get the selected option's text (due date)
            var dueDateText = $(this).find('option:selected').text();

            // Convert due date text to a JavaScript Date object
            var dueDate = new Date(dueDateText);

            // Get today's date
            var today = new Date($('#today_date').val());

            // Get the monthly amount and rebate values
            var monthlyAmount = parseFloat($('#amount3').val()) || 0;
            var rebate = parseFloat($('#rebate3').val()) || 0;

            // Calculate the total based on the conditions
            var total = (today < dueDate) ? (monthlyAmount - rebate) : monthlyAmount;

            // Display the calculated total in the 'total' input
            $('#total3').val(total.toFixed(2));

            // If you need to update a hidden field with the calculated amount_paid value
            $('#amount_paid3').val(total.toFixed(2));

            // Call the function to update the total based on other inputs
            updateTotal();
        });

        // Trigger the change event on page load to calculate initial total
        $('#payment_date3').change();
    });
</script>

@endsection