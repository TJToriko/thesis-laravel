@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | View Customer')
@section('payment', 'active')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Customer Details</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
                <div class="row">
                    <dt class="col-md-4">Name:</dt>
                    <dt class="col-md-8">
                        {{ $data->first_name }} {{ $data->middle_name }} {{ $data->last_name }} {{ $data->suffix }}
                    </dt>
                    <dt class="col-md-4">Province:</dt>
                    <dt class="col-md-8">
                        {{ $data->province }}
                    </dt>
                    <dt class="col-md-4">City:</dt>
                    <dt class="col-md-8">
                        {{ $data->city }}
                    </dt>
                    <dt class="col-md-4">Barangay:</dt>
                    <dt class="col-md-8">
                        {{ $data->barangay }}
                    </dt>
                    <dt class="col-md-4">Landmark:</dt>
                    <dt class="col-md-8">
                        {{ $data->landmark }}
                    </dt>
                    <dt class="col-md-4">Email:</dt>
                    <dt class="col-md-8">{{ $data->email }}</dt>
                    <dt class="col-md-4">Contact Number:</dt>
                    <dt class="col-md-8">
                        {{ $data->contact_number }}
                    </dt>
                    <dt class="col-md-4">Occupation:</dt>
                    <dt class="col-md-8">
                        {{ $data->occupation }}
                    </dt>
                    <dt class="col-md-4">Place Of Birth:</dt>
                    <dt class="col-md-8">{{ $data->place_of_birth }}</dt>
                    <dt class="col-md-4">Date Of Birth:</dt>
                    <dt class="col-md-8">{{ $data->date_of_birth }}</dt>
                    <dt class="col-md-4">Sex:</dt>
                    <dt class="col-md-8">{{ $data->sex }}</dt>
                    <dt class="col-md-4">Date Registered:</dt>
                    <dt class="col-md-8">{{ $data->created_at }}</dt>
                    <dt class="col-md-4">Valid ID:</dt>
                    <dt class="col-md-8">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-validid">
                            Show
                        </button>
                    </dt>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<div class="modal fade" id="modal-validid" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Valid ID</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p><img src="{{ asset('images/customer_valid_id/' . $data->valid_id) }}" alt="Image" style="height: 500px;width: 100%;"></p>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection