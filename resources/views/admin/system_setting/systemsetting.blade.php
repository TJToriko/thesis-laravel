@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | System Settings')
@section('system_setting', 'active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">System Setting</h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab-nobd" data-toggle="pill" href="#pills-home-nobd" role="tab" aria-controls="pills-home-nobd" aria-selected="true">Carousel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab-nobd" data-toggle="pill" href="#pills-contact-nobd" role="tab" aria-controls="pills-contact-nobd" aria-selected="false">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-policy-tab-nobd" data-toggle="pill" href="#pills-policy-nobd" role="tab" aria-controls="pills-policy-nobd" aria-selected="false">Policies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-logo-tab-nobd" data-toggle="pill" href="#pills-logo-nobd" role="tab" aria-controls="pills-logo-nobd" aria-selected="false">Logo and Description</a>
                    </li>
                </ul>
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Carousel</h4>
                            <button class="btn btn-success" data-toggle="modal" data-target="#addCarousel">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Add Carousel
                            </button>
                        </div>
                        <div class="card-body">

                            <!-- Modal adding Carousel -->
                            <div class="modal fade" id="addCarousel" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                Add Carousel</span> 
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('carousel.add') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Carousel Image</label>
                                                            <input id="addName" type="file" name="carousel_image" class="form-control" placeholder="Enter Lot Type Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label for="">Title</label>
                                                            <input type="text" class="form-control" name="carousel_header" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Description</label>
                                                            <textarea class="form-control" name="carousel_desc" id="" cols="58" rows="10" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer no-bd">
                                                <button type="submit" id="addRowButton" class="btn btn-primary">Add</button>
                                                <a class="btn btn-danger text-white" data-dismiss="modal">Close</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="table-responsive">
                                <table id="basic-datatables-carousel" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carousels as $carousel)
                                            <tr data-carousel-id="{{ $carousel->id }}">
                                                <td> 
                                                    <img src="{{ asset('images/carousel_images/' . $carousel->image) }}" alt="Carousel Image" style="height: 11em;width: 15em;">
                                                </td>
                                                <td>{{ $carousel->header }}</td>
                                                <td>{{ $carousel->description }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg edit-carousel-btn" data-original-title="Edit Carousel" data-carousel-id="{{ $carousel->id }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" data-toggle="tooltip" class="btn btn-link btn-danger delete-carousel" data-original-title="Delete Carousel" data-carousel-id="{{ $carousel->id }}">
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
                    <div class="tab-pane fade" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
                        <form action="{{ route('about.update', $aboutus->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <label for="about_desc">Description</label>
                                <textarea class="form-control" name="about_desc" id="about_desc" cols="155" rows="3" required>
                                    {{ $aboutus->about_us_desc }}
                                </textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="Header">Header</label>
                                            <textarea class="form-control" name="header" id="Header" cols="155" rows="5" required>
                                                {{ $aboutus->header }}
                                            </textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" name="description" id="description" cols="155" rows="17" required>
                                                {{ $aboutus->description }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <img src="{{ asset('images/aboutus_images/' . $aboutus->about_us_image) }}" alt="" class="form-control" style="height: 35em;">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="file" name="about_image" accept=".jpg, .jpeg, .png" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success float-right">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-contact-nobd" role="tabpanel" aria-labelledby="pills-contact-tab-nobd">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Services</h4>
                            <button class="btn btn-success" data-toggle="modal" data-target="#addServices">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Add Services
                            </button>
                        </div>
                        <div class="card-body">

                            <!-- Modal adding Services -->
                            <div class="modal fade" id="addServices" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                Add Services</span> 
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('service.add') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Service Name</label>
                                                            <input id="addName" type="text" name="service_name" class="form-control" placeholder="Enter Service Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Service Description</label>
                                                            <textarea class="form-control" name="service_desc" id="" cols="58" rows="10"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer no-bd">
                                                <button type="submit" id="addRowButton" class="btn btn-primary">Add</button>
                                                <a class="btn btn-danger text-white" data-dismiss="modal">Close</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="table-responsive">
                                <table id="basic-datatables-service" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>Service Name</th>
                                            <th>Service Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $service)
                                            <tr data-service-id="{{ $service->id }}">
                                                <td>{{ $service->service_name }}</td>
                                                <td>{{ $service->service_desc }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg edit-service-btn" data-original-title="Edit Service" data-service-id="{{ $service->id }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" data-toggle="tooltip" class="btn btn-link btn-danger delete-service" data-original-title="Delete Service" data-service-id="{{ $service->id }}">
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
                    <div class="tab-pane fade" id="pills-policy-nobd" role="tabpanel" aria-labelledby="pills-policy-tab-nobd">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Policies</h4>
                            <button class="btn btn-success" data-toggle="modal" data-target="#addPolicies">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Add Policies
                            </button>
                        </div>
                        <div class="card-body">

                            <!-- Modal adding Policies -->
                            <div class="modal fade" id="addPolicies" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                Add Policies</span> 
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('policy.add') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label for="policy_name">Policy Name</label>
                                                            <input id="policy_name" type="text" name="policy_name" class="form-control" placeholder="Enter Policy Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label for="policy_desc">Policy Description</label>
                                                            <textarea class="form-control" name="policy_desc" id="policy_desc" cols="58" rows="10"></textarea required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer no-bd">
                                                <button type="submit" id="addRowButton" class="btn btn-primary">Add</button>
                                                <a class="btn btn-danger text-white" data-dismiss="modal">Close</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="table-responsive">
                                <table id="basic-datatables-policy" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Policy Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($policys as $policy)
                                            <tr data-policy-id="{{ $policy->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $policy->policy_name }}</td>
                                                <td>{{ $policy->policy_desc }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg edit-policy-btn" data-original-title="Edit Policy" data-policy-id="{{ $policy->id }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" data-toggle="tooltip" class="btn btn-link btn-danger delete-policy" data-original-title="Delete Policy" data-policy-id="{{ $policy->id }}">
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
                    <div class="tab-pane fade" id="pills-logo-nobd" role="tabpanel" aria-labelledby="pills-logo-tab-nobd">
                        <form action="{{ route('logo.update', $logo->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 mt-4" style="text-align: -webkit-center;">
                                            <Label>Logo</Label>
                                            <img src="{{ asset('images/logo_images/' . $logo->logo_image) }}" alt="" class="form-control" style="height: 10em;width: 10em;">
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <input type="file" class="form-control" accept=".jpg, .jpeg, .png" name="logo_image" id="">
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-default">
                                                        <label for="logo_email">Contact Email</label>
                                                        <input id="logo_email" type="email" name="email" class="form-control" placeholder="Enter Email" required value="{{ $logo->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-default">
                                                        <label for="logo_contact">Contact Number</label>
                                                        <input id="logo_contact" type="text" name="contact" class="form-control" placeholder="Enter Contact" required value="{{ $logo->contact }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-default">
                                                <label for="logo_name">Logo Name</label>
                                                <input id="logo_name" type="text" name="logo_name" class="form-control" placeholder="Enter Logo Name" required value="{{ $logo->logo_name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group form-group-default">
                                                <label>Logo Description</label>
                                                <textarea class="form-control" name="logo_desc" id="logo_desc" cols="60" rows="10" required>{{ $logo->logo_desc }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success float-right">Update</button>
                            </div>
                        </form>
                    </div>
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


<!-- Delete confirmation modal for Carousel -->
<div id="delete-modal-carousel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Carousel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger delete-carousel-button">Delete</button>
            </div>
        </div>
    </div>
</div>

{{-- script for deleting and then shows toast --}}
<script>
    $(document).ready(function() {
    var carouselId; // Variable to store the Lot Type ID

    $(document).on('click', '.delete-carousel', function(e) {
        e.preventDefault();

        carouselId = $(this).data('carousel-id');

        // Show the delete confirmation modal
        $('#delete-modal-carousel').modal('show');
    });

    // Handle delete button click event inside the modal
    $(document).on('click', '.delete-carousel-button', function(e) {
        e.preventDefault();

        // Send an AJAX request to delete the Lot Type
        $.ajax({
            url: '{{ route('carousel.destroy') }}',
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
                "carouselId": carouselId
            },
            success: function(response) {
                if (response.success) {
                    // Remove the Lot Type row from the DOM
                    $('[data-carousel-id="' + carouselId + '"]').remove();
                    // Show the success toast message
                    showSuccessToast('Carousel Deleted Successfully');
                } else {
                    console.log(response.message); // Handle the failure message
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Handle the error response
            }
        });

        // Hide the delete confirmation modal
        $('#delete-modal-carousel').modal('hide');
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

<!-- Modal Editing Carousel -->
<div class="modal fade" id="EditCarousel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Edit Carousel</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Carousel Image</label>
                                <input id="addName" type="file" name="carousel_image" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="">Title</label>
                                <input type="text" class="form-control" name="carousel_header" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Description</label>
                                <textarea class="form-control" name="carousel_desc" id="" cols="58" rows="10" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" id="addRowButton" class="btn btn-primary">Update</button>
                    <a class="btn btn-danger text-white" data-dismiss="modal">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- script for editing Carousel and then show toast --}}
<script>
    // Script to handle edit button click
    $('.edit-carousel-btn').on('click', function() {
        var carouselId = $(this).data('carousel-id');
        var modal = $('#EditCarousel');
        
        // Fetch lot type data by ID using AJAX and populate the modal fields
        $.ajax({
            url: '/system/Get-Carousel/' + carouselId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                modal.find('input[name="carousel_header"]').val(response.header);
                modal.find('textarea[name="carousel_desc"]').val(response.description); // Corrected line
                modal.find('form').attr('action', '/system/Update-Carousel/' + carouselId);
                modal.modal('show');
            },
            error: function(xhr) {
                // Handle error, e.g., show an error message to the user.
            }
        });
    });

</script>


<!-- Delete confirmation modal for Policy -->
<div id="delete-modal-policy" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Policy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger delete-policy-button">Delete</button>
            </div>
        </div>
    </div>
</div>

{{-- script for deleting and then shows toast --}}
<script>
    $(document).ready(function() {
    var policyId; // Variable to store the Lot Type ID

    $(document).on('click', '.delete-policy', function(e) {
        e.preventDefault();

        policyId = $(this).data('policy-id');

        // Show the delete confirmation modal
        $('#delete-modal-policy').modal('show');
    });

    // Handle delete button click event inside the modal
    $(document).on('click', '.delete-policy-button', function(e) {
        e.preventDefault();

        // Send an AJAX request to delete the Lot Type
        $.ajax({
            url: '{{ route('policy.destroy') }}',
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
                "policyId": policyId
            },
            success: function(response) {
                if (response.success) {
                    // Remove the Lot Type row from the DOM
                    $('[data-policy-id="' + policyId + '"]').remove();
                    // Show the success toast message
                    showSuccessToast('Policy Deleted Successfully');
                } else {
                    console.log(response.message); // Handle the failure message
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Handle the error response
            }
        });

        // Hide the delete confirmation modal
        $('#delete-modal-policy').modal('hide');
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

<!-- Modal Editing Policy -->
<div class="modal fade" id="EditPolicy" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Edit Policy</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                @csrf
                @method('PUT ')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="policy_name">Policy Name</label>
                                <input id="policy_name" type="text" name="policy_name" class="form-control" placeholder="Enter Policy Name" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="policy_desc">Policy Description</label>
                                <textarea class="form-control" name="policy_desc" id="policy_desc" cols="58" rows="10"></textarea required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" id="addRowButton" class="btn btn-primary">Update</button>
                    <a class="btn btn-danger text-white" data-dismiss="modal">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- script for editing Policy and then show toast --}}
<script>
    // Script to handle edit button click
    $('.edit-policy-btn').on('click', function() {
        var policylId = $(this).data('policy-id');
        var modal = $('#EditPolicy');
        
        // Fetch lot type data by ID using AJAX and populate the modal fields
        $.ajax({
            url: '/system/Get-Policy/' + policylId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                modal.find('input[name="policy_name"]').val(response.policy_name);
                modal.find('textarea[name="policy_desc"]').val(response.policy_desc); // Corrected line
                modal.find('form').attr('action', '/system/Update-Policy/' + policylId);
                modal.modal('show');
            },
            error: function(xhr) {
                // Handle error, e.g., show an error message to the user.
            }
        });
    });

</script>


<!-- Delete confirmation modal for Service -->
<div id="delete-modal-service" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger delete-service-button">Delete</button>
            </div>
        </div>
    </div>
</div>

{{-- script for deleting and then shows toast --}}
<script>
    $(document).ready(function() {
    var serviceId; // Variable to store the Lot Type ID

    $(document).on('click', '.delete-service', function(e) {
        e.preventDefault();

        serviceId = $(this).data('service-id');

        // Show the delete confirmation modal
        $('#delete-modal-service').modal('show');
    });

    // Handle delete button click event inside the modal
    $(document).on('click', '.delete-service-button', function(e) {
        e.preventDefault();

        // Send an AJAX request to delete the Lot Type
        $.ajax({
            url: '{{ route('service.destroy') }}',
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
                "serviceId": serviceId
            },
            success: function(response) {
                if (response.success) {
                    // Remove the Lot Type row from the DOM
                    $('[data-service-id="' + serviceId + '"]').remove();
                    // Show the success toast message
                    showSuccessToast('Service Deleted Successfully');
                } else {
                    console.log(response.message); // Handle the failure message
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Handle the error response
            }
        });

        // Hide the delete confirmation modal
        $('#delete-modal-service').modal('hide');
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

<!-- Modal Editing Service -->
<div class="modal fade" id="EditService" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Edit Service</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                @csrf
                @method('PUT ')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Service Name</label>
                                <input id="addName" type="text" name="service_name" class="form-control" placeholder="Enter Service Name" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Service Description</label>
                                <textarea class="form-control" name="service_desc" id="" cols="58" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" id="addRowButton" class="btn btn-primary">Update</button>
                    <a class="btn btn-danger text-white" data-dismiss="modal">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- script for editing Service and then show toast --}}
<script>
    // Script to handle edit button click
    $('.edit-service-btn').on('click', function() {
        var servicelId = $(this).data('service-id');
        var modal = $('#EditService');
        
        // Fetch lot type data by ID using AJAX and populate the modal fields
        $.ajax({
            url: '/system/Get-Service/' + servicelId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                modal.find('input[name="service_name"]').val(response.service_name);
                modal.find('textarea[name="service_desc"]').val(response.service_desc); // Corrected line
                modal.find('form').attr('action', '/system/Update-Service/' + servicelId);
                modal.modal('show');
            },
            error: function(xhr) {
                // Handle error, e.g., show an error message to the user.
            }
        });
    });

</script>
@endsection