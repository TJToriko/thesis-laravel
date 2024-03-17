@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Lots')
@section('lots', 'active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Lots</h4>
                @if(Auth::user() && Auth::user()->role == 'admin')
                    <div>
                        <a href="{{ route('lotowner') }}" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Add Lot Owner
                        </a>
                        <a href="{{ route('transfer') }}" class="btn btn-primary" >
                            <span class="btn-label">
                                <i class="fas fa-exchange-alt"></i>
                            </span>
                            Transfer Ownership
                        </a>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="multi-filter-lots" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Section #</th>
                                <th>Lot #</th>
                                <th>Type</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Owner</th>
                                @if(Auth::user() && Auth::user()->role == 'admin')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Section #</th>
                                <th>Lot #</th>
                                <th>Type</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Owner</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($lots as $lot)
                                <tr>
                                    <td>{{ $lot->section }}</td>
                                    <td>{{ $lot->lot_no }}</td>
                                    <td>{{ $lot->lotType->lot_type_name }}</td>
                                    <td>
                                        @if($lot->lotClass && !empty($lot->lotClass->lot_class_name))
                                            {{ $lot->lotClass->lot_class_name }}
                                        @else
                                            
                                        @endif
                                    </td>
                                    <td>{{ $lot->lot_status }}</td>
                                    <td>
                                        @if(!empty($lot->customer_id))
                                            {{ $lot->customer->first_name }} {{ $lot->customer->middle_name }} {{ $lot->customer->last_name }}
                                        @else
                                            
                                        @endif
                                    </td>
                                    @if(Auth::user() && Auth::user()->role == 'admin')
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-toggle="modal" data-target="#statusModal" title="" class="btn btn-link btn-secondary edit-lot" data-lot-id="{{ $lot->id }}" data-original-title="Edit Lot">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-secondary view-lot" data-lot-id="{{ $lot->id }}" data-original-title="View Lot">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" data-toggle="tooltip" class="btn btn-link btn-danger delete-lot" data-original-title="Reset Lot" data-lot-id="{{ $lot->id }}">
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

<!-- Modal viewing lot -->
<div class="modal fade" id="viewLot" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    View Lot</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>SECTION</label>
                            <label for="section" class="form-control"></label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>LOT NUMBER</label>
                            <label for="lot_no" class="form-control"></label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>TYPE</label>
                            <label for="lot_type" class="form-control"></label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>CLASS</label>
                            <label for="lot_class" class="form-control"></label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>STATUS</label>
                            <label for="status" class="form-control"></label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>OWNER</label>
                            <label for="owner" class="form-control"></label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label><strong>LOT HISTORY</strong></label>
                        </div>
                        <div id="lot_owner_history"></div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- script for Viewing Lot Modal --}}
<script>
    // Script to handle view button click
    $('.view-lot').on('click', function() {
        var lotId = $(this).data('lot-id');
        var modal = $('#viewLot');

        // Fetch lot data by ID using AJAX
        $.ajax({
            url: '/lot/View-Lot/' + lotId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Populate modal fields with fetched data
                modal.find('[for="section"]').text(response.section);
                modal.find('[for="lot_no"]').text(response.lot_no);
                modal.find('[for="lot_type"]').text(response.lot_type);
                modal.find('[for="lot_class"]').text(response.lot_class);
                modal.find('[for="status"]').text(response.status); // Corrected column name

                // Clear existing lot owner history content
                modal.find('#lot_owner_history').empty();

                // Iterate over lot owner history and append to the modal
                $.each(response.lot_owner_history, function(index, history) {
                    var historyHtml = '<div class="row px-lg-3">';
                    historyHtml += '<div class="form-group col-sm-3">';
                    historyHtml += '<label for="">Owner Name: </label>';
                    historyHtml += '<label for="owner_name"> ' + history.lot_owner_history + '</label>';
                    historyHtml += '</div>';
                    historyHtml += '<div class="form-group col-sm-3">';
                    historyHtml += '<label for="">DoS/DoD: </label>';
                    if (history.deed_of_sale !== null) {
                        var imageUrl = '{{ asset("images/lot_deeds_images/") }}/' + history.deed_of_sale;
                        historyHtml += '<a href="' + imageUrl + '" alt="Image description" target="_blank" style="display: inline-block; width: 50px; height: 50px;">';
                        historyHtml += 'view';
                        historyHtml += '</a>';
                    } else {
                        historyHtml += '<label for="lot_title"> No Image </label>';
                    }
                    historyHtml += '</div>';
                    historyHtml += '<div class="form-group col-sm-3">';
                    historyHtml += '<label for="">Lot Title:</label>';
                    if (history.lot_title !== null) {
                        var imageUrl = '{{ asset("images/lot_title_images/") }}/' + history.lot_title;
                        historyHtml += '<a href="' + imageUrl + '" alt="Image description" target="_blank" style="display: inline-block; width: 50px; height: 50px;">';
                        historyHtml += 'view';
                        historyHtml += '</a>';
                    } else {
                        historyHtml += '<label for="lot_title"> No Image </label>';
                    }
                    historyHtml += '</div>';
                    historyHtml += '<div class="form-group col-sm-3">';
                    historyHtml += '<label for="">Purchased Date: </label>';
                    historyHtml += '<label for="purchased_date"> ' + history.date + '</label>';
                    historyHtml += '</div>';
                    historyHtml += '</div>';

                    // Append the history entry to the modal
                    modal.find('#lot_owner_history').append(historyHtml);
                });
                modal.modal('show');
            },
            error: function(xhr) {
                // Handle error, e.g., show an error message to the user.
            }
        });
    });
