<div class="main-header" data-background-color="green">
    <!-- Logo Header -->
    <div class="logo-header">
        
        <a href="index.html" class="logo">
            <!-- <img src="assets/img/logoazzara.svg" alt="navbar brand" class="navbar-brand"> -->
            <h4 class="navbar-brand text-white">H I L L S I D E</h4>
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fa fa-bars"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
        <div class="navbar-minimize">
            <button class="btn btn-minimize btn-rounded">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg">
        
        <div class="container-fluid">
            <div class="collapse" id="search-nav">
                <form class="navbar-left navbar-form nav-search mr-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="submit" class="btn btn-search pr-1">
                                <i class="fa fa-search search-icon"></i>
                            </button>
                        </div>
                        <input type="text" placeholder="Search ..." class="form-control">
                    </div>
                </form>
            </div>
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item toggle-nav-search hidden-caret">
                    <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
                @foreach ($registrationnotificationrealtime as $notification)
                    <li class="nav-item dropdown hidden-caret">
                        <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            @if ($notification->unread)
                                <span class="notification pending">{{ $notification->unread }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                            <li>
                                @if ($notification->unread)
                                    <div class="dropdown-title">You have {{ $notification->unread }} new notifications</div>
                                @endif
                            </li>
                            <li>
                                <div class="notif-scroll scrollbar-outer">
                                    <div class="notif-center notification-content">
                                        @foreach ($registrationnotifications as $notificationlink)
                                            <a href="{{ route('payment') }}">
                                                <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
                                                <div class="notif-content">
                                                    <span class="block">
                                                        {{ $notificationlink->message }}
                                                    </span>
                                                    <span class="time">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notificationlink->created_at)->format('h:i A') }}</span> 
                                                </div>
                                            </a>
                                        @endforeach
                                        <a href="#">
                                            <div class="notif-icon notif-danger"> <i class="fa fa-exclamation"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    User 3 Months Overdued
                                                </span>
                                                <span class="time">12 minutes ago</span> 
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </li>
                @endforeach
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            @if(Auth::user()->profile_image)
                                    <img src="{{ asset('images/profile_images/' . Auth::user()->profile_image) }}" alt="image profile" class="avatar-img rounded-circle">
                                @else
                                    <img src="{{ asset('adminassets/img/userprofile.png') }}" alt="image profile" class="avatar-img rounded-circle">
                                @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg">@if(Auth::user()->profile_image)
                                    <img src="{{ asset('images/profile_images/' . Auth::user()->profile_image) }}" alt="image profile" class="avatar-img rounded">
                                @else
                                    <img src="{{ asset('adminassets/img/userprofile.png') }}" alt="image profile" class="avatar-img rounded">
                                @endif</div>
                                <div class="u-text">
                                    <h4>
                                        {{ ucwords(Auth::user()->first_name) }}
                                        {{ ucwords(Auth::user()->middle_name) }}
                                        {{ ucwords(Auth::user()->last_name) }}
                                        {{ Auth::user()->suffix ? ' ' . Auth::user()->suffix : '' }}
                                    </h4>
                                    <p class="text-muted">{{ ucwords(Auth::user()->email) }}</p><a href="{{ route('profile', auth()->user()->id) }}" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('password') }}">Change Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" data-toggle="modal" data-target="#modal-logout">Logout</a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>