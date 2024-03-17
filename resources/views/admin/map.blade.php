@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Map')
@section('map', 'active')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Geocoding</div>
            </div>
            <div class="card-body">
                <form id="geocoding_form">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="address" placeholder="address...">
                        <div class="input-group-append">
                            <button class="btn btn-primary" id="submit" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <div id="map-geocoding" class="map-demo"></div>
            </div>
        </div>
    </div>
</div>
@endsection