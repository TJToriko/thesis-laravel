<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>@yield('page_title')</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('adminassets/img/Hillside_logo.png') }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('adminassets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['{{ asset('adminassets/css/fonts.css') }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('adminassets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('adminassets/css/azzara.min.css') }}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('adminassets/css/demo.css') }}">

	{{-- cdnjs link for jquery --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	
	<!-- selectize js cdn -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

	{{-- toastr --}}
	<link rel="stylesheet" type="text/css" href="{{  asset('adminassets/plugins/toastr/toastr.css') }}">
	{{-- sweetalert2 --}}
	<link rel="stylesheet" type="text/css" href="{{  asset('adminassets/plugins/sweetalert2/sweetalert2.css') }}">
	{{-- leaflet cdn --}}
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
	<style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>
</head>
<body data-background-color="bg3">
	<div class="wrapper">

        {{-- Header --}}
        @include('admin.admin_layouts.header')
        {{-- End Header --}}

		<!-- Sidebar -->
        @include('admin.admin_layouts.sidebar')
		<!-- End Sidebar -->

		<div class="main-panel">
			@yield('content_map')
			<div class="content">
				<div class="page-inner">
                	@yield('content')
				</div>
			</div>
			
		</div>
		
	</div>
</div>

<!-- Logout confirmation modal for Lot -->
<div id="modal-logout" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Logout Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to Logout?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{ url('logout') }}" class="btn btn-danger delete-logout-button">Logout</a>
            </div>
        </div>
    </div>
</div>


<!--   Core JS Files   -->
<script src="{{ asset('adminassets/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('adminassets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('adminassets/js/core/bootstrap.min.js') }}"></script>
<!-- Datatables -->
<script src="{{ asset('adminassets/js/plugin/datatables/datatables.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('adminassets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('adminassets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('adminassets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Moment JS -->
<script src="{{ asset('adminassets/js/plugin/moment/moment.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('adminassets/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('adminassets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ asset('adminassets/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('adminassets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- Bootstrap Toggle -->
<script src="{{ asset('adminassets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('adminassets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('adminassets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

<!-- Google Maps Plugin -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1On32WMJzaErjXZhvYcEvYDQ_5PvlMCw"
></script>
<script src="{{ asset('adminassets/js/plugin/gmaps/gmaps.js') }}"></script>
{{-- sweetalert2 --}}
<script src="{{ asset('adminassets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
{{-- toastr --}}
<script type="text/javascript" src="{{ asset('adminassets/plugins/toastr/toastr.min.js') }}"></script>

<!-- Azzara JS -->
<script src="{{ asset('adminassets/js/ready.min.js') }}"></script>

<!-- Azzara DEMO methods, don't include it in your project! -->
<script src="{{ asset('adminassets/js/setting-demo.js') }}"></script>
<script src="{{ asset('adminassets/js/demo.js') }}"></script>

<!-- selectize js cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script >
	$(document).ready(function() {
		$('#basic-datatables').DataTable({
		});

		$('#basic-datatables-pendingpayments').DataTable({
		});

		$('#basic-datatables-selectedpendingpayments').DataTable({
		});

		$('#basic-datatables-overduedpayments').DataTable({
		});


		$('#basic-datatables-carousel').DataTable({
		});

		$('#basic-datatables-service').DataTable({
		});

		$('#basic-datatables-policy').DataTable({
		});

		$('#basic-datatables-bone').DataTable({
		});

		$('#basic-datatables-account').DataTable({
		});

		$('#basic-datatables-payment').DataTable({
		});

		$('#basic-datatables-paymentdetaillot').DataTable({
		});

		$('#basic-datatables-lot-type').DataTable({
		});

		$('#datatables-paymentdetail').DataTable( {
			"pageLength": 5,
			initComplete: function () {
				this.api().columns().every( function () {
					var column = this;
					var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
							);

						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					} );

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
				} );
			}
		});

		$('#multi-filter-lots').DataTable( {
			"pageLength": 5,
			initComplete: function () {
				this.api().columns().every( function () {
					var column = this;
					var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
							);

						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					} );

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
				} );
			}
		});

		$('#multi-filter-payment-settings').DataTable( {
			"pageLength": 5,
			initComplete: function () {
				this.api().columns().every( function () {
					var column = this;
					var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
							);

						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					} );

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
				} );
			}
		});

		$('#multi-filter-lot-settings').DataTable( {
			"pageLength": 5,
			initComplete: function () {
				this.api().columns().every( function () {
					var column = this;
					var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
							);

						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					} );

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
				} );
			}
		});

		$('#multi-filter-lots-addowner').DataTable( {
			"pageLength": 5,
			initComplete: function () {
				this.api().columns().every( function () {
					var column = this;
					var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
							);

						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					} );

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
				} );
			}
		});

		$('#multi-filter-lots-addowner-1').DataTable( {
			"pageLength": 5,
			initComplete: function () {
				this.api().columns().every( function () {
					var column = this;
					var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
							);

						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					} );

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
				} );
			}
		});

		$('#multi-filter-lots-addowner-2').DataTable( {
			"pageLength": 5,
			initComplete: function () {
				this.api().columns().every( function () {
					var column = this;
					var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
							);

						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					} );

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
				} );
			}
		});

		$('#multi-filter-lots-addowner-3').DataTable( {
			"pageLength": 5,
			initComplete: function () {
				this.api().columns().every( function () {
					var column = this;
					var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
							);

						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					} );

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
				} );
			}
		});

		$('#multi-filter-lots-addowner-4').DataTable( {
			"pageLength": 5,
			initComplete: function () {
				this.api().columns().every( function () {
					var column = this;
					var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
							);

						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					} );

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
				} );
			}
		});

		$('#multi-filter-lots-addowner-5').DataTable( {
			"pageLength": 5,
			initComplete: function () {
				this.api().columns().every( function () {
					var column = this;
					var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
							);

						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					} );

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
				} );
			}
		});

		$('#multi-filter-lots-addowner-12').DataTable( {
			"pageLength": 5,
			initComplete: function () {
				this.api().columns().every( function () {
					var column = this;
					var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
							);

						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					} );

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
				} );
			}
		});

		$('#multi-filter-lots-addowner-123').DataTable( {
			"pageLength": 5,
			initComplete: function () {
				this.api().columns().every( function () {
					var column = this;
					var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
							);

						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					} );

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
				} );
			}
		});

	});
