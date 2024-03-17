<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\paymenttracker;
use App\Models\Payment;
use App\Models\refcitymun;
use App\Models\refbrgy;
use App\Models\Lot;
use App\Models\User;
use App\Models\ownerhistory;
use App\Models\refprovince;
use App\Models\customer;
use App\Models\collection;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\registrationnotification;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    /**
     * Display the admin landing page.
    */
    public function ViewDashboard()
    {
        $totalLots = Lot::count();
        $totalIntered = Lot::where('lot_status', 'Intered')->count();
        $totalAvailable = Lot::where('lot_status', 'Available')->count();
        $totalReserved = Lot::where('lot_status', 'Reserved')->count();

        $customer = User::where('id', '!=', Auth::id())
        ->where('status', '=', 'approved') // Add this condition
        ->where('role', '=', 'customer') // Add this condition
        ->orderBy('created_at', 'DESC')
        ->get();

        // Fetch overdued payments
        $overduedPayments = paymenttracker::where('due_date', '<', Carbon::today())
        ->where('payment_status', 'Pending')
        ->get();

        // Count the number of overdue payments
        $overdueCount = $overduedPayments->count();


        // Process each overdued payment
        foreach ($overduedPayments as $payment) {
            // Calculate time difference
            $dueDate = Carbon::parse($payment->due_date);
            $now = Carbon::now();
            $difference = $now->diff($dueDate);

            // Build the time display string
            $timeDisplay = '';

            // Display days
            if ($difference->days > 0) {
                $timeDisplay .= $difference->days . 'd ';
            }

            // Display hours
            if ($difference->h > 0) {
                $timeDisplay .= $difference->h . 'h ';
            }

            // Display minutes
            if ($difference->i > 0) {
                $timeDisplay .= $difference->i . 'm ';
            }

            // Display seconds
            if ($difference->s > 0) {
                $timeDisplay .= $difference->s . 's';
            }

            // Display the time difference in the view
            $payment->timeDifference = $timeDisplay;
        }

        // Fetch pending payments for today
        $pendingToday = paymenttracker::where('due_date', '=', Carbon::today())
        ->where('payment_status', 'Pending')
        ->get();

        // Count the number of pending payments for today
        $pendingTodayCount = $pendingToday->count();

        $totalCount = $overdueCount + $pendingTodayCount;

        // Fetch payments due from tomorrow to the next 7 days
        $pendingWeek = paymenttracker::whereBetween('due_date', [Carbon::tomorrow(), Carbon::tomorrow()->addDays(6)])
        ->where('payment_status', 'Pending')
        ->get();

        // Process each pending payment for the next 7 days
        foreach ($pendingWeek as $payment) {
            // Calculate time difference
            $dueDate = Carbon::parse($payment->due_date);
            $now = Carbon::now();
            $difference = $dueDate->diff($now);

            // Display only days
            $timeDisplay = $difference->days;

            // Display the time difference in the view
            $payment->timeDifference = $timeDisplay;
        }

        // Payment-related data for today
        $today = Carbon::today()->toDateString(); // Get the current date in 'yyyy-mm-dd' format

        $recentlyPaid = paymenttracker::whereDate('date', $today)->get();
        $recentlyPendingPaid = Payment::where('status','Pending')->whereDate('date_collected', $today)->get();

        $currentYear = date('Y'); // Get the current year

        $monthlyCashData = Payment::join('payment_settings', 'payments.payment_setting_id', '=', 'payment_settings.id')
        ->selectRaw('MONTH(payments.created_at) as month, COUNT(*) as total_count')
        ->where('payment_settings.payment_type', 'Cash')
        ->where(function ($query) {
            $query->where('payments.status', 'Partial')
                ->orWhere('payments.status', 'Fully Paid');
        })
        ->whereRaw('YEAR(payments.created_at) = ?', [$currentYear])
        ->groupBy('month')
        ->orderBy('month')
        ->get();    

        $monthlyInstallmentData = Payment::join('payment_settings', 'payments.payment_setting_id', '=', 'payment_settings.id')
        ->selectRaw('MONTH(payments.created_at) as month, COUNT(*) as total_count')
        ->where('payment_settings.payment_type', 'Installment')
        ->whereRaw('YEAR(payments.created_at) = ?', [$currentYear])
        ->where(function ($query) {
            $query->where('payments.status', 'Partial')
                ->orWhere('payments.status', 'Fully Paid');
        })
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Fetch pending payments for today that are not in the collections table
        $pendingTodayUserReservation = Payment::where('date_to_collect', '=', Carbon::today())
        ->where('status', 'Pending')
        ->whereNotIn('id', function ($query) {
            $query->select('paymenttracker_id')
                ->from('collections');
        })
        ->get();

        $monthlyData = paymenttracker::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount_paid) as total_amount')
            ->whereRaw('YEAR(date) = ?', [$currentYear])
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $yearlyData = paymenttracker::selectRaw('YEAR(date) as year, SUM(amount_paid) as total_amount')
            ->whereRaw('YEAR(date) = ?', [$currentYear])
            ->groupBy('year')
            ->orderBy('year')
            ->get();
            /* dd($monthlyData, $yearlyData); */

        return view('admin.index', compact('totalLots','totalIntered', 'totalAvailable', 'totalReserved', 'recentlyPaid', 'customer', 'overduedPayments', 'pendingToday', 'pendingWeek','monthlyData', 'yearlyData', 'monthlyCashData', 'monthlyInstallmentData', 'recentlyPendingPaid', 'pendingTodayUserReservation'));
    }

    /**
     * Display the map page.
    */
    public function ViewMap()
    {

        return view('admin.map');
    }

    public function ViewAnalytics()
    {

        $monthlyBarDataCash = Payment::join('payment_settings', 'payments.payment_setting_id', '=', 'payment_settings.id')
        ->selectRaw('YEAR(payments.created_at) as year, MONTH(payments.created_at) as month, COUNT(*) as total_count')
        ->where('payment_settings.payment_type', 'Cash')
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

        $monthlyBarDataInstallment = Payment::join('payment_settings', 'payments.payment_setting_id', '=', 'payment_settings.id')
        ->selectRaw('YEAR(payments.created_at) as year, MONTH(payments.created_at) as month, COUNT(*) as total_count')
        ->where('payment_settings.payment_type', 'Installment')
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();
    

        $monthlyData = paymenttracker::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount_paid) as total_amount')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $yearlyData = paymenttracker::selectRaw('YEAR(date) as year, SUM(amount_paid) as total_amount')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

            dd($monthlyBarDataCash, $monthlyData);

        // Count pending payments for today
        $pendingTodayCount = paymenttracker::whereDate('due_date', '=', Carbon::today())
            ->where('payment_status', 'Pending')
            ->count();

        // Count overdue payments
        $overdueCount = paymenttracker::where('due_date', '<', Carbon::today())
            ->where('payment_status', 'Pending')
            ->count();

        // Calculate the total count
        $totalCount = $pendingTodayCount + $overdueCount;

        return view('admin.analytics', compact('monthlyData', 'yearlyData', 'monthlyBarDataCash', 'monthlyBarDataInstallment', 'totalCount'));
    }

    /**
     * Display the Reservation page.
    */
    public function ViewReservation()
    {
        // Count pending payments for today
        $pendingTodayCount = paymenttracker::whereDate('due_date', '=', Carbon::today())
        ->where('payment_status', 'Pending')
        ->count();

        // Count overdue payments
        $overdueCount = paymenttracker::where('due_date', '<', Carbon::today())
            ->where('payment_status', 'Pending')
            ->count();

        // Calculate the total count
        $totalCount = $pendingTodayCount + $overdueCount;

        return view('admin.reservation' ,compact('totalCount'));
    }

    /**
     * Display the Transfer page.
    */
    public function ViewTransfer()
    {
        $lots = Payment::where('status', '=', 'Fully Paid')
        ->orderBy('lot_id', 'asc')
        ->get();

        $customers = User::where('role', '=', 'customer')
        ->where('status', '=', 'approved') // Add this condition
        ->orderBy('id', 'asc')
        ->get();

        return view('admin.lot_crud.transferowner', compact('lots', 'customers'));
    }

    /**
     * Display the Customer.
    */
    public function GetCustomer($id)
    {
        $lot = Lot::where('id', $id)->first();

        $customer = User::where('id', $lot->customer_id)->first();
    
        if ($customer) {
            // Return the customer details as a JSON response
            return response()->json(['customer' => $customer]);
        } else {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }

    /**
     * Display the Customer Beneficiary.
    */
    public function GetCustomerWithBeneficiary($id)
    {
        $lot = Lot::where('id', $id)->first();

        $customer = User::where('id', $lot->customer_id)->first();
    
        if ($customer) {
            // Return the customer details as a JSON response
            return response()->json(['customer' => $customer]);
        } else {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }

    /* code for creating user and puts the lot id and customer id and then show toast */
    public function TransferOwnership(Request $request)
    {
        /* dd($request->all()); */
        // Validate the transfer option
        $validator = Validator::make($request->all(), [
            'transfer_opt' => 'required|in:new,transfer',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Process based on the transfer option
        if ($request->input('transfer_opt') === 'new') {
            
                 /* dd($request->all()); */
                // Validation Rules
                $validated = $request->validate([
                    'lot_id' => 'required',
                    'first_name' => 'required|string',
                    'middle_name' => 'nullable|string',
                    'last_name' => 'required|string',
                    'suffix' => 'nullable|string',
                    'province' => 'required|string',
                    'city' => 'required|string',
                    'barangay' => 'required|string',
                    'street' => 'required|string',
                    'landmark' => 'nullable|string',
                    'occupation' => 'required|string',
                    'place_of_birth' => 'required|string',
                    'date_of_birth' => 'required|date',
                    'sex' => 'required|string',
                    'id_image' => 'required|image|mimes:jpg,jpeg,png|max:20048',
                    'contact_number' => 'required|digits:11',
                    'email' => 'required|email|unique:users,email',
                    'username' => 'required',
                    'password' => 'required|min:4|confirmed',
                    'benificiary_fullname' => 'required|string',
                    'benificiary_date_of_birth' => 'required|date',
                    'relationship' => 'required|string',
                ]);

                // Upload valid id image if provided
                if ($request->hasFile('id_image')) {
                    $image = $request->file('id_image');
                    $imageName = $image->getClientOriginalName();
                    $image->move(public_path('images/valid_id_images'), $imageName);
                }
            
                $customer = User::create([
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'suffix' => $request->suffix,
                    'province' => $request->province,
                    'city' => $request->city,
                    'barangay' => $request->barangay,
                    'street' => $request->street,
                    'landmark' => $request->landmark,
                    'occupation' => $request->occupation,
                    'place_of_birth' => $request->place_of_birth,
                    'date_of_birth' => $request->date_of_birth,
                    'sex' => $request->sex,
                    'role' => 'customer',
                    'status' => 'approved',
                    'benificiary_fullname' => $request->benificiary_fullname,
                    'benificiary_date_of_birth' => $request->benificiary_date_of_birth,
                    'relationship' => $request->relationship,
                    'valid_id' => $imageName,
                    'contact_number' => $request->contact_number,
                    'email' => $request->email,
                    'username' => $request->username,
                    'password' => bcrypt($request->password), // Hash the password
                ]);

                $payment = Payment::where('lot_id', $request->input('lot_id'))->first();

                if ($payment) {
                    $payment->lot_transfer = 'Transfered';
                    $payment->customer_id = $customer->id;
                    $payment->save();
                }

                // Associate the customer with the lot
                $lot = Lot::find($request->input('lot_id'));

                // Initialize variables to store image names
                $lotTitleImageName = null;
                $deedOfSaleImageName = null;

                // Upload valid id image if provided
                if ($request->hasFile('lot_title')) {
                    $image = $request->file('lot_title');
                    $lotTitleImageName  = $image->getClientOriginalName();
                    $image->move(public_path('images/lot_title_images'), $lotTitleImageName);
                    // Update the lot_title column in the Lot model
                    $lot->lot_title = $lotTitleImageName ;
                }

                // Upload valid id image if provided
                if ($request->hasFile('deed_of_sale')) {
                    $image = $request->file('deed_of_sale');
                    $deedOfSaleImageName  = $image->getClientOriginalName();
                    $image->move(public_path('images/lot_deeds_images'), $deedOfSaleImageName );
                    // Update the lot_title column in the Lot model
                    $lot->deed_of_sale = $deedOfSaleImageName ;
                }

                if ($lot) {
                        
                    // Store the lot history
                    ownerhistory::create([
                        'lot_id' => $request->input('lot_id'),
                        'customer_id' => $lot->customer_id,
                        'date' => $lot->updated_at,
                        'lot_title' => $lotTitleImageName, // Add image name for lot_title
                        'deed_of_sale' => $deedOfSaleImageName, // Add image name for deed_of_sale
                        // Add other relevant fields
                    ]);

                    $lot->customer_id = $customer->id;
                    $lot->save();


                }

            } elseif ($request->input('transfer_opt') === 'transfer') {
        
                // Validation Rules for deceased information
                $rules = [
                    'lot_title_transfer' => 'required|image|mimes:jpeg,png,jpg,gif|max:20048',
                    'lot_id' => 'required',
                    'customer_id' => 'required',
                ];
            
                // Validate the request data
                $validator = Validator::make($request->all(), $rules);
            
                // Check if validation fails
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                    // Update Lot table
                    $lotId = $request->input('lot_id');
                    $newCustomerId = $request->input('customer_id');

                    // Find and update the Lot record
                    $lot = Lot::find($lotId);

                    // Initialize variables to store image names
                    $lotTitleImageName = null;
                    $deedOfSaleImageName = null;

                    // Upload valid id image if provided
                    if ($request->hasFile('lot_title_transfer')) {
                        $image = $request->file('lot_title_transfer');
                        $lotTitleImageName  = $image->getClientOriginalName();
                        $image->move(public_path('images/lot_title_transfer'), $lotTitleImageName);
                        // Update the lot_title column in the Lot model
                        $lot->lot_title = $lotTitleImageName ;
                    }

                    // Upload valid id image if provided
                    if ($request->hasFile('deed_of_sale_transfer')) {
                        $image = $request->file('deed_of_sale_transfer');
                        $deedOfSaleImageName  = $image->getClientOriginalName();
                        $image->move(public_path('images/lot_deeds_images'), $deedOfSaleImageName );
                        // Update the lot_title column in the Lot model
                        $lot->deed_of_sale = $deedOfSaleImageName ;
                    }

                    if ($lot) {
                            
                        // Store the lot history
                        ownerhistory::create([
                            'lot_id' => $request->input('lot_id'),
                            'customer_id' => $lot->customer_id,
                            'date' => $lot->updated_at,
                            'lot_title' => $lotTitleImageName, // Add image name for lot_title
                            'deed_of_sale' => $deedOfSaleImageName, // Add image name for deed_of_sale
                            // Add other relevant fields
                        ]);

                        $lot->customer_id = $newCustomerId;
                        $lot->save();


                    }

                    $payment = Payment::where('lot_id', $request->input('lot_id'))->first();

                    if ($payment) {
                        $payment->lot_transfer = 'Transfered';
                        $payment->customer_id = $newCustomerId;
                        $payment->update();
                    }
            } elseif ($request->input('transfer_opt') === 'transfer_beneficiary') {

                 /* dd($request->all()); */
                // Validation Rules
                $validated = $request->validate([
                    'lot_id' => 'required',
                    'first_name' => 'required|string',
                    'middle_name' => 'nullable|string',
                    'last_name' => 'required|string',
                    'suffix' => 'nullable|string',
                    'province' => 'required|string',
                    'city' => 'required|string',
                    'barangay' => 'required|string',
                    'street' => 'required|string',
                    'landmark' => 'nullable|string',
                    'occupation' => 'required|string',
                    'place_of_birth' => 'required|string',
                    'date_of_birth' => 'required|date',
                    'sex' => 'required|string',
                    'id_image' => 'required|image|mimes:jpg,jpeg,png|max:20048',
                    'contact_number' => 'required|digits:11',
                    'email' => 'required|email|unique:users,email',
                    'username' => 'required',
                    'password' => 'required|min:4|confirmed',
                    'benificiary_fullname' => 'required|string',
                    'benificiary_date_of_birth' => 'required|date',
                    'relationship' => 'required|string',
                ]);

                // Upload valid id image if provided
                if ($request->hasFile('id_image')) {
                    $image = $request->file('id_image');
                    $imageName = $image->getClientOriginalName();
                    $image->move(public_path('images/valid_id_images'), $imageName);
                }
            
                $customer = User::create([
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'suffix' => $request->suffix,
                    'province' => $request->province,
                    'city' => $request->city,
                    'barangay' => $request->barangay,
                    'street' => $request->street,
                    'landmark' => $request->landmark,
                    'occupation' => $request->occupation,
                    'place_of_birth' => $request->place_of_birth,
                    'date_of_birth' => $request->date_of_birth,
                    'sex' => $request->sex,
                    'role' => 'customer',
                    'status' => 'approved',
                    'benificiary_fullname' => $request->benificiary_fullname,
                    'benificiary_date_of_birth' => $request->benificiary_date_of_birth,
                    'relationship' => $request->relationship,
                    'valid_id' => $imageName,
                    'contact_number' => $request->contact_number,
                    'email' => $request->email,
                    'username' => $request->username,
                    'password' => bcrypt($request->password), // Hash the password
                ]);

                $payment = Payment::where('lot_id', $request->input('lot_id'))->first();

                $fullPaymentprice = $payment->paymentsetting->installment_full_price;

                if ($payment) {
                    $payment->lot_transfer = 'Transfered';
                    $payment->status = 'Fully Paid';
                    $payment->total_amount_paid = $fullPaymentprice;
                    $payment->customer_id = $customer->id;
                    $payment->save();
                }

                // Associate the customer with the lot
                $lot = Lot::find($request->input('lot_id'));

                if ($lot) {
                        
                    // Store the lot history
                    ownerhistory::create([
                        'lot_id' => $request->input('lot_id'),
                        'customer_id' => $lot->customer_id,
                        'date' => $lot->updated_at,
                        // Add other relevant fields
                    ]);

                    $lot->customer_id = $customer->id;
                    $lot->save();


                }


            }

            // Additional logic for both new and transfer options
            // ...

            $notification = ['message' => 'Lot Owner Transfered Successfully!', 'alert-type' => 'success'];
            return redirect()->route('lots')->with($notification);
    }

    public function TransferBeneficiary(Request $request)
    {
        // Validation Rules
        $validated = $request->validate([
            'lot_id' => 'required',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'suffix' => 'nullable|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'barangay' => 'required|string',
            'street' => 'required|string',
            'landmark' => 'nullable|string',
            'occupation' => 'required|string',
            'place_of_birth' => 'required|string',
            'date_of_birth' => 'required|date',
            'sex' => 'required|string',
            'id_image' => 'required|image|mimes:jpg,jpeg,png|max:20048',
            'contact_number' => 'required|digits:11',
            'email' => 'required|email|unique:users,email',
            'username' => 'required',
            'password' => 'required|min:4|confirmed',
            'benificiary_fullname' => 'required|string',
            'benificiary_date_of_birth' => 'required|date',
            'relationship' => 'required|string',
        ]);

        // Upload valid id image if provided
        if ($request->hasFile('id_image')) {
            $image = $request->file('id_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/valid_id_images'), $imageName);
        }
    
        $customer = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
            'province' => $request->province,
            'city' => $request->city,
            'barangay' => $request->barangay,
            'street' => $request->street,
            'landmark' => $request->landmark,
            'occupation' => $request->occupation,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'sex' => $request->sex,
            'role' => 'customer',
            'status' => 'approved',
            'benificiary_fullname' => $request->benificiary_fullname,
            'benificiary_date_of_birth' => $request->benificiary_date_of_birth,
            'relationship' => $request->relationship,
            'valid_id' => $imageName,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Hash the password
        ]);

        $payment = Payment::where('lot_id', $request->input('lot_id'))->first();

        $fullPaymentprice = $payment->paymentsetting->installment_full_price;

        if ($payment) {
            $payment->lot_transfer = 'Transfered';
            $payment->status = 'Waived';
            $payment->total_amount_paid = $fullPaymentprice;
            $payment->customer_id = $customer->id;
            $payment->save();
        }

        // Associate the customer with the lot
        $lot = Lot::find($request->input('lot_id'));

        if ($lot) {
                
            // Store the lot history
            ownerhistory::create([
                'lot_id' => $request->input('lot_id'),
                'customer_id' => $lot->customer_id,
                'date' => $lot->updated_at,
                // Add other relevant fields
            ]);

            $lot->customer_id = $customer->id;
            $lot->save();
        }

            $notification = ['message' => 'Transfered Owner To Beneficiary Successfully!', 'alert-type' => 'success'];
            return redirect()->route('lots')->with($notification);
    }


    public function ViewCollection()
    {
        $lots = Payment::where('status', '=', 'Fully Paid')
        ->orderBy('lot_id', 'asc')
        ->get();

        $customer = User::where('id', '!=', Auth::id())
        ->where('status', '=', 'approved') // Add this condition
        ->where('role', '=', 'customer') // Add this condition
        ->orderBy('created_at', 'DESC')
        ->get();

        // Fetch overdued payments
        $overduedPayments = paymenttracker::where('due_date', '<', Carbon::today())
        ->where('payment_status', 'Pending')
        ->get();

        // Process each overdued payment
        foreach ($overduedPayments as $payment) {
            // Calculate time difference
            $dueDate = Carbon::parse($payment->due_date);
            $now = Carbon::now();
            $difference = $now->diff($dueDate);

            // Build the time display string
            $timeDisplay = '';

            // Display days
            if ($difference->days > 0) {
                $timeDisplay .= $difference->days . 'd ';
            }

            // Display hours
            if ($difference->h > 0) {
                $timeDisplay .= $difference->h . 'h ';
            }

            // Display minutes
            if ($difference->i > 0) {
                $timeDisplay .= $difference->i . 'm ';
            }

            // Display seconds
            if ($difference->s > 0) {
                $timeDisplay .= $difference->s . 's';
            }

            // Display the time difference in the view
            $payment->timeDifference = $timeDisplay;
        }

        // Fetch pending payments for today that are not in the collections table
        $pendingToday = paymenttracker::where('due_date', '=', Carbon::today())
        ->where('payment_status', 'Pending')
        ->whereNotIn('id', function ($query) {
            $query->select('paymenttracker_id')
                ->from('collections');
        })
        ->get();
        // Fetch pending payments for today that are not in the collections table
        $pendingTodayUserReservation = Payment::where('date_to_collect', '=', Carbon::today())
        ->where('status', 'Pending')
        ->whereNotIn('id', function ($query) {
            $query->select('paymenttracker_id')
                ->from('collections');
        })
        ->get();

        // Get the authenticated user's ID
        $collectorId = Auth::id();

        // Retrieve all data from the collections table where collector_id is equal to the authenticated user's ID
        $collections = Collection::where('collector_id', $collectorId)->get();

        // Extract paymenttracker_id values from the collections
        $paymentTrackerIds = $collections->pluck('paymenttracker_id')->toArray();

        // Retrieve all records from the paymenttracker table where id is in the array of paymenttracker_id values
        $collectorsCollected = Paymenttracker::whereIn('id', $paymentTrackerIds)->get();


        return view('admin.collection', compact('lots', 'customer',  'overduedPayments', 'pendingToday', 'collectorsCollected', 'pendingTodayUserReservation'));
    }

    public function SelectedPayments(Request $request)
    {
        // Validate the form data
        $rules = [
            'paymenttracker_id' => 'required|array',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        // Get the authenticated user's ID
        $collectorId = Auth::id();

        // Loop through the selected paymenttracker_ids and create a collection record for each
        foreach ($request->input('paymenttracker_id') as $paymentTrackerId) {
            collection::create([
                'paymenttracker_id' => $paymentTrackerId,
                'collector_id' => $collectorId,
                // Add other fields as needed
            ]);
        }

            $notification = ['message' => 'Selected Payments Added Successfully!', 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
    }

    public function RestoredPayments(Request $request)
    {
        // Validate the form data
        $rules = [
            'paymenttracker_id' => 'required|array',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        // Get the authenticated user's ID
        $collectorId = Auth::id();

        // Extract paymenttracker_ids from the request
        $paymenttrackerIds = $request->input('paymenttracker_id');

        // Delete records from the collections table where collector_id is equal to the authenticated user's ID
        // and paymenttracker_id is in the array of paymenttracker_ids
        Collection::where('collector_id', $collectorId)
            ->whereIn('paymenttracker_id', $paymenttrackerIds)
            ->delete();

            $notification = ['message' => 'Payments restored Successfully!', 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
    }

    public function processPayment(Request $request)
    {
        // Validate the request data
        $request->validate([
            'paymenttracker_id' => 'required|exists:paymenttrackers,id',
        ]);

        // Get the authenticated user's ID and role
        $collectorId = Auth::id();
        $collectorRole = Auth::user()->role;

        // Find the paymenttracker record
        $paymenttracker = Paymenttracker::find($request->input('paymenttracker_id'));

        // Check if due date is today or earlier
        $today = Carbon::today();
        $dueDate = Carbon::parse($paymenttracker->due_date);

        if ($dueDate->isSameDay($today) || $dueDate->isBefore($today)) {
            // Payment is on time or overdue
            $paymenttracker->payment_status = ($dueDate->isSameDay($today)) ? 'Paid' : 'Overdue';
            $paymenttracker->date = $today;
            $paymenttracker->amount_paid = $paymenttracker->price_monthly;

            // Determine the type based on the collector's role
            $paymenttracker->type = ($collectorRole == 'collector') ? 'Collector: ' . Auth::user()->first_name : 'Office';

            // Save the changes
            $paymenttracker->save();

            // Find the corresponding payment in the payment table
            $payment = Payment::find($paymenttracker->payment_id);

            // Update the total_amount_paid in the payment table
            $payment->total_amount_paid += $paymenttracker->price_monthly;

            // Save the changes to the payment table
            $payment->save();

            // Redirect or return a response as needed
            return redirect()->back()->with('success', 'Payment processed successfully!');
        } else {
            // The payment is not due yet
            return redirect()->back()->with('error', 'Payment is not yet due.');
        }
    }

    public function processFirstPayment(Request $request)
    {
        /* dd($request->all()); */
        // Validate the request data
        $request->validate([
            'paymenttracker_id' => 'required',
        ]);
    
        // Get the authenticated user's ID and role
        $collectorId = Auth::id();
        $collectorRole = Auth::user()->role;
    
        // Find the payment record
        $payment = Payment::findOrFail($request->input('paymenttracker_id'));
        /* dd($payment); */
        // Check if due date is today or earlier
        $today = Carbon::today();
    
        // Update payment details
        $payment->date_collected = $today;
        $payment->type_paid = ($collectorRole == 'collector') ? 'Collector: ' . Auth::user()->first_name : 'Office';
        $payment->status = 'Partial';
        $payment->save();
    
        // Find the related lot and update its status
        $lotUpdate = Lot::findOrFail($payment->lot_id);
        $lotUpdate->lot_status = 'Reserved';
        $lotUpdate->customer_id = $payment->customer_id;
        $lotUpdate->save();
    
        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Payment processed successfully!');
    }
    

    /**
     * Display the Transfer Beneficiary page.
    */
    public function ViewTransferBeneficiary()
    {
        $lots = Payment::orderBy('lot_id', 'asc')
        ->get();

        $customers = User::orderBy('id', 'asc')->get();

        return view('admin.lot_crud.transferbeneficiary', compact('lots', 'customers'));
    }
    public function fetchNotifications()
    {
        // Fetch the latest unread notifications
        $notifications = registrationnotification::where('is_read', 0)->orderBy('created_at', 'desc')->get();

        return response()->json($notifications);
    }

    public function RejectRequest(Request $request)
    {
        // Find the Payment record by ID
        $payment = Payment::findOrFail($request->paymenttracker_id);
        $payment->status = 'Rejected';
        $payment->cancel_reason = $request->cancel_reason;
        $payment->save();
    
        // Find and delete all associated payment trackers
        $paymenttrackers = Paymenttracker::where('payment_id', $payment->id)->get();
        foreach ($paymenttrackers as $paymenttracker) {
            $paymenttracker->delete();
        }
    
        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Rejected Successfully!');
    }
    
}
