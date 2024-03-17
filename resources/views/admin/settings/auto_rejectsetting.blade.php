@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Payment Settings')
@section('asetting', 'active')
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
            <a href="{{ route('asetting') }}">Auto Reject Settings</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Lot Type</h4>
                {{-- <button class="btn btn-success" data-toggle="modal" data-target="#addLotTypeModal">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    Add Lot Type
                </button> --}}
            </div>
            <div class="card-body">
                <!-- Modal adding lot type -->
                <div class="modal fade" id="addLotTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header no-bd">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">
                                    Add Lot Type</span> 
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('addlottype.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Lot Type Name</label>
                                                <input id="addName" type="text" name="lot_type_name" class="form-control" placeholder="Enter Lot Type Name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="submit" id="addRowButton" class="btn btn-primary">Add</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="basic-datatables-lot-type" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Lot Type Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lottype as $ltype)
                                <tr data-lottype-id="{{ $ltype->id }}">
                                    <td>{{ ucwords(strtolower($ltype->lot_type_name)) }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg edit-lottype-btn" data-original-title="Edit Lot Type" data-lottype-id="{{ $ltype->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            {{-- <button type="button" data-toggle="tooltip" class="btn btn-link btn-danger delete-lottype" data-original-title="Delete Lot Type" data-lottype-id="{{ $ltype->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button> --}}
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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Lot Class</h4>
                {{-- <button class="btn btn-success" data-toggle="modal" data-target="#addLotClassModal">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    Add Lot Class
                </button> --}}
            </div>
            <div class="card-body">
                <!-- Modal adding lot class-->
                <div class="modal fade" id="addLotClassModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header no-bd">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">
                                    Add Lot Class</span> 
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('addlotclass.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label for="lot_class_name">Lot Class Name</label>
                                                <input id="addName" name="lot_class_name" type="text" class="form-control" placeholder="Enter Lot Class Name"   required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="submit" id="addRowButton" class="btn btn-primary">Add</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="multi-filter-lot-settings" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Lot Class Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lotclass as $lclass)
                                <tr data-lotclass-id="{{ $lclass->id }}">
                                    <td name="lot_class_name">{{ ucwords(strtolower($lclass->lot_class_name)) }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg edit-lotclass-btn" data-original-title="Edit Lot Class" data-lotclass-id="{{ $lclass->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            {{-- <button type="button" data-toggle="tooltip" class="btn btn-link btn-danger delete-lotclass" data-original-title="Delete Lot Class" data-lotclass-id="{{ $lclass->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button> --}}
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

<!-- Delete confirmation modal for lot Type -->
<div id="delete-modal-lottype" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Lot Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger delete-lottype-button">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editing lot type -->
<div class="modal fade" id="EditLotTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Edit Lot Type</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Lot Type Name</label>
                                <input id="addName" type="text" name="lot_type_name" class="form-control" placeholder="Enter Lot Type Name" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" id="addRowButton" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- script for deleting and then shows toast --}}
<script>
    $(document).ready(function() {
    var lotTypeId; // Variable to store the Lot Type ID

    $(document).on('click', '.delete-lottype', function(e) {
        e.preventDefault();

        lotTypeId = $(this).data('lottype-id');

        // Show the delete confirmation modal
        $('#delete-modal-lottype').modal('show');
    });

    // Handle delete button click event inside the modal
    $(document).on('click', '.delete-lottype-button', function(e) {
        e.preventDefault();

        // Send an AJAX request to delete the Lot Type
        $.ajax({
            url: '{{ route('deletelottype.destroy') }}',
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
                "lotTypeId": lotTypeId
            },
            success: function(response) {
                if (response.success) {
                    // Remove the Lot Type row from the DOM
                    $('[data-lottype-id="' + lotTypeId + '"]').remove();
                    // Show the success toast message
                    showSuccessToast('Lot Type Deleted Successfully');
                } else {
                    console.log(response.message); // Handle the failure message
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Handle the error response
            }
        });

        // Hide the delete confirmation modal
        $('#delete-modal-lottype').modal('hide');
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

{{-- script for editing lot type and then show toast --}}
<script>
    // Script to handle edit button click
    $('.edit-lottype-btn').on('click', function() {
        var lotTypeId = $(this).data('lottype-id');
        var modal = $('#EditLotTypeModal');
        
        // Fetch lot type data by ID using AJAX and populate the modal fields
        $.ajax({
            url: '/lot/Get-Lot-Type/' + lotTypeId, // Replace this URL with your route for fetching lot type data
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                modal.find('input[name="lot_type_name"]').val(response.lot_type_name);
                modal.find('form').attr('action', '/lot/Update-Lot-Type/' + lotTypeId); // Update the form action with the correct route for updating
                modal.modal('show');
            },
            error: function(xhr) {
                // Handle error, e.g., show an error message to the user.
            }
        });
    });

    // Script to handle form submission for editing lot type
    $('#EditLotTypeModal form').on('submit', function(event) {
        event.preventDefault();
        var form = $(this);

        $.ajax({
            url: form.attr('action'),
            type: 'PUT', // Use PUT request for updating data
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                $('#EditLotTypeModal').modal('hide');
                // Show success toast notification
                showSuccessToast('Lot Type Updated Successfully');
                // Optionally, update the table row with edited data without reloading the page
                var lotTypeId = form.attr('action').split('/').pop();
                var lotTypeRow = $('[data-lottype-id="' + lotTypeId + '"]');
                lotTypeRow.find('td:first-child').text(form.find('input[name="lot_type_name"]').val());
            },
            error: function(xhr) {
                // Handle error, e.g., show an error message to the user.
            }
        });
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
</script>


<!-- Delete confirmation modal for lot Class -->
<div id="delete-modal-lotclass" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Lot Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger delete-lotclass-button">Delete</button>
            </div>
        </div>
    </div>
</div>

{{-- script for deleting and then shows toast --}}
<script>
    $(document).ready(function() {
    var lotClassId; // Variable to store the Lot Type ID

    $(document).on('click', '.delete-lotclass', function(e) {
        e.preventDefault();

        lotClassId = $(this).data('lotclass-id');

        // Show the delete confirmation modal
        $('#delete-modal-lotclass').modal('show');
    });

    // Handle delete button click event inside the modal
    $(document).on('click', '.delete-lotclass-button', function(e) {
        e.preventDefault();

        // Send an AJAX request to delete the Lot Type
        $.ajax({
            url: '{{ route('deletelotclass.destroy') }}',
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
                "lotClassId": lotClassId
            },
            success: function(response) {
                if (response.success) {
                    // Remove the Lot Type row from the DOM
                    $('[data-lotclass-id="' + lotClassId + '"]').remove();
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
        $('#delete-modal-lotclass').modal('hide');
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

<!-- Modal Editing lot class -->
<div class="modal fade" id="EditLotClassModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Edit Lot Class</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="lot_class_name">Lot Class Name</label>
                                <input id="addName" name="lot_class_name" type="text" class="form-control" placeholder="Enter Lot Class Name" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" id="addRowButton" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- script for  lot class and then show toast --}}
<script>
    // Script to handle edit button click
    $('.edit-lotclass-btn').on('click', function() {
        var lotClassId = $(this).data('lotclass-id');
        var modal = $('#EditLotClassModal');
        
        // Fetch lot type data by ID using AJAX and populate the modal fields
        $.ajax({
            url: '/lot/Get-Lot-Class/' + lotClassId, // Replace this URL with your route for fetching lot type data
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                modal.find('input[name="lot_class_name"]').val(response.lot_class_name);
                modal.find('form').attr('action', '/lot/Update-Lot-Class/' + lotClassId); // Update the form action with the correct route for updating
                modal.modal('show');
            },
            error: function(xhr) {
                // Handle error, e.g., show an error message to the user.
            }
        });
    });

    // Script to handle form submission for editing lot type
    $('#EditLotClassModal form').on('submit', function(event) {
        event.preventDefault();
        var form = $(this);

        $.ajax({
            url: form.attr('action'),
            type: 'PUT', // Use PUT request for updating data
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                $('#EditLotClassModal').modal('hide');
                // Show success toast notification
                showSuccessToast('Lot Class Updated Successfully');
                // Optionally, update the table row with edited data without reloading the page
                var lotClassId = form.attr('action').split('/').pop();
                var lotClassRow = $('[data-lotclass-id="' + lotClassId + '"]');
                lotClassRow.find('td[name="lot_class_name"]').text(form.find('input[name="lot_class_name"]').val());

            },
            error: function(xhr) {
                // Handle error, e.g., show an error message to the user.
            }
        });
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
</script>

@endsection