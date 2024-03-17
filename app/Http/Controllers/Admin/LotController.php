<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lot;
use App\Models\LotType;
use App\Models\LotClass;
use App\Models\refcitymun;
use App\Models\refbrgy;
use App\Models\refprovince;
use App\Models\PaymentSetting;
use App\Models\Payment;
use App\Models\User;
use App\Models\ownerhistory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\paymenttracker;
use DateTime;
use Carbon\Carbon;


class LotController extends Controller
{
    public function ViewMapAdmin()
    {
        $lotstatusget = Lot::orderBy('id', 'ASC')->get();

        // Convert PHP array to a JavaScript array
        $lotstatus = json_encode($lotstatusget);

        return view('admin.lot_crud.showmap', compact('lotstatusget'));
    }
    /**
     * Display the lots page.
    */
    public function ViewLotSettings()
    {
        $lottype = LotType::orderBy('created_at', 'DESC')->get();
        $lotclass = LotClass::orderBy('created_at', 'DESC')->get();
        
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

        return view('admin.settings.lotsetting', compact('lottype','lotclass', 'totalCount'));
    }

    /* code for creating lot type and then show toast */
    public function AddLotType(Request $request)
    {
        $validatedData = $request->validate([
            'lot_type_name' => 'required',
        ]);

        $sanitizedData = array_map('trim', $validatedData);
        $sanitizedData['lot_type_name'] = ucwords(strtolower($sanitizedData['lot_type_name']));

        LotType::create($sanitizedData);

        // Use session to store the success message
        session()->flash('success', 'Lot Type Added Successfully');

        // Redirect back with the success message
        return redirect()->route('lsetting');
    }

    public function GetLotType($id)
    {
        $lotType = LotType::find($id);
        return response()->json($lotType);
    }

    public function UpdateLotType(Request $request, $id)
    {
        $validatedData = $request->validate([
            'lot_type_name' => 'required',
        ]);

        $sanitizedData = array_map('trim', $validatedData);
        $sanitizedData['lot_type_name'] = ucwords(strtolower($sanitizedData['lot_type_name']));

        $lotType = LotType::find($id);
        $lotType->update($sanitizedData);

        // Store the success message in the session
        session()->flash('update_success', 'Lot Type updated successfully');

        return response()->json(['message' => 'Lot Type updated successfully']);
    }


    /**
     * Deletes the specified Lot Type
    */
    public function DeleteLotType(Request $request)
    {
        $lotTypeId = $request->input('lotTypeId');

        // Find the Lot Type record by ID
        $lotType = LotType::findOrFail($lotTypeId);

        $lotType->delete();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }




    /* code for creating lot class and then show toast */
    public function AddLotClass(Request $request)
    {
        $validatedData = $request->validate([
            'lot_class_name' => 'required',
        ]);

        $sanitizedData = array_map('trim', $validatedData);
        $sanitizedData['lot_class_name'] = ucwords(strtolower($sanitizedData['lot_class_name']));

        LotClass::create($sanitizedData);

        // Use session to store the success message
        session()->flash('success', 'Lot Class Added Successfully');

        // Redirect back with the success message
        return redirect()->route('lsetting');
    }

    /**
     * Deletes the specified Lot Class
    */
    public function DeleteLotClass(Request $request)
    {
        $lotClassId = $request->input('lotClassId');

        // Find the Lot Type record by ID
        $lotClass = LotClass::findOrFail($lotClassId);

        $lotClass->delete();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }

    public function GetLotClass($id)
    {
        $lotClass = LotClass::find($id);
        return response()->json($lotClass);
    }

    public function UpdateLotClass(Request $request, $id)
    {
        $validatedData = $request->validate([
            'lot_class_name' => 'required',
        ]);

        $sanitizedData = array_map('trim', $validatedData);
        $sanitizedData['lot_class_name'] = ucwords(strtolower($sanitizedData['lot_class_name']));

        $lotClass = LotClass::find($id);
        $lotClass->update($sanitizedData);

        // Store the success message in the session
        session()->flash('update_success', 'Lot Type updated successfully');

        return response()->json(['message' => 'Lot Type updated successfully']);
    }


