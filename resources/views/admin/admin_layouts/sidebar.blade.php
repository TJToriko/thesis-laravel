		<!-- Sidebar -->
		<div class="sidebar">
			
			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							@if(Auth::user()->profile_image)
                                    <img src="{{ asset('images/profile_images/' . Auth::user()->profile_image) }}" alt="image profile" class="avatar-img rounded-circle">
                                @else
                                    <img src="{{ asset('adminassets/img/userprofile.png') }}" alt="image profile" class="avatar-img rounded-circle">
                                @endif
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ ucwords(Auth::user()->first_name) }}
									{{ ucwords(Auth::user()->middle_name) }}
									{{ ucwords(Auth::user()->last_name) }}
									{{ Auth::user()->suffix ? ' ' . Auth::user()->suffix : '' }}
									<span class="user-level">{{ ucwords(Auth::user()->role) }}</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="{{ route('profile', auth()->user()->id) }}">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="{{ route('password') }}">
											<span class="link-collapse">Change Password</span>
										</a>
									</li>
									<li>
										<a data-toggle="modal" data-target="#modal-logout">
											<span class="link-collapse">Logout</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item @yield('dashboard')">
							<a href="{{ route('dashboard') }}">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
								@if($totalCount > 0)
									<span class="badge badge-count">{{ $totalCount }}</span>
								@endif
							</a>
						</li>
						<li class="nav-item @yield('collection')">
							<a href="{{ route('collection') }}">
								<i class="fas fa-money-bill-wave"></i>
								<p>Collection</p>
								@if($totalCount > 0)
									<span class="badge badge-count">{{ $totalCount }}</span>
								@endif
							</a>
						</li>
						<li class="nav-item @yield('lots')">
							<a href="{{ route('lots') }}">
								<i class="fas fa-inbox"></i>
								<p>Lots</p>
							</a>
						</li>
						@if(Auth::user() && Auth::user()->role == 'admin')
							<li class="nav-item @yield('deceased')">
								<a href="{{ route('deceased') }}">
									<i class="fas fa-map-marked-alt"></i>
									<p>Deceased</p>
								</a>
							</li>
						@endif
						<li class="nav-item @yield('account')">
							<a href="{{ route('account') }}">
								<i class="fas fa-user-alt"></i>
								<p>Account</p>
							</a>
						</li>
						@if(Auth::user() && Auth::user()->role == 'admin')
							<li class="nav-item @yield('map')">
								<a href="{{ route('map') }}">
									<i class="fas fa-chart-line"></i>
									<p>Map</p>
								</a>
							</li>
						@endif
						{{-- @if(Auth::user() && Auth::user()->role == 'admin')
							<li class="nav-item @yield('analytics')">
								<a href="{{ route('analytics') }}">
									<i class="fas fa-chart-line"></i>
									<p>Analytics</p>
								</a>
							</li>
						@endif --}}
						<li class="nav-item @yield('payment')">
							<a href="{{ route('payment') }}">
								<i class="fas fa-user-alt"></i>
								<p>Customer</p>
							</a>
						</li>
						{{-- <li class="nav-item @yield('reservation')">
							<a href="{{ route('reservation') }}">
								<i class="fas fa-ticket-alt"></i>
								<p>Reservation</p>
							</a>
						</li> --}}
						@if(Auth::user() && Auth::user()->role == 'admin')
							<li class="nav-item @yield('psetting') @yield('lsetting')">
								<a data-toggle="collapse" href="#settings">
									<i class="fas fa-cogs"></i>
									<p>Settings</p>
									<span class="caret"></span>
								</a>
								<div class="collapse @yield('psetting_show')" id="settings">
									<ul class="nav nav-collapse">
										<li class="@yield('psetting')">
											<a href="{{ route('psetting') }}">
												<span class="sub-item">Payment Settings</span>
											</a>
										</li>
										<li class="@yield('lsetting')">
											<a href="{{ route('lsetting') }}">
												<span class="sub-item">Lot Settings</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="nav-item @yield('system_setting')">
								<a href="{{ route('system') }}">
									<i class="fas fa-cogs"></i>
									<p>System Setting</p>
								</a>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->