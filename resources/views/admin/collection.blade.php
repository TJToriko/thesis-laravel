@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Collection')
@section('collection', 'active')

@section('content')
    <div class="page-header">
        <h4 class="page-title">Collection</h4>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Overdued Payments</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables-overduedpayments" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Address</th>
                                    <th>Amount to Pay</th>
                                    <th>Overdue</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($overduedPayments as $overduedPayment)
                                    <tr>
                                        <td>
                                            @php
                                                // Fetch the customer details based on customer_id
                                                $customerdetail = $customer->where('id', $overduedPayment->customer_id)->first();
                                            @endphp
                                            @if ($customerdetail)
                                                {{ $customerdetail->first_name }} {{ $customerdetail->middle_name }} {{ $customerdetail->last_name }} {{ $customerdetail->suffix }}
                                            @else
                                                Customer not found
                                            @endif
                                        </td>
                                        <td>
                                            {{ ucwords(strtolower($customerdetail->province)) }},
                                            {{ ucwords(strtolower($customerdetail->city)) }},
                                            {{ ucwords(strtolower($customerdetail->barangay)) }},
                                            {{ $customerdetail->street }}
                                            @if (!empty($customerdetail->landmark))
                                                ({{ $customerdetail->landmark }})
                                            @endif
                                        </td>
                                        <td>&#8369; {{ number_format($overduedPayment->price_monthly, 2) }}</td>
                                        <td><small class="text-muted text-danger">{{ $overduedPayment->timeDifference }} ago</small></td>
                                        <td>
                                            <div class="form-button-action">
                                                <a data-toggle="modal" data-target="#confirmationModal" title="" class="btn btn-link btn-primary btn-lg collection-btn" data-original-title="Pay Now" data-collection-id="{{ $overduedPayment->id }}">
                                                    <i class="fas fa-money-bill-wave"></i>
                                                </a>
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
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('payment.select') }}" method="POST">
                    @csrf
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Pending Payments Today</h4>
                        <button type="submit" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Select
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables-pendingpayments" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Address</th>
                                        <th>Amount to Pay</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendingToday as $pending)
                                        <tr>
                                            <td>
                                                @php
                                                    // Fetch the customer details based on customer_id
                                                    $customerdetail = $customer->where('id', $pending->customer_id)->first();
                                                @endphp
                                                @if ($customerdetail)
                                                    {{ $customerdetail->first_name }} {{ $customerdetail->middle_name }} {{ $customerdetail->last_name }} {{ $customerdetail->suffix }}
                                                @else
                                                    Customer not found
                                                @endif
                                            </td>
                                            <td>
                                                {{ ucwords(strtolower($customerdetail->province)) }},
                                                {{ ucwords(strtolower($customerdetail->city)) }},
                                                {{ ucwords(strtolower($customerdetail->barangay)) }},
                                                {{ $customerdetail->street }}
                                                @if (!empty($customerdetail->landmark))
                                                    ({{ $customerdetail->landmark }})
                                                @endif
                                            </td>
                                            <td>&#8369; {{ number_format($pending->price_monthly, 2) }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <input type="checkbox" name="paymenttracker_id[]" value="{{ $pending->id }}" id="">
                                                    <a data-toggle="modal" data-target="#confirmationModal" title="" class="btn btn-link btn-primary btn-lg collection-btn" data-original-title="Pay Now" data-collection-id="{{ $pending->id }}">
                                                        <i class="fas fa-money-bill-wave"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @foreach ($pendingTodayUserReservation as $pending)
                                        @if ($pending->pay_thru == 'Office' && Auth::user()->role == 'admin')
                                            <tr>
                                                <td>
                                                    @php
                                                        // Fetch the customer details based on customer_id
                                                        $customerdetail = $customer->where('id', $pending->customer_id)->first();
                                                    @endphp
                                                    @if ($customerdetail)
                                                        {{ $customerdetail->first_name }} {{ $customerdetail->middle_name }} {{ $customerdetail->last_name }} {{ $customerdetail->suffix }}
                                                    @else
                                                        Customer not found
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ ucwords(strtolower($customerdetail->province)) }},
                                                    {{ ucwords(strtolower($customerdetail->city)) }},
                                                    {{ ucwords(strtolower($customerdetail->barangay)) }},
                                                    {{ $customerdetail->street }}
                                                    @if (!empty($customerdetail->landmark))
                                                        ({{ $customerdetail->landmark }})
                                                    @endif
                                                </td>
                                                <td>&#8369; {{ number_format($pending->downpayment, 2) }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                            <a data-toggle="modal" data-target="#confirmationModalCustomer" title="" class="btn btn-link btn-primary btn-lg collection-btn-user" data-original-title="Pay Now" data-collection-id="{{ $pending->id }}">
                                                                <i class="fas fa-money-bill-wave"></i>
                                                            </a>
                                                            @if (Auth::user()->role == 'admin')
                                                                <a data-toggle="modal" data-target="#confirmationModalCustomerReject" id="" class="btn btn-link btn-danger btn-lg collection-btn-userreject" data-original-title="Reject" data-collection-id="{{ $pending->id }}">
                                                                    <i class="fas fa-times"></i>
                                                                </a>
                                                            @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @elseif ($pending->pay_thru == 'Collector')
                                            <tr>
                                                <td>
                                                    @php
                                                        // Fetch the customer details based on customer_id
                                                        $customerdetail = $customer->where('id', $pending->customer_id)->first();
                                                    @endphp
                                                    @if ($customerdetail)
                                                        {{ $customerdetail->first_name }} {{ $customerdetail->middle_name }} {{ $customerdetail->last_name }} {{ $customerdetail->suffix }}
                                                    @else
                                                        Customer not found
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ ucwords(strtolower($customerdetail->province)) }},
                                                    {{ ucwords(strtolower($customerdetail->city)) }},
                                                    {{ ucwords(strtolower($customerdetail->barangay)) }},
                                                    {{ $customerdetail->street }}
                                                    @if (!empty($customerdetail->landmark))
                                                        ({{ $customerdetail->landmark }})
                                                    @endif
                                                </td>
                                                <td>&#8369; {{ number_format($pending->downpayment, 2) }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                            <input type="checkbox" name="paymenttracker_id[]" value="{{ $pending->id }}" id="">
                                                            <a data-toggle="modal" data-target="#confirmationModalCustomer" title="" class="btn btn-link btn-primary btn-lg collection-btn-user" data-original-title="Pay Now" data-collection-id="{{ $pending->id }}">
                                                                <i class="fas fa-money-bill-wave"></i>
                                                            </a>
                                                            @if (Auth::user()->role == 'admin')
                                                                <a data-toggle="modal" data-target="#confirmationModalCustomerReject" class="btn btn-link btn-danger btn-lg collection-btn-userreject" data-original-title="Reject" data-collection-id="{{ $pending->id }}">
                                                                    <i class="fas fa-times"></i>
                                                                </a>
                                                            @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('payment.restore') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Selected Pending Payments Today</h4>
                        <button type="submit" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Restore
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables-selectedpendingpayments" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Address</th>
                                        <th>Amount to Pay</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($collectorsCollected as $pending)
                                        <tr>
                                            <td>
                                                @php
                                                    // Fetch the customer details based on customer_id
                                                    $customerdetail = $customer->where('id', $pending->customer_id)->first();
                                                @endphp
                                                @if ($customerdetail)
                                                    {{ $customerdetail->first_name }} {{ $customerdetail->middle_name }} {{ $customerdetail->last_name }} {{ $customerdetail->suffix }}
                                                @else
                                                    Customer not found
                                                @endif
                                            </td>
                                            <td>
                                                {{ ucwords(strtolower($customerdetail->province)) }},
                                                {{ ucwords(strtolower($customerdetail->city)) }},
                                                {{ ucwords(strtolower($customerdetail->barangay)) }},
                                                {{ $customerdetail->street }}
                                                @if (!empty($customerdetail->landmark))
                                                    ({{ $customerdetail->landmark }})
                                                @endif
                                            </td>
                                            <td>&#8369; {{ number_format($pending->price_monthly, 2) }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <input type="checkbox" name="paymenttracker_id[]" value="{{ $pending->id }}" id="">
                                                    <a data-toggle="modal" data-target="#confirmationModal" title="" class="btn btn-link btn-primary btn-lg collection-btn" data-original-title="Pay Now" data-collection-id="{{ $pending->id }}">
                                                        <i class="fas fa-money-bill-wave"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to proceed with the payment?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="confirmationForm" action="{{ route('process.payment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="paymenttracker_id" id="paymenttracker_id">
                    <button type="submit" class="btn btn-primary">Yes, Pay Now</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.collection-btn').click(function() {
            var collectionId = $(this).data('collection-id');
            $('#paymenttracker_id').val(collectionId);
        });

        // Optional: Reset the form when the modal is closed
        $('#confirmationModal').on('hidden.bs.modal', function() {
            $('#confirmationForm')[0].reset();
        });
    });