    /**
     * Display the lots page.
    */
    public function ViewLots()
    {
        $lots = Lot::with(['lotType', 'lotClass','customer'])->get();

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

        return view('admin.lots', compact('lots', 'totalCount'));

    }

    /**
     * Display the add lot owner page.
    */
    public function ViewAddLotOwner()
    {
        $lots = Lot::where('lot_status', 'Available')->orderBy('created_at', 'asc')->get();
        $lotstatusget = Lot::orderBy('id', 'ASC')->get();

        // Convert PHP array to a JavaScript array
        $lotstatus = json_encode($lotstatusget);
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
        return view('admin.lot_crud.addlotowner', compact('lotstatusget','lots', 'totalCount'));

    }

    public function getCities($provinceCode)
    {
        $cities = refcitymun::where('provCode', $provinceCode)->get();
        return response()->json($cities);
    }

    public function getBarangays($citymunCode)
    {
        $barangays = refbrgy::where('citymunCode', $citymunCode)->get();
        return response()->json($barangays);
    }


    public function sessionlotstore(Request $request, $id)
    {
        // Get the existing session data or an empty array if it doesn't exist
        $sessionData = $request->session()->get('session_lot_id', []);
    
        // Add the new ID to the array if it doesn't already exist
        if (!in_array($id, $sessionData)) {
            $sessionData[] = $id;
            $request->session()->put('session_lot_id', $sessionData);
    
            $notification = ['message' => 'Lot added!', 'alert-type' => 'success'];
        } else {
            $notification = ['message' => 'Lot is already in session!', 'alert-type' => 'warning'];
        }
    
        return redirect()->back()->with($notification);
    }


    public function sessionlotremove(Request $request, $id)
    {
        $sessionKey = 'session_lot_id';

        // Get the existing session data or an empty array if it doesn't exist
        $sessionData = $request->session()->get($sessionKey, []);

        // Check if the ID exists in the array
        if (($key = array_search($id, $sessionData)) !== false) {
            // Remove the ID from the array
            unset($sessionData[$key]);

            // If the length is 1, forget the entire session key
            if (count($sessionData) === 1) {
                $request->session()->forget($sessionKey);
            } else {
                // Put the updated array back into the session
                $request->session()->put($sessionKey, $sessionData);
            }

            $notification = ['message' => 'Lot removed!', 'alert-type' => 'success'];
        } else {
            $notification = ['message' => 'Lot is not found in session!', 'alert-type' => 'warning'];
        }

        return redirect()->back()->with($notification);
    }










    public function getLotDetails($lotId)
    {
        $lot = Lot::find($lotId);

        if (!$lot) {
            return response()->json(['error' => 'Lot not found'], 404);
        }

        return response()->json(['product' => $lot]);
    }

    public function getPaymentDetails($lotTypeId, $lotClassId)
    {
        // Fetch payment types based on $lotTypeId and $lotClassId as an array
        $paymentTypes = PaymentSetting::where('lot_type_id', $lotTypeId)
            ->where('lot_class_id', $lotClassId)
            ->get();
    
        // Prepare the response data as an array of payment types
        $response = [
            'paymentTypes' => $paymentTypes,
        ];
    
        // Return the response as JSON
        return response()->json($response);
    }

    public function getPaymentDetails1($lotTypeId, $lotClassId)
    {
        // Fetch payment types based on $lotTypeId and $lotClassId as an array
        $paymentTypes1 = PaymentSetting::where('lot_type_id', $lotTypeId)
            ->where('lot_class_id', $lotClassId)
            ->get();
    
        // Prepare the response data as an array of payment types
        $response = [
            'paymentTypes1' => $paymentTypes1,
        ];
    
        // Return the response as JSON
        return response()->json($response);
    }

