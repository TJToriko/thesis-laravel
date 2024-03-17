@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Add Deceased')
@section('deceased', 'active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add Deceased</div>
            </div>
            <form action="{{ route('deceased.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="first_name" value="{{ old('first_name')}}">
                                        @error('first_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror  
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mname">Middle Name</label>
                                        <input type="text" class="form-control" id="mname" placeholder="Enter Middle Name" name="middle_name" value="{{ old('middle_name')}}">
                                        @error('middle_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="lname">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="last_name" value="{{ old('last_name')}}">
                                        @error('last_name')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="suffix">Suffix</label>
                                <select class="select2-suffix form-control" name="suffix" id="suffix">
                                    <option value=""></option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                </select>
                                @error('suffix')
                                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Death Certificate Image <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="certificate_image" accept=".jpg, .jpeg, .png">
                                        @error('certificate_image')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="born">Born <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="born" id="born" max="{{ date('Y-m-d') }}" value="{{ old('born')}}">
                                        @error('born')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="died">Died <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="died" id="died" max="{{ date('Y-m-d') }}" value="{{ old('died')}}">
                                        @error('died')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="sexwithbonedetail">Sex <span class="text-danger">*</span></label>
                                        <select class="select2-suffix form-control" name="sex" id="sexwithbonedetail">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                          </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" class="form-control" name="age" id="age" readonly> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="lotbutton">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <a class="btn btn-success text-white" data-toggle="modal" data-target="#chooselotModal">
                                            <span class="btn-label">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                            Choose a Lot
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="lotdetails">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="section">Section</label>
                                                <input type="text" class="form-control" id="section" disabled>
                                                <input type="hidden" hidden name="lot_id" id="lot_id">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lotno">Lot #</label>
                                                <input type="text" class="form-control" id="lotno" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ltype">Lot Type</label>
                                        <input type="text" name="lot_type_id" id="ltypeid" hidden>
                                        <input type="text" class="form-control" id="ltype" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="lclass">Lot Class</label>
                                        <input type="text" name="lot_class_id" id="lclassid" hidden>
                                        <input type="text" class="form-control" id="lclass" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="additionalbone" name="withbone">
                                    <span class="form-check-sign">Additional bone?</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="withbone">
                        <div class="col-md-12">
                            <div class="form-group d-flex justify-content-between">
                                <label><h3><b>Bone Details</b></h3></label>
                                <div>
                                    <button type="button" class="btn btn-icon btn-xs btn-success ml-2 add-detail">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-xs btn-danger remove-detail" style="display: none;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="row" id="withbonedetails">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bone_first_name">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="bone_first_name" placeholder="Enter First Name" name="bone_first_name[]">
                                        @if($errors->has('bone_first_name.*'))
                                            @foreach ($errors->get('bone_first_name.*') as $error)
                                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $error[0] }}</small>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bone_middle_name">Middle Name</label>
                                        <input type="text" class="form-control" id="bone_middle_name" placeholder="Enter Middle Name" name="bone_middle_name[]">
                                        @if($errors->has('bone_middle_name.*'))
                                            @foreach ($errors->get('bone_middle_name.*') as $error)
                                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $error[0] }}</small>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bone_last_name">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="bone_last_name" placeholder="Enter Last Name" name="bone_last_name[]">
                                        @if($errors->has('bone_last_name.*'))
                                            @foreach ($errors->get('bone_last_name.*') as $error)
                                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $error[0] }}</small>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="bone_suffix">Suffix</label>
                                <select class="select2-suffix form-control" name="bone_suffix[]" id="bone_suffix">
                                    <option value=""></option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                  </select>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bone_born">Born <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="bone_born[]" id="bone_born">
                                        @if($errors->has('bone_born.*'))
                                            @foreach ($errors->get('bone_born.*') as $error)
                                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $error[0] }}</small>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bone_died">Died <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="bone_died[]" id="bone_died">
                                        @if($errors->has('bone_died.*'))
                                            @foreach ($errors->get('bone_died.*') as $error)
                                                <small id="emailHelp2" class="form-text text-muted text-danger">{{ $error[0] }}</small>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="withbonedetail">Sex <span class="text-danger">*</span></label>
                                        <select class="select2-suffix form-control" name="bone_sex[]" id="withbonedetail">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                          </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="bone_age">Age</label>
                                <input type="number" class="form-control" id="bone_age" name="bone_age[]" readonly> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <div style="text-align: right;">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('deceased') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal choosing lot -->
