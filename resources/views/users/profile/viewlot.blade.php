@extends('users.user_layouts.app')

@section('page_title', 'Hillside Memorial Garden | My Lots')

@section('content')


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">
  
            <div class="row justify-content-center">
                <div class="col-md-4">
                    @include('users.profile.sidebar.sidebar')
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            {{ __('Dashboard') }}
                        </div>
                        <div class="card-body mt-2">
                            {{-- Lot No.: {{ $userlot->lot->lot_no }} <br>	
                            Lot Type: {{ $userlot->lot->lotType->lot_type_name }} <br>	
                            Lot Class: {{ $userlot->lot->lotClass->lot_class_name }} <br>
                            Status: {{ $userlot->status }} <br>
                            Payment Type: {{ $userlot->paymentsetting->payment_name }} <br>
                            Downpayment: &#8369; {{ $userlot->downpayment }}<br>
                            Total Amount Paid: &#8369; {{ $userlot->total_amount_paid }}<br>	
                            Total Rebated Amount: {{ $userlot->total_rebate_amount }} <br>
                            Balance: &#8369; {{ $userlot->status }}<br>
                            Pay Thru: {{ $userlot->pay_thru }} <br> --}}
                            <div class="records">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="records-status">
                                            <span>
                                                Cancel/Reject Reason: @if ($userlot->status == 'Rejected' || $userlot->status == 'Cancelled')
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Show</button> @else - @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="text-end mb-3">
                                            <label for="">Status: </label>
                                            
                                                @if ($userlot->status == 'Pending')
                                                    <span class="badge text-bg-warning p-2">Pending</span>
                                                @elseif ($userlot->status == 'Fully Paid')
                                                    <span class="badge text-bg-success p-2">Fully Paid</span>
                                                @elseif ($userlot->status == 'Partial')
                                                    <span class="badge text-bg-primary p-2">Partial</span>
                                                @elseif ($userlot->status == 'Cancelled')
                                                    <span class="badge text-bg-danger p-2">Cancelled</span>
                                                @elseif ($userlot->status == 'Rejected')
                                                    <span class="badge text-bg-danger p-2">Rejected</span>
                                                @elseif ($userlot->status == 'Waived')
                                                    <span class="badge text-bg-dark p-2">Waived</span>
                                                @endif
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row ">
                                    <div class="col-lg-6 ">
                                        <div class="border rounded p-3">
                                            <div class="d-flex justify-content-between align-items-center px-4">
                                                <label for="">Lot No:</label>
                                                <span>{{ $userlot->lot->lot_no }}</span>
                                            </div><div class="d-flex justify-content-between align-items-center px-4">
                                                <label for="">Lot Type:</label>
                                                <span>{{ $userlot->lot->lotType->lot_type_name }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center px-4">
                                                <label for="">Lot Class:</label>
                                                <span>{{ $userlot->lot->lotClass->lot_class_name }}</span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border rounded p-3">
                                            <div class="d-flex justify-content-between align-items-center px-4">
                                                @if ($userlot->paymentsetting->payment_type == 'Cash')
                                                    <label for="">Payment Type:</label>
                                                    <span>{{ $userlot->paymentsetting->payment_name }}</span>
                                                @else
                                                    <label for="">Installment Type:</label>
                                                    <span>{{ $userlot->paymentsetting->payment_name }}</span>
                                                @endif
                                            </div><div class="d-flex justify-content-between align-items-center px-4">
                                                <label for="">Downpayment:</label>
                                                <span>&#8369; {{ $userlot->downpayment }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center px-4">
                                                <label for="">Payed Thru:</label>
                                                <span>{{ $userlot->pay_thru }}</span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-7">
                                        
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="total-records ">
                                            <div class="justify-content-between d-flex mt-3">
                                                <label for=""class="fw-bold">Total Rebated Amount:</label>
                                                <span class="">&#8369; {{ $userlot->total_rebate_amount ?? '0.00' }}</span>
                                            </div>
                                            <div class=" justify-content-between d-flex">
                                                <label for=""class="fw-bold">Total Amount Paid:</label>
                                                <span class="">&#8369; {{ $userlot->total_amount_paid }}</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="balance my-2 px-2">
                                        <label for="">Balance:</label>
                                        <span class="border rounded p-2">
                                            @php
                                                $balance = $userlot->paymentsetting->installment_full_price - ($userlot->total_amount_paid + $userlot->total_rebate_amount);
                                                
                                                // If payment type is Cash, set balance to 0.00
                                                if ($userlot->paymentsetting->payment_type == 'Cash') {
                                                    $balance = 0.00;
                                                }
                                            @endphp
                                            &#8369; {{ number_format($balance, 2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                           <h4>Payments</h4>
                           <div>
                               <table class="table">
                                 <thead>
                                   <tr>
                                     <th scope="col">#</th>
                                     <th scope="col">Date Paid</th>
                                     <th scope="col">Due Date</th>
                                     <th scope="col">Payment Amount</th>
                                     <th scope="col">Amount Paid</th>
                                     <th scope="col">Status</th>
                                     <th scope="col">Type</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                    @php
                                        $counter = 1
                                    @endphp
                                    @foreach ($paymenttracker as $row)
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $row->date }}</td>
                                            <td>{{ $row->due_date }}</td>
                                            <td>&#8369; {{ number_format($row->price_monthly, 2) }}</td>
                                            <td>
                                                @if(!empty($row->amount_paid))
                                                    &#8369; {{ number_format($row->amount_paid, 2) }}
                                                @else 
                                                    
                                                @endif
                                            </td>
                                            <td>
                                                @if ($row->payment_status == 'Pending')
                                                    <span class="badge text-bg-warning p-2">Pending</span>
                                                @elseif ($row->payment_status == 'Paid')
                                                    <span class="badge text-bg-success p-2">Paid</span>
                                                @elseif ($row->payment_status == 'Overdue')
                                                    <span class="badge text-bg-danger p-2">Overdue</span>
                                                @elseif ($row->payment_status == 'Cancelled')
                                                    <span class="badge text-bg-danger p-2">Cancelled</span>
                                                @endif
                                            </td>
                                            <td>{{ $row->type }}</td>
                                        </tr>
                                        @php
                                            $counter++
                                        @endphp
                                    @endforeach
                                 </tbody>
                               </table>
                               
                           </div>
                           <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal2">Cancel</button>
                        </div>
        
                        
        
                    </div>
                </div>
            </div>
  
        </div>
    </section><!-- End Contact Section -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST">
            @csrf
            <div class="modal-body text-center">
                <label for=""><h3>Cancel/Reject Reason</h3></label>
                    <p>{{ $userlot->cancel_reason }}</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Submit</button>
            </div>
        </form>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST">
            @csrf
            <div class="modal-body text-center">
                <label for=""><h3>Cancel Reason</h3></label>
                    <textarea name="cancel_reason" cols="30" rows="5" required class="form-control"></textarea>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection