@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Add Deceased')
@section('deceased', 'active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add Bones</div>
            </div>
            <form action="{{ route('bone.post') }}" method="POST">
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
                                        <label for="born">Born <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="born" id="born" max="{{ date('Y-m-d') }}" value="{{ old('born')}}">
                                        @error('born')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="died">Died <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="died" id="died" max="{{ date('Y-m-d') }}" value="{{ old('died')}}">
                                        @error('died')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ltype">Lot Type</label>
                                                <input type="text" name="lot_type_id" id="ltypeid" hidden>
                                                <input type="text" class="form-control" id="ltype" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lclass">Lot Class</label>
                                                <input type="text" name="lot_class_id" id="lclassid" hidden>
                                                <input type="text" class="form-control" id="lclass" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="intered">Intered</label>
                                        <select class="select2-suffix form-control" name="deceased_id" id="intered" required>
                                            <option value=""></option>
                                            
                                        </select>
                                        @error('suffix')
                                            <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
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

<script type="text/javascript">
    $(document).ready(function () {
        // Change event handler for the lot select
        $('.select-lot-btn').on('click', function () {
            var lotId = $(this).data('lotid');

            $.ajax({
                url: '/deceased/get-intered/' + lotId,
                type: 'GET',
                success: function (datas) {
                    // Extract data from 'datas' and assign it to variables
                    var section = datas.section;
                    var lotNumber = datas.lotNumber;
                    var lotType = datas.lotType;
                    var lotTypeId = datas.lotTypeId;
                    var lotClass = datas.lotClass;
                    var lotClassId = datas.lotClassId;

                    // Populate the input fields with the lot details
                    $('#section').val(section);
                    $('#lotno').val(lotNumber);
                    $('#ltype').val(lotType);
                    $('#ltypeid').val(lotTypeId);
                    $('#lclass').val(lotClass);
                    $('#lclassid').val(lotClassId);
                    // You can also store the selected lot ID if needed
                    $('#lot_id').val(lotId);

                    // Populate the due dates dropdown
                    populateDueDatesDropdown(datas.Intered);

                    // Close the modal (assuming you are using Bootstrap modal)
                    $('#chooselotModal').modal('hide');
                },
                error: function (error) {
                    console.log(error);
                    // Handle error here
                }
            });
        });

        // Function to populate due dates in the dropdown
        function populateDueDatesDropdown(Intered) {
            var selectDropdown = $('#intered');
            selectDropdown.empty();

            // Add default option
            selectDropdown.append($('<option>', {
                value: '',
                text: 'Select Intered'
            }));

            // Add options for each due date
            Intered.forEach(function (Intered) {
                var fullName = Intered.first_name +
                    (Intered.middle_name ? ' ' + Intered.middle_name : '') +
                    ' ' + Intered.last_name +
                    (Intered.suffix ? ' ' + Intered.suffix : '');
                selectDropdown.append($('<option>', {
                    value: Intered.id,
                    text: fullName
                }));
            });
        }
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


@endsection