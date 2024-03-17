<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\refcitymun;
use App\Models\User;
use App\Models\refbrgy;
use App\Models\refprovince;
use App\Models\paymenttracker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AccountController extends Controller
{
    /**
     * Display the Account page.
    */
    public function ViewAccount()
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

        $authUserId = Auth::id();

        $user = User::where('id', '!=', $authUserId)->orderBy('id', 'asc')->get();

        return view('admin.account', compact('totalCount', 'user'));
    }

    /**
     * Display the Add Collector
    */
    public function ViewAddCollector()
    {
        $province = refprovince::orderBy('provDesc', 'asc')->get();
        $city = refcitymun::orderBy('citymunDesc', 'asc')->get();
        $barangay = refbrgy::orderBy('brgyDesc', 'asc')->get();

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

        return view('admin.account_crud.addcollector', compact('province', 'city','barangay', 'totalCount'));
    }


    public function AddCollector(Request $request)
    {
        // Validation Rules for collector information
        $rules = [
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'suffix' => 'nullable|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'barangay' => 'required|string',
            'street' => 'required|string',
            'landmark' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'contact_number' => 'required|digits:11',
            'valid_id' => 'required|image|mimes:jpeg,png,jpg,gif|max:20048',
            'place_of_birth' => 'required|string',
            'date_of_birth' => 'required|date',
            'sex' => 'required|string',
            'username' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ];
    
        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Process and store collector information
        $collectorData = $request->only([
            'first_name',
            'middle_name',
            'last_name',
            'suffix',
            'province',
            'city',
            'barangay',
            'street',
            'landmark',
            'place_of_birth',
            'date_of_birth',
            'sex',
            'email',
            'contact_number',
            'username',
            'password',
            'role', // Don't forget to include the 'role' field
            'valid_id',
        ]);
    
        // Set role as 'collector'
        $collectorData['role'] = 'collector';
    
        // Upload valid ID image if provided
        if ($request->hasFile('valid_id')) {
            $image = $request->file('valid_id');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/collector_valid_id'), $imageName);
            $collectorData['valid_id'] = $imageName;
        }
    
        // Store user information
        $user = User::create($collectorData);
    
        // You may want to add a success message or redirect the user after successful creation
        return redirect()->route('account')->with('success', 'Collector added successfully');
    }

    /**
     * Deletes the specified Collector
    */
    public function DeleteCollector(Request $request)
    {
        $collectorId = $request->input('collectorId');

        // Find the Lot Type record by ID
        $collector = User::findOrFail($collectorId);

        $collector->delete();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }

        /**
     * Display the Edit Payment page.
    */
    public function ViewEditCollector(string $id)
    {
        // Find the Lot Type record by ID
        $collector = User::findOrFail($id);

        $province = refprovince::orderBy('provDesc', 'asc')->get();
        $city = refcitymun::orderBy('citymunDesc', 'asc')->get();
        $barangay = refbrgy::orderBy('brgyDesc', 'asc')->get();

        $pendingTodayCount = paymenttracker::whereDate('due_date', '=', Carbon::today())
        ->where('payment_status', 'Pending')
        ->count();

        // Count overdue payments
        $overdueCount = paymenttracker::where('due_date', '<', Carbon::today())
            ->where('payment_status', 'Pending')
            ->count();

        // Calculate the total count
        $totalCount = $pendingTodayCount + $overdueCount;

        return view('admin.account_crud.editcollector', compact('collector', 'totalCount', 'province', 'city', 'barangay'));
    }
  
    /* code for updating Payment Setting and then show toast */
    public function UpdateCollector(Request $request, string $id)
    {
        $collector = User::findOrFail($id);

        // Validation Rules for collector information
        $rules = [
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'suffix' => 'nullable|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'barangay' => 'required|string',
            'street' => 'required|string',
            'landmark' => 'nullable|string',
            'email' => 'required|email|unique:users,email,' . $collector->id,
            'contact_number' => 'required|digits:11',
            'valid_id' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20048',
            'place_of_birth' => 'required|string',
            'date_of_birth' => 'required|date',
            'sex' => 'required|string',
            'username' => 'required|unique:users,username,' . $collector->id,
        ];
    
        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Process and store collector information
        $collectorData = $request->only([
            'first_name',
            'middle_name',
            'last_name',
            'suffix',
            'province',
            'city',
            'barangay',
            'street',
            'landmark',
            'place_of_birth',
            'date_of_birth',
            'sex',
            'email',
            'contact_number',
            'username',
            'valid_id',
        ]);
    
        // Set role as 'collector'
        $collectorData['role'] = 'collector';
    
        // Upload valid ID image if provided
        if ($request->hasFile('valid_id')) {
            $image = $request->file('valid_id');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/collector_valid_id'), $imageName);
            $collectorData['valid_id'] = $imageName;
        }
    

        // Update the collector's information
        $collector->update($collectorData);
    
        // You may want to add a success message or redirect the user after successful creation
        return redirect()->route('account')->with('success', 'Collector Updated successfully');
    }
}
