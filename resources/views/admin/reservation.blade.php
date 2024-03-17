@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Reservation')
@section('reservation', 'active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Reservation</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables-payment" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Total Lot Owned</th>
                                @if(Auth::user() && Auth::user()->role == 'admin')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection