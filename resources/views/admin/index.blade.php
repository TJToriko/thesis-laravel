@extends('admin.admin_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Dashboard')
@section('dashboard', 'active')

@section('content')
    <div class="page-header">
        <h4 class="page-title">Dashboard</h4>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Lots</p>
                                <h4 class="card-title">{{ $totalLots }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="far fa-arrow-alt-circle-right"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Intered Lots</p>
                                <h4 class="card-title">{{ $totalIntered }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="far fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Available Lots</p>
                                <h4 class="card-title">{{ $totalAvailable }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="far fa-arrow-alt-circle-down"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Reserved Lots</p>
                                <h4 class="card-title">{{ $totalReserved }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Payment Chart</div>
                    <div>
                        <select class="form-control" id="timeFilter">
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Payment Type Chart</div>
                    <div>
                        <select class="form-control" id="timeFilterBar">
                            <option value="cash">Cash</option>
                            <option value="installment">Installment</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Overdued Payments</div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($overduedPayments as $overduedPayment)
                        <div class="d-flex">
                            <div class="flex-1 ml-3 pt-1">
                                @php
                                    // Fetch the customer details based on customer_id
                                    $customerdetail = $customer->where('id', $overduedPayment->customer_id)->first();
                                @endphp
                                <h5 class="text-uppercase fw-bold mb-1"> @if ($customerdetail)
                                    {{ $customerdetail->first_name }} {{ $customerdetail->middle_name }} {{ $customerdetail->last_name }} {{ $customerdetail->suffix }}
                                @else
                                    Customer not found
                                @endif</h5>
                                <span class="text-muted">
                                    {{ ucwords(strtolower($customerdetail->province)) }},
                                    {{ ucwords(strtolower($customerdetail->city)) }},
                                    {{ ucwords(strtolower($customerdetail->barangay)) }},
                                    {{ $customerdetail->street }}
                                    @if (!empty($customerdetail->landmark))
                                        ({{ $customerdetail->landmark }})
                                    @endif
                                </span>
                            </div>
                            <div class="float-right pt-1">
                                <small class="text-muted text-danger">{{ $overduedPayment->timeDifference }} ago</small>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                    @endforeach
                </div>
            </div>
        </div>        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Pending Payments</div>
                        <div class="card-tools">
                            <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab-nobd" data-toggle="pill" href="#pills-home-nobd" role="tab" aria-controls="pills-home-nobd" aria-selected="true">Today</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false">Week</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
                        <div class="card-body">
                            @foreach ($pendingToday as $pending)
                            
                                <div class="d-flex">
                                    <div class="flex-1 ml-3 pt-1">
                                        <h5 class="text-uppercase fw-bold mb-1">
                                            @php
                                                // Fetch the customer details based on customer_id
                                                $customerdetail = $customer->where('id', $pending->customer_id)->first();
                                            @endphp
                                            @if ($customerdetail)
                                                {{ $customerdetail->first_name }} {{ $customerdetail->middle_name }} {{ $customerdetail->last_name }} {{ $customerdetail->suffix }}
                                            @else
                                                Customer not found
                                            @endif
                                        
                                        </h5>
                                        <span class="text-muted">
                                            {{ ucwords(strtolower($customerdetail->province)) }},
                                            {{ ucwords(strtolower($customerdetail->city)) }},
                                            {{ ucwords(strtolower($customerdetail->barangay)) }},
                                            {{ $customerdetail->street }}
                                            @if (!empty($customerdetail->landmark))
                                                ({{ $customerdetail->landmark }})
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                            
                            @endforeach
                            @foreach ($pendingTodayUserReservation as $pending)
                            
                                <div class="d-flex">
                                    <div class="flex-1 ml-3 pt-1">
                                        <h5 class="text-uppercase fw-bold mb-1">
                                            @php
                                                // Fetch the customer details based on customer_id
                                                $customerdetail = $customer->where('id', $pending->customer_id)->first();
                                            @endphp
                                            @if ($customerdetail)
                                                {{ $customerdetail->first_name }} {{ $customerdetail->middle_name }} {{ $customerdetail->last_name }} {{ $customerdetail->suffix }}
                                            @else
                                                Customer not found
                                            @endif
                                        
                                        </h5>
                                        <span class="text-muted">
                                            {{ ucwords(strtolower($customerdetail->province)) }},
                                            {{ ucwords(strtolower($customerdetail->city)) }},
                                            {{ ucwords(strtolower($customerdetail->barangay)) }},
                                            {{ $customerdetail->street }}
                                            @if (!empty($customerdetail->landmark))
                                                ({{ $customerdetail->landmark }})
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                            
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
                        <div class="card-body">
                            @foreach ($pendingWeek as $pending)
                            
                                <div class="d-flex">
                                    <div class="flex-1 ml-3 pt-1">
                                        <h5 class="text-uppercase fw-bold mb-1">
                                            @php
                                                // Fetch the customer details based on customer_id
                                                $customerdetail = $customer->where('id', $pending->customer_id)->first();
                                            @endphp
                                            @if ($customerdetail)
                                                {{ $customerdetail->first_name }} {{ $customerdetail->middle_name }} {{ $customerdetail->last_name }} {{ $customerdetail->suffix }}
                                            @else
                                                Customer not found
                                            @endif
                                        
                                        </h5>
                                        <span class="text-muted">
                                            {{ ucwords(strtolower($customerdetail->province)) }},
                                            {{ ucwords(strtolower($customerdetail->city)) }},
                                            {{ ucwords(strtolower($customerdetail->barangay)) }},
                                            {{ $customerdetail->street }}
                                            @if (!empty($customerdetail->landmark))
                                                ({{ $customerdetail->landmark }})
                                            @endif
                                        </span>
                                        <div class="float-right pt-1">
                                            <small class="text-muted text-danger">{{ $pending->timeDifference }} days more</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                                
                            @endforeach
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    @if(Auth::user() && Auth::user()->role == 'admin')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Recent Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>Customer Names</th>
                                        <th>Amount Payed</th>
                                        <th>Date and Time</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentlyPaid as $recent)
                                        <tr>
                                            <td>
                                                @php
                                                    // Fetch the customer details based on customer_id
                                                    $customer = $customer->where('id', $recent->customer_id)->first();
                                                @endphp
                                                @if ($customer)
                                                    {{ $customer->first_name }} {{ $customer->middle_name }} {{ $customer->last_name }} {{ $customer->suffix }}
                                                @else
                                                    Customer not found
                                                @endif
                                            </td>
                                            <td>{{ $recent->amount_paid }}</td>
                                            <td>{{ $recent->updated_at }}</td>
                                            <td>{{ $recent->type }}</td>
                                        </tr>
                                    @endforeach
                                    @foreach ($recentlyPendingPaid as $recent)
                                        <tr>
                                            <td>
                                                @php
                                                    // Fetch the customer details based on customer_id
                                                    $customer = $customer->where('id', $recent->customer_id)->first();
                                                @endphp
                                                @if ($customer)
                                                    {{ $customer->first_name }} {{ $customer->middle_name }} {{ $customer->last_name }} {{ $customer->suffix }}
                                                @else
                                                    Customer not found
                                                @endif
                                            </td>
                                            <td>{{ $recent->downpayment }}</td>
                                            <td>{{ $recent->updated_at }}</td>
                                            <td>{{ $recent->type_paid }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
@endsection

@section('chart_script')

<script>
    var barChart = document.getElementById('barChart').getContext('2d');
    var timeFilterBar = document.getElementById('timeFilterBar');
    var myBarChart; // Declare myBarChart outside of functions to make it accessible

    // Initial data (Cash)
    var monthlyData = @json($monthlyCashData);
    var selectedOption = 'cash';  // Set default selection as "Cash"
    updateBarChart(monthlyData);

    // Trigger the change event to set default selection as "Cash"
    timeFilterBar.dispatchEvent(new Event('change'));

    // Event listener for the selection change
    timeFilterBar.addEventListener('change', function() {
        selectedOption = timeFilterBar.value;
        if (selectedOption === 'cash') {
            updateBarChart(@json($monthlyCashData));
        } else if (selectedOption === 'installment') {
            updateBarChart(@json($monthlyInstallmentData));
        }
    });

    function updateBarChart(data) {
        var barmonths = [];
        var bardata = [];
        // Mapping numerical month values to month names
        var monthNames = [
            "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];

        $.each(data, function(key, val) {
            barmonths.push(monthNames[val.month - 1]); // Subtract 1 to convert 1-based index to 0-based index
            bardata.push(val.total_count);
        });

        // If the chart already exists, destroy it before creating a new one
        if (myBarChart) {
            myBarChart.destroy();
        }

        myBarChart = new Chart(barChart, {
            type: 'bar',
            data: {
                labels: barmonths, // Use the month names
                datasets: [{
                    label: selectedOption === 'cash' ? "Cash Sales" : "Installment Sales",
                    backgroundColor: 'rgb(23, 125, 255)',
                    borderColor: 'rgb(23, 125, 255)',
                    data: bardata,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
            }
        });
    }
</script>

<script>
    var lineChart = document.getElementById('lineChart').getContext('2d');
    var timeFilter = document.getElementById('timeFilter');
    var myLineChart; // Declare myLineChart outside of functions to make it accessible

    // Initial data (Monthly)
    var monthlyData = @json($monthlyData);
    var yearlyData = @json($yearlyData);
    var selectedData = monthlyData;  // Set default selection as "Monthly"
    updateLineChart(selectedData);

    // Event listener for the selection change
    timeFilter.addEventListener('change', function() {
        var selectedOption = timeFilter.value;
        selectedData = selectedOption === 'monthly' ? monthlyData : yearlyData;
        updateLineChart(selectedData);
    });

    function updateLineChart(data) {
        var lineMonths = [];
        var lineData = [];

        // Mapping numerical month values to month names
        var monthNames = [
            "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];

        $.each(data, function(key, val) {
            if (timeFilter.value === 'monthly') {
                lineMonths.push(monthNames[val.month - 1]); // Subtract 1 to convert 1-based index to 0-based index
            } else {
                lineMonths.push(val.year);
            }
            lineData.push(val.total_amount);
        });

        // If the chart already exists, destroy it before creating a new one
        if (myLineChart) {
            myLineChart.destroy();
        }

        myLineChart = new Chart(lineChart, {
            type: 'line',
            data: {
                labels: lineMonths,
                datasets: [{
                    label: timeFilter.value === 'monthly' ? "Monthly Sales" : "Yearly Sales",
                    borderColor: "#1d7af3",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#1d7af3",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    backgroundColor: 'transparent',
                    fill: true,
                    borderWidth: 2,
                    data: lineData
                }]
            },
            options : {
                responsive: true, 
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels : {
                        padding: 10,
                        fontColor: '#1d7af3',
                    }
                },
                tooltips: {
                    bodySpacing: 4,
                    mode:"nearest",
                    intersect: 0,
                    position:"nearest",
                    xPadding:10,
                    yPadding:10,
                    caretPadding:10
                },
                layout:{
                    padding:{left:15,right:15,top:15,bottom:15}
                }
            }
        });
    }
</script>


@endsection