    public function getPaymentDetails2($lotTypeId, $lotClassId)
    {
        // Fetch payment types based on $lotTypeId and $lotClassId as an array
        $paymentTypes2 = PaymentSetting::where('lot_type_id', $lotTypeId)
            ->where('lot_class_id', $lotClassId)
            ->get();
    
        // Prepare the response data as an array of payment types
        $response = [
            'paymentTypes2' => $paymentTypes2,
        ];
    
        // Return the response as JSON
        return response()->json($response);
    }

    public function getPaymentDetails3($lotTypeId, $lotClassId)
    {
        // Fetch payment types based on $lotTypeId and $lotClassId as an array
        $paymentTypes3 = PaymentSetting::where('lot_type_id', $lotTypeId)
            ->where('lot_class_id', $lotClassId)
            ->get();
    
        // Prepare the response data as an array of payment types
        $response = [
            'paymentTypes3' => $paymentTypes3,
        ];
    
        // Return the response as JSON
        return response()->json($response);
    }

    public function getPaymentDetails4($lotTypeId, $lotClassId)
    {
        // Fetch payment types based on $lotTypeId and $lotClassId as an array
        $paymentTypes4 = PaymentSetting::where('lot_type_id', $lotTypeId)
            ->where('lot_class_id', $lotClassId)
            ->get();
    
        // Prepare the response data as an array of payment types
        $response = [
            'paymentTypes4' => $paymentTypes4,
        ];
    
        // Return the response as JSON
        return response()->json($response);
    }

    public function getPaymentSettingDetails($paymentType)
    {
        $paymentSetting = PaymentSetting::where('id', $paymentType)->first();

        if ($paymentSetting) {
            return response()->json($paymentSetting);
        } else {
            return response()->json(['error' => 'Payment details not found'], 404);
        }
    }

    public function getPaymentSettingDetails1($paymentType1s)
    {
        $paymentSettings = PaymentSetting::where('id', $paymentType1s)->first();

        if ($paymentSettings) {
            return response()->json($paymentSettings);
        } else {
            return response()->json(['error' => 'Payment details not found'], 404);
        }
    }

    public function getPaymentSettingDetails2($paymentType2s)
    {
        $paymentSettings = PaymentSetting::where('id', $paymentType2s)->first();

        if ($paymentSettings) {
            return response()->json($paymentSettings);
        } else {
            return response()->json(['error' => 'Payment details not found'], 404);
        }
    }

    public function getPaymentSettingDetails3($paymentType3s)
    {
        $paymentSettings = PaymentSetting::where('id', $paymentType3s)->first();

        if ($paymentSettings) {
            return response()->json($paymentSettings);
        } else {
            return response()->json(['error' => 'Payment details not found'], 404);
        }
    }

    public function getPaymentSettingDetails4($paymentType4s)
    {
        $paymentSettings = PaymentSetting::where('id', $paymentType4s)->first();

        if ($paymentSettings) {
            return response()->json($paymentSettings);
        } else {
            return response()->json(['error' => 'Payment details not found'], 404);
        }
    }
    