</script>

<!-- Modal for Customer First Payment -->
<div class="modal fade" id="confirmationModalCustomer" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to proceed with the payment?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="confirmationFormCustomer" action="{{ route('process.first.payment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="paymenttracker_id" id="paymenttracker_id_customer">
                    <button type="submit" class="btn btn-primary">Yes, Pay Now</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.collection-btn-user').click(function() {
            var collectionId = $(this).data('collection-id');
            $('#paymenttracker_id_customer').val(collectionId);
        });

        // Optional: Reset the form when the modal is closed
        $('#confirmationModalCustomer').on('hidden.bs.modal', function() {
            $('#confirmationFormCustomer')[0].reset();
        });
    });
</script>

<!-- Modal for Reject with reason -->
<div class="modal fade" id="confirmationModalCustomerReject" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="confirmationFormCustomerReject" action="{{ route('reject.request') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label for=""><h3>Reject/Cancel Reason</h3></label>
                    <textarea name="cancel_reason" id="" cols="30" rows="10" class="form-control" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>  
                    <input type="hidden" name="paymenttracker_id" id="paymenttracker_id_customerreject">
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.collection-btn-userreject').click(function() {
            var collectionId = $(this).data('collection-id');
            $('#paymenttracker_id_customerreject').val(collectionId);
        });

        // Optional: Reset the form when the modal is closed
        $('#confirmationModalCustomerReject').on('hidden.bs.modal', function() {
            $('#confirmationFormCustomerReject')[0].reset();
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

{{-- script for showing the toast Error --}}
<script>
    $(document).ready(function() {
        @if(session('error'))
            // Show the toast notification if there is a success message in the session
            $.notify({
                icon: 'fas fa-check',
                title: 'Error!',
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
@endsection