</script>

{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> --}}
{{-- <script>
    $(document).ready(function() {

		var pusher = new Pusher('cc6f28eafe7c25564519', {
			cluster: 'ap2'
		});

		var channel = pusher.subscribe('my-channel');
		channel.bind('my-event', function(data) {
			if(data.customer_id) {
				let pending = parseInt($('#' + data.customer_id).find('.pending').html());
				if(pending) {
					$('#' + data.customer_id).find('.pending').html(pending + 1);
				} else {
					$('#' + data.customer_id).html('<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i><span class="notification pending">1</span></a>');
				}
			}

        // Fetch and update notification content dynamically
        updateNotificationDropdownContent();
      });

		function updateNotificationDropdownContent() {
			// Make an AJAX request to fetch the latest notifications from the server
			$.ajax({
				url: '/admin/fetch-registrationnotifications', // Replace with your actual route
				method: 'GET',
				success: function (data) {
					// Assuming data is an array of notification items
					var notificationsHtml = '';
					data.forEach(function (notification) {
						var date = new Date(notification.created_at);
						var formattedTime = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
						var paymentRoute = route('payment');
						
						notificationsHtml += '<a href="' + paymentRoute + '">';
						notificationsHtml += '<div class="notif-icon notif-primary">';
						notificationsHtml += '<i class="fa fa-user-plus"></i>';
						notificationsHtml += '<div class="notif-content">';
						notificationsHtml += '<span class="block">' + notification.message + '</span>';
						notificationsHtml += '<p>Pending Appointment Waiting for Approval</p>';
						notificationsHtml += '<span class="time">' + formattedTime + '</span>';
						notificationsHtml += '</div>';
						notificationsHtml += '</div>';
						notificationsHtml += '</a>';
					});

					// Update the notification dropdown content
					$('.notification-content').html(notificationsHtml);
				},
				error: function (error) {
					console.log('Error fetching notifications: ', error);
				}
			});
		}

    })
</script> --}}

	<script>
		$(document).ready(function(){
			var mapBasic = new GMaps({
				div: '#map-basic',
				lat: -12.043333,
				lng: -77.028333
			});

			var mapMarkers = new GMaps({
				div: '#map-markers',
				lat: -12.043333,
				lng: -77.03,
			});

			mapMarkers.addMarker({
				lat: -12.043333,
				lng: -77.03,
				title: 'Lima',
				details: {
					database_id: 42,
					author: 'HPNeo'
				},
				click: function(e){
					if(console.log)
						console.log(e);
					alert('You clicked in this marker');
				}
			});

			var mapPolygons = new GMaps({
				div: '#map-polygons',
				lat: -12.043333,
				lng: -77.028333
			});
			var path = [[-12.040397656836609,-77.03373871559225],
			[-12.040248585302038,-77.03993927003302],
			[-12.050047116528843,-77.02448169303511],
			[-12.044804866577001,-77.02154422636042]];

			polygon = mapPolygons.drawPolygon({
				paths: path,
				strokeColor: '#BBD8E9',
				strokeOpacity: 1,
				strokeWeight: 3,
				fillColor: '#BBD8E9',
				fillOpacity: 0.6
			});

			//map routes
			mapRoutes = new GMaps({
				div: '#map-routes',
				lat: -12.043333,
				lng: -77.028333
			});

			$('#start_travel').click(function(e){
				e.preventDefault();
				mapRoutes.travelRoute({
					origin: [-12.044012922866312, -77.02470665341184],
					destination: [-12.090814532191756, -77.02271108990476],
					travelMode: 'driving',
					step: function(e){
						$('#instructions').append('<li>'+e.instructions+'</li>');
						$('#instructions li:eq('+e.step_number+')').delay(450*e.step_number).fadeIn(200, function(){
							mapRoutes.setCenter(e.end_location.lat(), e.end_location.lng());
							mapRoutes.drawPolyline({
								path: e.path,
								strokeColor: '#131540',
								strokeOpacity: 0.6,
								strokeWeight: 6
							});
						});
					}
				});
			});

			// map static
			var url = GMaps.staticMapURL({
				size: [610, 300],
				lat: -12.043333,
				lng: -77.028333
			});
			$('<img style="width: 100%; height: 100%" />').attr('src', url).appendTo('#map-static');

			// map geocoding
			mapGeocoding = new GMaps({
				div: '#map-geocoding',
				lat: -12.043333,
				lng: -77.028333
			});
			$('#geocoding_form').submit(function(e){
				e.preventDefault();
				GMaps.geocode({
					address: $('#address').val().trim(),
					callback: function(results, status){
						if(status=='OK'){
							var latlng = results[0].geometry.location;
							mapGeocoding.setCenter(latlng.lat(), latlng.lng());
							mapGeocoding.addMarker({
								lat: latlng.lat(),
								lng: latlng.lng()
							});
						}
					}
				});
			});
		})
	</script>

<script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Are you sure you want to Delete this?",
            text: "Once Deleted, It will be Permanently Deleted.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Delete",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
</script>
<script>
    $(document).on("click", "#approve", function(e){
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Are you sure you want to Approve this?",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Approve",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
</script>
<script>
    $(document).on("click", "#reject", function(e){
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Are you sure you want to Reject this?",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Reject",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
</script>
<script>
	@if(Session::has('message'))
		var type="{{ Session::get('alert-type','info') }}"
		  switch(type){
			case 'info':
			  toastr.info("{{ Session::get('message') }}");
			  break;
			case 'success':
			  toastr.success("{{ Session::get('message') }}");
			  break;
			case 'warning':
			  toastr.warning("{{ Session::get('message') }}");
			  break;
			case 'error':
			  toastr.error("{{ Session::get('message') }}");
			  break;
		  }        
	@endif
</script>

@yield('chart_script')

</body>
</html>