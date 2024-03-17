@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Payment')
@section('payment', 'active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Pending Customer Accounts</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables-payment" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendinguser as $row)
                                <tr>
                                    <td>{{ $row->first_name }} {{ $row->middle_name }} {{ $row->last_name }} {{ $row->suffix }}</td>
                                    <td>
                                        {{ ucwords(strtolower($row->province)) }},
                                        {{ ucwords(strtolower($row->city)) }},
                                        {{ ucwords(strtolower($row->barangay)) }},
                                        {{ $row->street }}
                                        @if (!empty($row->landmark))
                                            ({{ $row->landmark }})
                                        @endif
                                    </td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('reject.customer', $row->id) }}" class="btn btn-link btn-danger btn-lg" id="reject">
                                                <i class="fas fa-times"></i>
                                            </a>
                                            <a href="{{ route('view.customer', $row->id) }}" class="btn btn-link btn-primary btn-lg view-deceased">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('approve.customer', $row->id) }}" class="btn btn-link btn-success" id="approve">
                                                <i class="fas fa-check"></i>
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Customers</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables-payment" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Total Lot Owned</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>
                                        {{ $payment->first_name }} {{ $payment->middle_name }} {{ $payment->last_name }} {{ $payment->suffix }}
                                    </td>
                                    <td>
                                        {{ ucwords(strtolower($payment->province)) }},
                                        {{ ucwords(strtolower($payment->city)) }},
                                        {{ ucwords(strtolower($payment->barangay)) }},
                                        {{ $payment->street }}
                                        @if (!empty($payment->landmark))
                                            ({{ $payment->landmark }})
                                        @endif
                                    </td>
                                    <td>
                                        {{ $customerCounts[$payment->id] }}
                                    </td>
                                    <td>
                                        <div class="form-button-action">
                                    
                                            <a href="{{ route('paymentsdetail', $payment->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg view-deceased" data-original-title="View Payment">
                                                <i class="fas fa-eye"></i>
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
</div>


@endsection