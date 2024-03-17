@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Deceased')
@section('deceased', 'active')

@section('content')
    <div class="row">
        {{-- <div class="col-md-12">
            <div class="card">
                <div class="row ml-2">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fresh">Max Fresh Body Qty</label>
                            <input type="number" class="form-control" id="fresh" name="fresh_body_qty" value="{{ $deceasedqty->max_quantity_deceased }}">
                            @error('fresh')
                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                            @enderror  
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bones">Max Bone Qty</label>
                            <input type="number" class="form-control" id="bones" name="fresh_body_qty" value="{{ $deceasedqty->max_quantity_bones }}">
                            @error('bones')
                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                            @enderror  
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Deceased</h4>
                    <div class="" style="margin-left: -613px;">
                        <form action="{{ route('update.deceasedqty') }}" method="POST">
                            @csrf
                            <label for="fresh">Max Fresh Body Qty</label> <br>
                            <input type="number" class="" id="fresh" name="fresh_body_qty" value="{{ $deceasedqty->max_quantity_deceased }}">
                            <button type="submit" class="btn btn-sm btn-success">
                                Update
                            </button>
                        </form>
                    </div>
                    <a href="{{ route('adddeceased') }}" class="btn btn-success">
                        <span class="btn-label">
                            <i class="fa fa-plus"></i>
                        </span>
                        Add Deceased
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Sex</th>
                                    <th>Born</th>
                                    <th>Died</th>
                                    <th>Section</th>
                                    <th>Lot</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deceased as $deceaseds)
                                    <tr data-deceased-id="{{ $deceaseds->id }}">
                                        <td>{{ $deceaseds->first_name }} {{ $deceaseds->middle_name }} {{ $deceaseds->last_name }} {{ $deceaseds->suffix }}</td>
                                        <td>{{ $deceaseds->age }}</td>
                                        <td>{{ $deceaseds->sex }}</td>
                                        <td>{{ $deceaseds->born }}</td>
                                        <td>{{ $deceaseds->died }}</td>
                                        <td>{{ $deceaseds->lot->section }}</td>
                                        <td>{{ $deceaseds->lot->lot_no }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('deceased.edit', $deceaseds->id)}}" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Deceased">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg view-deceased" data-original-title="View Deceased">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" data-toggle="tooltip" class="btn btn-link btn-danger delete-deceased" data-original-title="Delete Deceased" data-deceased-id="{{ $deceaseds->id }}">
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

        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Bones of the Deceased</h4>
                    <div class="" style="margin-left: -613px;">
                        <form action="{{ route('update.boneqty') }}" method="POST">
                            @csrf
                            <label for="fresh">Max Bone Qty</label> <br>
                            <input type="number" class="" id="fresh" name="bone_qty" value="{{ $deceasedqty->max_quantity_bones }}">
                            <button type="submit" class="btn btn-sm btn-success">
                                Update
                            </button>
                        </form>
                    </div>
                    <a href="{{ route('addbone') }}" class="btn btn-success">
                        <span class="btn-label">
                            <i class="fa fa-plus"></i>
                        </span>
                        Add Bones
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables-bone" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Sex</th>
                                    <th>Born</th>
                                    <th>Died</th>
                                    <th>Section</th>
                                    <th>Lot</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deceasedbone as $deceasedbones)
                                    <tr data-deceased-id="{{ $deceasedbones->deceased_id }}" data-deceasedbone-id="{{ $deceasedbones->id }}">
                                        <td>{{ $deceasedbones->first_name }} {{ $deceasedbones->middle_name }} {{ $deceasedbones->last_name }} {{ $deceasedbones->suffix }}</td>
                                        <td>{{ $deceasedbones->age }}</td>
                                        <td>{{ $deceasedbones->sex }}</td>
                                        <td>{{ $deceasedbones->born }}</td>
                                        <td>{{ $deceasedbones->died }}</td>
                                        <td>{{ $deceasedbones->deceased->lot->section }}</td>
                                        <td>{{ $deceasedbones->deceased->lot->lot_no }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Deceased">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="View Deceased">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" data-toggle="tooltip" class="btn btn-link btn-danger delete-deceasedbone" data-original-title="Delete Deceased Bone" data-deceasedbone-id="{{ $deceasedbones->id }}">
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

<!-- Delete confirmation modal for deceased setting -->
<div id="delete-modal-deceased" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Deceased</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger delete-deceased-button">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete confirmation modal for deceased setting -->
<div id="delete-modal-deceasedbone" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Deceased Bone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger delete-deceasedbone-button">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for viewing deceased -->
<div class="modal fade" id="viewDeceased" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 60%;">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <label><h3><b>Deceased Details</b></h3></label>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <div><h4><b>First Name</b></h4></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Age</label>
                                    <div><h4><b>Age y/o</b></h4></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <div><h4><b>Middle Name</b></h4></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sex</label>
                                    <div><h4><b>Male</b></h4></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <div><h4><b>Middle Name</b></h4></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Born</label>
                                    <div><h4><b>Born</b></h4></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Suffix</label>
                                    <div><h4><b>Suffix</b></h4></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Died</label>
                                    <div><h4><b>Died</b></h4></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group text-center">
                            <label>Certificate Image</label>
                            <div><img src="{{ asset('adminassets/img/userprofile.png') }}" alt="..." style="height: 13rem; width: 13rem;"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><h3>Lot Details</h3></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Section</label>
                                    <div><h4><b>Section</b></h4></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Lot Number</label>
                                    <div><h4><b>Lot Number</b></h4></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Lot Type</label>
                                    <div><h4><b>Lot Type</b></h4></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Lot Class</label>
                                    <div><h4><b>Lot Class</b></h4></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><h3>Deceased Bone Details</h3></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <div><h4><b>First Name</b></h4></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Age</label>
                            <div><h4><b>Age</b></h4></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Middle Name</label>
                            <div><h4><b>Middle Name</b></h4></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sex</label>
                            <div><h4><b>Sex</b></h4></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <div><h4><b>Last Name</b></h4></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Born</label>
                            <div><h4><b>Born</b></h4></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Suffix</label>
                            <div><h4><b>Suffix</b></h4></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Died</label>
                            <div><h4><b>Died</b></h4></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to handle the click event and show the modal -->
<script>
    $(document).ready(function(){
        // When the "View Deceased" button is clicked
        $('.view-deceased').click(function(){
            // Show the modal
            $('#viewDeceased').modal('show');
            
            // You can load content into the modal body using AJAX or other methods if needed.
            // For example, using AJAX to load content from a URL:
            // $.get('your_content_url', function(data){
            //     $('.modal-body').html(data);
            // });
        });
    });
</script>

{{-- script for deleting and then shows toast --}}
<script>
    $(document).ready(function() {
    var deceasedboneId; // Variable to store the Lot Type ID

    $(document).on('click', '.delete-deceasedbone', function(e) {
        e.preventDefault();

        deceasedboneId = $(this).data('deceasedbone-id');

        // Show the delete confirmation modal
        $('#delete-modal-deceasedbone').modal('show');
    });

    // Handle delete button click event inside the modal
    $(document).on('click', '.delete-deceasedbone-button', function(e) {
        e.preventDefault();

        // Send an AJAX request to delete the Lot Type
        $.ajax({
            url: '{{ route('deceasedbone.destroy') }}',
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
                "deceasedboneId": deceasedboneId
            },
            success: function(response) {
                if (response.success) {
                    // Remove the Lot Type row from the DOM
                    $('[data-deceasedbone-id="' + deceasedboneId + '"]').remove();
                    // Show the success toast message
                    showSuccessToast('Deceased Bone Deleted Successfully');
                } else {
                    console.log(response.message); // Handle the failure message
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Handle the error response
            }
        });

        // Hide the delete confirmation modal
        $('#delete-modal-deceasedbone').modal('hide');
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

{{-- script for deleting and then shows toast --}}
<script>
    $(document).ready(function() {
    var deceasedId; // Variable to store the Lot Type ID

    $(document).on('click', '.delete-deceased', function(e) {
        e.preventDefault();

        deceasedId = $(this).data('deceased-id');

        // Show the delete confirmation modal
        $('#delete-modal-deceased').modal('show');
    });

    // Handle delete button click event inside the modal
    $(document).on('click', '.delete-deceased-button', function(e) {
        e.preventDefault();

        // Send an AJAX request to delete the Lot Type
        $.ajax({
            url: '{{ route('deceased.destroy') }}',
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
                "deceasedId": deceasedId
            },
            success: function(response) {
                if (response.success) {
                    // Remove the Lot Type row from the DOM
                    $('[data-deceased-id="' + deceasedId + '"]').remove();
                    // Show the success toast message
                    showSuccessToast('Deceased Deleted Successfully');
                } else {
                    console.log(response.message); // Handle the failure message
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Handle the error response
            }
        });

        // Hide the delete confirmation modal
        $('#delete-modal-deceased').modal('hide');
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
@endsection