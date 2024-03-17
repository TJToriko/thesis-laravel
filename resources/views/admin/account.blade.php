@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Account')
@section('account', 'active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Account</h4>
                @if(Auth::user() && Auth::user()->role == 'admin')
                    <div>
                        <a href="{{ route('collector') }}" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Add Collector Account
                        </a>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables-account" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Cellphone #</th>
                                <th>Email</th>
                                <th>Address (province,city,barangay,street, landmark)</th>
                                <th>Role</th>
                                @if(Auth::user() && Auth::user()->role == 'admin')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $users)
                                <tr data-collector-id="{{ $users->id }}">
                                    <td>{{ $users->first_name }} {{ $users->middle_name }} {{ $users->last_name }} {{ $users->suffix }}</td>
                                    <td>{{ $users->contact_number }}</td>
                                    <td>{{ $users->email }}</td>
                                    <td>
                                        {{ ucwords(strtolower($users->province)) }},
                                        {{ ucwords(strtolower($users->city)) }},
                                        {{ ucwords(strtolower($users->barangay)) }},
                                        {{ $users->street }}
                                        @if (!empty($users->landmark))
                                            ({{ $users->landmark }})
                                        @endif
                                    </td>
                                    <td>{{ ucwords(strtolower($users->role)) }}</td>
                                    @if(Auth::user() && Auth::user()->role == 'admin')
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('collector.edit', $users->id)}}" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Collector" data-user-id="">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-secondary view-lot" data-user-id="" data-original-title="View Collector">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" data-toggle="tooltip" class="btn btn-link btn-danger delete-collector" data-original-title="Delete Collector" data-collector-id="{{ $users->id }}">
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

<!-- Delete confirmation modal for collector -->
<div id="delete-modal-collector" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Collector</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger delete-collector-button">Delete</button>
            </div>
        </div>
    </div>
</div>

{{-- script for deleting and then shows toast --}}
<script>
    $(document).ready(function() {
    var collectorId; // Variable to store the Lot Type ID

    $(document).on('click', '.delete-collector', function(e) {
        e.preventDefault();

        collectorId = $(this).data('collector-id');

        // Show the delete confirmation modal
        $('#delete-modal-collector').modal('show');
    });

    // Handle delete button click event inside the modal
    $(document).on('click', '.delete-collector-button', function(e) {
        e.preventDefault();

        // Send an AJAX request to delete the Lot Type
        $.ajax({
            url: '{{ route('collector.destroy') }}',
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
                "collectorId": collectorId
            },
            success: function(response) {
                if (response.success) {
                    // Remove the Lot Type row from the DOM
                    $('[data-collector-id="' + collectorId + '"]').remove();
                    // Show the success toast message
                    showSuccessToast('Collector Deleted Successfully');
                } else {
                    console.log(response.message); // Handle the failure message
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Handle the error response
            }
        });

        // Hide the delete confirmation modal
        $('#delete-modal-collector').modal('hide');
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