</script>


{{-- <a href="{{ asset('images/valid_id_images/' . $customer->valid_id) }}" alt="Image description" target="_blank" style="display: inline-block; width: 50px; height; 50px; background-image: url('{{ asset('images/valid_id_images/' . $customer->valid_id) }}');">view</a> --}}

<!-- Delete confirmation modal for Lot -->
<div id="delete-modal-lot" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Lot</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to Reset this?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger delete-lot-button">Reset</button>
            </div>
        </div>
    </div>
</div>

<!-- Script to handle modal and AJAX request -->
<script>
    $(document).ready(function () {
        var lotId; // Variable to store the Lot Type ID

        // Capture lot ID when button is clicked
        $(document).on('click', '.delete-lot', function (e) {
            e.preventDefault();
            lotId = $(this).data('lot-id');
            // Hide the delete confirmation modal
            $('#delete-modal-lot').modal('show');
        });

        // Handle delete button click event inside the modal
        $(document).on('click', '.delete-lot-button', function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('lot.reset') }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "lotId": lotId
                },
                success: function(response) {
                    // Hide the delete confirmation modal
                    $('#delete-modal-lot').modal('hide');

                    // Show the toast notification
                    $.notify({
                        icon: 'fas fa-check',
                        title: 'Success!',
                        message: response.message,
                    },{
                        type: 'success',
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        time: 3000,
                    });

                    // Reload the page after a short delay (adjust the delay as needed)
                    setTimeout(function() {
                        location.reload();
                    }, 2000); // 2000 milliseconds (2 seconds)
                },
                error: function(error) {
                    // Handle error (if needed)
                    console.log(error);
                }
            });

        });
    });
</script>

<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Update Lot Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateStatusForm">
                    @csrf
                    <div class="form-group">
                        <label for="lotStatus">Lot Status:</label>
                        <select class="form-control" id="lotStatus" name="lotStatus">
                            <option value="Unavailable">Unavailable</option>
                            <option value="Available">Available</option>
                            <option value="Reserved">Reserved</option>
                            <option value="Intered">Intered</option>
                        </select>
                    </div>
                    <input type="hidden" id="lotId" name="lotId">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateLotStatus()">Update Status</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.edit-lot').click(function() {
            var lotId = $(this).data('lot-id');
            $('#lotId').val(lotId);

            // Fetch and display the current status
            getLotStatus(lotId);

            $('#statusModal').modal('show');
        });
    });

    function updateLotStatus() {
        var form = $('#updateStatusForm');
        $.ajax({
            type: 'POST',
            url: '{{ route('update.lot.status') }}',
            data: form.serialize(),
            success: function(response) {
                // Handle success (if needed)
                $('#statusModal').modal('hide');

                // Show the toastr notification
                var type = response.success ? 'success' : 'error';
                toastr[type](response.message);

                // Reload the page after a short delay (adjust the delay as needed)
                setTimeout(function() {
                    location.reload();
                }, 2000); // 2000 milliseconds (2 seconds)
            },
            error: function(error) {
                // Handle error (if needed)
                console.log(error);
            }
        });
    }

    function getLotStatus(lotId) {
        $.ajax({
            type: 'GET',
            // Adjust the route name accordingly
            url: '{{ route('get.lot.status') }}',
            data: { lotId: lotId },
            success: function(response) {
                // Update the select box with the current status
                $('#lotStatus').val(response.status);
            },
            error: function(error) {
                // Handle error (if needed)
                console.log(error);
            }
        });
    }
</script>
@endsection