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
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Payment Settings</h4>
                <a href="{{ route('apsetting') }}" class="btn btn-success">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    Add Payment
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="multi-filter-payment-settings" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Lot Type</th>
                                <th>Lot Class</th>
                                <th>Payment Name</th>
                                <th>Payment Type</th>
                                <th>Price</th>
                                <th>Rebate</th>
                                <th>Min. Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Lot Type</th>
                                <th>Lot Class</th>
                                <th>Payment Name</th>
                                <th>Payment Type</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($paymentsetting as $psetting)
                                <tr data-payment-id="{{ $psetting->id }}">
                                    <td>{{ $psetting->lotType->lot_type_name }}</td>
                                    <td>
                                        @if(!empty($psetting->lotClass->lot_class_name))
                                            {{ $psetting->lotClass->lot_class_name }}
                                        @else
                                            
                                        @endif
                                    </td>
                                    <td>{{ $psetting->payment_name }}</td>
                                    <td>{{ $psetting->payment_type }}</td>
                                    <td>
                                        @if($psetting->payment_type === 'Cash')
                                            &#8369; {{ number_format($psetting->cash_full_price, 2) }}
                                        @else
                                            &#8369; {{ number_format($psetting->installment_full_price, 2) }} // &#8369; {{ number_format($psetting->installment_monthly_price, 2) }}/month
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($psetting->rebate_price))
                                        &#8369; {{ number_format($psetting->rebate_price, 2) }}
                                        @else 
                                            
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($psetting->min_amount))
                                        &#8369; {{ number_format($psetting->min_amount, 2) }}
                                        @else
                                            
                                        @endif
                                    </td>                                
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('apsetting.edit', $psetting->id)}}" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Payment">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" data-toggle="tooltip" class="btn btn-link btn-danger delete-payment" data-original-title="Delete Payment" data-payment-id="{{ $psetting->id }}">
                                                <i class="fas fa-trash"></i>
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

<!-- Delete confirmation modal for payment setting -->
<div id="delete-modal-payment" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger delete-payment-button">Delete</button>
            </div>
        </div>
    </div>
</div>

{{-- script for deleting and then shows toast --}}
<script>
    $(document).ready(function() {
    var paymentId; // Variable to store the Lot Type ID

    $(document).on('click', '.delete-payment', function(e) {
        e.preventDefault();

        paymentId = $(this).data('payment-id');

        // Show the delete confirmation modal
        $('#delete-modal-payment').modal('show');
    });

    // Handle delete button click event inside the modal
    $(document).on('click', '.delete-payment-button', function(e) {
        e.preventDefault();

        // Send an AJAX request to delete the Lot Type
        $.ajax({
            url: '{{ route('apsetting.destroy') }}',
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
                "paymentId": paymentId
            },
            success: function(response) {
                if (response.success) {
                    // Remove the Lot Type row from the DOM
                    $('[data-payment-id="' + paymentId + '"]').remove();
                    // Show the success toast message
                    showSuccessToast('Lot Class Deleted Successfully');
                } else {
                    console.log(response.message); // Handle the failure message
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Handle the error response
            }
        });

        // Hide the delete confirmation modal
        $('#delete-modal-payment').modal('hide');
    });

    // Function to show the success toast message
    function showSuccessToast(message) {
        $.notify({
            icon: 'fas fa-check',
            title: 'Success!',
            message: message,
        },{
            type: 'success',
            placement: {
                from: "top",
                align: "right"
            },
            time: 3000,
        });
        }
    });
</script>
@endsection