    /* code for creating user and puts the lot id and customer id and then show toast */
    public function AddLotOwner(Request $request)
    {
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
            'benificiary_fullname' => 'required',
            'benificiary_date_of_birth' => 'required',
            'relationship' => 'required',
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
            'valid_id' => $imageName,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Hash the password
            'benificiary_fullname' => $request->benificiary_fullname,
            'benificiary_date_of_birth' => $request->benificiary_date_of_birth,
            'relationship' => $request->relationship,
        ]);

            // get lot data if the checkbox is checked
            if ($request->has('lot_id')) {
                foreach ($request->input('lot_id') as $key => $value) {
                    $paymentType = $request->input("ptype_name.$key");
                    $paymentSettingId = $request->input("ptype.$key");
                    $paymentSetting = PaymentSetting::find($paymentSettingId);
                    $paymentData = [
                        'lot_id' => $request->input("lot_id.$key"),
                        'payment_setting_id' => $paymentSettingId,
                        'pay_thru' => $request->input("pthru"),
                        'customer_id' => $customer->id,
                    ];
            
                    // Check payment type and modify paymentData array accordingly
                    if ($paymentSetting->payment_type == 'Cash') {
                        $paymentData['status'] = 'Fully Paid';
                        $paymentData['downpayment'] = $paymentSetting->cash_full_price; // Add full payment data
                        $paymentData['total_amount_paid'] = $paymentSetting->cash_full_price;;

                        // Create Payment record for Cash payment type
                        $payment = Payment::create($paymentData);
                    }elseif ($paymentSetting->payment_type == 'Installment') {
                        $noOfYear = $paymentSetting->no_year;
                        $startDate = new DateTime($request->input("date_started"));
                        $dueDates = [];
                    
                        // Calculate due dates for installments based on the number of years (times 12 for months)
                        for ($i = 1; $i <= $noOfYear * 12; $i++) {
                            // Add due date to $dueDates array
                            $dueDate = $startDate->format('Y-m-d'); // Set due date to the first day of the month
                            $dueDates[] = $dueDate;
                            $startDate->modify('+1 month'); // Move to the next month
                        }
                    
                        $paymentData['status'] = 'Partial';
                        $paymentData['downpayment'] = $request->input("downpayment.$key"); // Add downpayment data for installment
                        $paymentData['total_amount_paid'] = $request->input("downpayment.$key");
                    
                        // Create Payment record for Installment payment type
                        $payment = Payment::create($paymentData);
                    
                        // After successful creation, update Payment Tracker with due dates
                        $totalAmountPaid = 0; // To keep track of the total amount paid

                        foreach ($dueDates as $index => $dueDate) {
                            // Compute price monthly based on no of years, downpayment, and installment full price
                            $installmentFullPrice = $paymentSetting->installment_full_price;
                            $downpayment = $request->input("downpayment.$key");
                            $noOfYear = $paymentSetting->no_year;

                            // Calculate price monthly
                            $priceMonthly = round(($installmentFullPrice - $downpayment) / ($noOfYear * 12), 2);

                            // Set the first due date to the next month from the date_started
                            $nextMonthDueDate = (new DateTime($dueDate))->modify('+1 month')->format('Y-m-d');

                            // If it's the last month, adjust the monthly price to cover the remaining balance
                            if ($index === count($dueDates) - 1) {
                                $priceMonthly = $installmentFullPrice - ($totalAmountPaid + $downpayment);
                            }

                            $paymentTrackerData = [
                                'payment_id' => $payment->id,
                                'date' => null,
                                'payment_status' => 'Pending',
                                'price_monthly' => $priceMonthly,
                                'amount_paid' => null,
                                'due_date' => $nextMonthDueDate,
                                'customer_id' => $customer->id,
                                // Other fields as needed
                            ];

                            paymenttracker::create($paymentTrackerData);

                            // Update total amount paid
                            $totalAmountPaid += $priceMonthly;
                        }
                    }
                    
                    // Find the lot based on lot ID
                    $lot = Lot::find($request->input("lot_id.$key"));

                    // Check if the lot is found
                    if ($lot) {
                        // Update lot data
                        $lotData = [
                            'customer_id' => $customer->id, // Associate the customer with the lot using its ID
                            'lot_status' => 'Reserved', // Set lot status to Reserved
                        ];

                        // Update the lot record
                        $lot->update($lotData);
                    }
                }
            }
        
        // Forget the session variable directly
        $request->session()->forget('session_lot_id');
        
        $notification = ['message' => 'Lot Owner Added Successfully!', 'alert-type' => 'success'];
        return redirect()->route('lots')->with($notification);
    }

    public function ViewLot($id)
    {
        // Fetch lot data by ID
        $lot = Lot::find($id);
    
        // Check if the lot was not found
        if (!$lot) {
            return response()->json(['error' => 'Lot not found'], 404);
        }

        // Initialize customer-related variables to empty strings
        $customerFirstName = '';
        $customerMiddleName = '';
        $customerLastName = '';
        $customerSuffix = '';

        // Check if the lot has a customer associated with it
        if ($lot->customer_id) {
            // Fetch customer data by ID
            $customer = User::find($lot->customer_id);

            // Check if the customer was found
            if ($customer) {
                // Set customer-related variables
                $customerFirstName = $customer->first_name;
                $customerMiddleName = $customer->middle_name;
                $customerLastName = $customer->last_name;
                $customerSuffix = $customer->suffix;
            }
        }

        // Concatenate customer full name
        $customerFullName = trim("{$customerFirstName} {$customerMiddleName} {$customerLastName} {$customerSuffix}");

        // Fetch lot owner history records for the given lot ID
        $lotOwnerHistory = ownerhistory::where('lot_id', $id)->get();

        // Initialize an array to store the modified lot owner history data
        $formattedLotOwnerHistory = [];

        // Iterate over the lot owner history records
        foreach ($lotOwnerHistory as $history) {
            // Fetch customer data by ID
            $customerhistory = User::find($history->customer_id);

            // Check if the customer was found
            if ($customerhistory) {
                // Build the full name
                $customerHistoryFullName = trim("{$customerhistory->first_name} {$customerhistory->middle_name} {$customerhistory->last_name} {$customerhistory->suffix}");

                // Add the required data to the formatted array
                $formattedLotOwnerHistory[] = [
                    'lot_owner_history' => $customerHistoryFullName,
                    'date' => $history->date,
                    'lot_title' => $history->lot_title,
                    'deed_of_sale' => $history->deed_of_sale,
                    // Add other fields as needed
                ];
            }
        }
        /* dd($formattedLotOwnerHistory); */
        // Return lot data as JSON response
        return response()->json([
            'section' => $lot->section,
            'lot_no' => $lot->lot_no,
            'lot_type' => $lot->lotType->lot_type_name,
            'lot_class' => $lot->lotClass->lot_class_name,
            'status' => $lot->lot_status,
            'lot_owner' => $customerFullName,
            'lot_owner_history' => $formattedLotOwnerHistory,
            // Add other columns as needed
        ]);
    }
    
    public function ResetLot(Request $request)
    {
        // Validate the request if needed
        $request->validate([
            'lotId' => 'required|exists:lots,id',
        ]);

        $lotId = $request->input('lotId');

        // Find the lot by ID
        $lot = Lot::find($lotId);

        if (!$lot) {
            return response()->json(['success' => false, 'message' => 'Lot not found.']);
        }

        // Update lot columns
        $lot->update([
            'customer_id' => null,
            'lot_status' => 'Available',
            'lot_title' => null,
        ]);

        // Find the payment by lot ID
        $payment = Payment::where('lot_id', $lotId)->first();

        if ($payment) {
            // Find payment tracker entries by payment ID
            $paymentTrackerEntries = paymenttracker::where('payment_id', $payment->id)->get();

            // Delete payment tracker entries
            if ($paymentTrackerEntries->isNotEmpty()) {
                paymenttracker::where('payment_id', $payment->id)->delete();
            }

            // Delete payment
            $payment->delete();
        }

        return response()->json(['message' => 'Lot Reset successfully']);
    }

    public function updateLotStatus(Request $request)
    {
        $request->validate([
            'lotId' => 'required|exists:lots,id',
            'lotStatus' => 'required|in:Unavailable,Available,Reserved,Intered',
        ]);

        $lot = Lot::find($request->input('lotId'));
        $lot->lot_status = $request->input('lotStatus');
        $lot->save();

        return response()->json(['message' => 'Lot status updated successfully']);
    }

    public function getLotStatus(Request $request)
    {
        $request->validate([
            'lotId' => 'required|exists:lots,id',
        ]);

        $lot = Lot::find($request->input('lotId'));

        return response()->json(['status' => $lot->lot_status]);
    }

}
