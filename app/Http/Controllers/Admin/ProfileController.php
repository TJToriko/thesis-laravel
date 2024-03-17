<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\paymenttracker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\refbrgy;
use App\Models\refprovince;
use App\Models\refcitymun;



class ProfileController extends Controller
{
    /* Display user account / profile */
    public function ViewProfile(string $id)
    {
        $user = User::findOrFail($id);

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
  
        return view('admin.profile.profile', compact('user', 'totalCount', 'province', 'city', 'barangay'));
    }

    /* updates users details / profile details */
    public function updateProfile(Request $request, string $id)
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
            'profile_image',
        ]);
    
        // Upload valid ID image if provided
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/profile_image'), $imageName);
            $collectorData['profile_image'] = $imageName;
        }
    
        // Update the collector's information
        $collector->update($collectorData);
    
        // You may want to add a success message or redirect the user after successful creation
        return redirect()->route('profile', ['id' => $user->id])->with('success', 'Collector Updated successfully');
    }

    /**
     * Display the change password page.
    */
    public function ViewChangePassword()
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

        return view('admin.profile.changepassword', compact('totalCount'));
    }

    /* for changing the password in the database */
    public function changePassword(Request $request)
    {
        // Validate the form data
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the current password matches the user's password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Incorrect current password']);
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Redirect with success message
        return redirect()->route('password')->with('success', 'Password changed successfully');
    }

}