<div class="modal fade" id="chooselotModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 60%;">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Lots</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="multi-filter-lots-addowner" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>Section #</th>
                                    <th>Lot #</th>
                                    <th>Type</th>
                                    <th>Class</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Section #</th>
                                    <th>Lot #</th>
                                    <th>Type</th>
                                    <th>Class</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($lots as $lot)
                                <tr>
                                    <td>{{ $lot->lot->section }}</td>
                                    <td>{{ $lot->lot->lot_no }}</td>
                                    <td data-type-id="{{ $lot->lot->lot_type_id }}">
                                        {{ $lot->lot->lotType->lot_type_name }}
                                    </td>
                                    <td data-class-id="{{ $lot->lot->lot_class_id }}">
                                        @if($lot->lot->lotClass && !empty($lot->lot->lotClass->lot_class_name))
                                            {{$lot->lot->lotClass->lot_class_name }}
                                        @else
                                            <!-- Handle the case when lot class is empty if necessary -->
                                        @endif
                                    </td>
                                    <td>{{ $lot->lot->lot_status }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg select-lot-btn" data-original-title="Select Lot" data-lotid="{{ $lot->lot->id }}">
                                                <i class="fas fa-check-square"></i>
                                            </button>
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

{{-- script for hiding the withbone and withbone details id when its unchecked --}}
<script type="text/javascript">
    $(document).ready(function(){
        // Hide the sections initially
        $('#withbone').hide();
        $('#withbonedetails').hide();

        // Handle checkbox change event
        $('#additionalbone').on('change', function(){
            if ($(this).prop('checked')) {
                // If checkbox is checked, show the sections
                $('#withbone').show();
                $('#withbonedetails').show();
            } else {
                // If checkbox is unchecked, hide the sections and clear input values
                $('#withbone').hide();
                $('#withbonedetails').hide();
                
                // Clear input values
                $('#bone_first_name').val('');
                $('#bone_middle_name').val('');
                $('#bone_last_name').val('');
                $('#bone_suffix').val('');
                $('#bone_born').val('');
                $('#bone_died').val('');
                $('#lname').val('');
            }
        });
    });
</script>


{{-- script for choosing lot modal and display on input --}}
<script>
    $(document).ready(function() {
         $('.select-lot-btn').click(function() {
             // Get the lot details from the selected row
             var lotId = $(this).data('lotid');
             var section = $(this).closest('tr').find('td:eq(0)').text();
             var lotNumber = $(this).closest('tr').find('td:eq(1)').text();
             var lotType = $(this).closest('tr').find('td:eq(2)').text().trim();
             var lotTypeId = $(this).closest('tr').find('td:eq(2)').data('type-id'); // Get Lot Type ID from data attribute
             var lotClass = $(this).closest('tr').find('td:eq(3)').text().trim();
             var lotClassId = $(this).closest('tr').find('td:eq(3)').data('class-id'); // Get Lot Class ID from data attribute
 
             $('#lotdetails').show();

             // Populate the input fields with the lot details
             $('#section').val(section);
             $('#lotno').val(lotNumber);
             $('#ltype').val(lotType);
             $('#ltypeid').val(lotTypeId); // Set Lot Type ID
             $('#lclass').val(lotClass);
             $('#lclassid').val(lotClassId); // Set Lot Class ID
 
             // You can also store the selected lot ID if needed
             $('#lot_id').val(lotId);
 
             // Close the modal (assuming you are using Bootstrap modal)
             $('#chooselotModal').modal('hide');
         });
     });
</script>

{{-- script for computing the age of the fresh body  --}}
<script>
    $(document).ready(function() {
        // Function to calculate age based on born and died dates
        function calculateAge() {
            var bornDate = new Date($('#born').val());
            var diedDate = new Date($('#died').val());
    
            // Calculate the difference in years
            var age = diedDate.getFullYear() - bornDate.getFullYear();
    
            // Check if the died date has occurred this year or not
            if (diedDate.getMonth() < bornDate.getMonth() || (diedDate.getMonth() === bornDate.getMonth() && diedDate.getDate() < bornDate.getDate())) {
                age--;
            }
    
            // Update the age input field
            $('#age').val(age);
        }
    
        // Call calculateAge function when born or died dates are changed
        $('#born, #died').on('change', function() {
            calculateAge();
        });
    });
</script>

{{-- script for showing and hiding the additional bone detail --}}
<script>
    $(document).ready(function() {
        // Clone withbonedetails and show remove-detail, hide add-detail
        $('.add-detail').on('click', function() {
            var clonedRow = $('#withbonedetails').clone().attr('id', 'withbonedetails2');
            clonedRow.find('#bone_born').attr('id', 'bone_born2');
            clonedRow.find('#bone_died').attr('id', 'bone_died2');
            clonedRow.find('#bone_age').attr('id', 'bone_age2');
            $('#withbonedetails').after(clonedRow);
            $('.add-detail').hide();
            $('.remove-detail').show();

            // Function to calculate age based on born and died dates for cloned row
            function calculateAge() {
                var BonebornDate2 = new Date($('#bone_born2').val());
                var BonediedDate2 = new Date($('#bone_died2').val());
        
                // Calculate the difference in years
                var Boneage2 = BonediedDate2.getFullYear() - BonebornDate2.getFullYear();
        
                // Check if the died date has occurred this year or not
                if (BonediedDate2.getMonth() < BonebornDate2.getMonth() || (BonediedDate2.getMonth() === BonebornDate2.getMonth() && BonediedDate2.getDate() < BonebornDate2.getDate())) {
                    Boneage2--;
                }
        
                // Update the age input field
                $('#bone_age2').val(Boneage2);
            }
        
            // Call calculateAge function when born or died dates are changed for cloned row
            $('#bone_born2, #bone_died2').on('change', function() {
                calculateAge();
            });
        });

        // Remove cloned withbonedetails and show add-detail, hide remove-detail
        $('.remove-detail').on('click', function() {
            $('#withbonedetails2').remove();
            $('.remove-detail').hide();
            $('.add-detail').show();
        });
    });
</script>

{{-- script for computing the age of the with bone  --}}
<script>
    $(document).ready(function() {
        // Function to calculate age based on born and died dates
        function calculateAge() {
            var BonebornDate = new Date($('#bone_born').val());
            var BonediedDate = new Date($('#bone_died').val());
    
            // Calculate the difference in years
            var Boneage = BonediedDate.getFullYear() - BonebornDate.getFullYear();
    
            // Check if the died date has occurred this year or not
            if (BonediedDate.getMonth() < BonebornDate.getMonth() || (BonediedDate.getMonth() === BonebornDate.getMonth() && BonediedDate.getDate() < BonebornDate.getDate())) {
                Boneage--;
            }
    
            // Update the age input field
            $('#bone_age').val(Boneage);
        }
    
        // Call calculateAge function when born or died dates are changed
        $('#bone_born, #bone_died').on('change', function() {
            calculateAge();
        });
    });
</script>

@endsection