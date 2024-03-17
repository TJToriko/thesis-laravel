@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Profile')

@section('content')
<div class="page-header">
    <h4 class="page-title">User Profile</h4>
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
            <a href="{{ route('profile', auth()->user()->id) }}">User Profile</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Change Password</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-with-nav">
            <div class="card-body">
                <form action="{{ route('change.password')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Current Password</label>
                                <input type="password" class="form-control" name="current_password" placeholder="Enter Current Password" value="">
                                @error('current_password')
                                    <small class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="new_password" placeholder="Enter New Password" value="">
                                @error('new_password')
                                    <small class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Confirm New Password</label>
                                <input type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm New Password" value="">
                                @error('confirm_password')
                                    <small class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 mb-3">
                        <button type="submit" class="btn btn-primary">Change</button>
                    </div>
                </form>
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
@endsection