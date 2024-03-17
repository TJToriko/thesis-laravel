<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Lot;
use App\Models\customer;
use App\Models\paymenttracker;
use App\Models\refprovince;
use App\Models\refbrgy;
use App\Models\refcitymun;
use App\Models\User;
use DateTime;
use Carbon\Carbon;
use App\Models\registrationnotification;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    /**
     * Display the Payment page.
    */
    public function ViewPayment()
    {
        $pendinguser = User::where('id', '!=', Auth::id())
        ->where('status', '=', 'pending') // Add this condition
        ->orderBy('id', 'asc')
        ->get();

        $payments = User::where('id', '!=', Auth::id())
        ->where('status', '=', 'approved') // Add this condition
        ->where('role', '=', 'customer') // Add this condition
        ->orderBy('created_at', 'DESC')
        ->get();

        // Count the occurrences of each customer ID in the Payment table
        $customerCounts = [];
        foreach ($payments as $customer) {
            $customerId = $customer->id;
            $paymentCount = Lot::where('customer_id', $customerId)->count();
            $customerCounts[$customerId] = $paymentCount;
        }

    
        return view('admin.payment', compact('payments', 'customerCounts', 'pendinguser'));
    }
    
    public function ViewCustomer($id)
    {
        $data = User::findorfail($id);

        return view('admin.payment_info.view_customer', compact('data'));
    }

    public function ApproveCustomer($id)
    {
        $data = User::findorfail($id);
        $data->update([
            'status' => 'approved',
        ]);
        $notification = ['message' => 'Customer Approved Successfully!', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function RejectCustomer($id)
    {
        $data = User::findorfail($id);
        $data->update([
            'status' => 'rejected',
        ]);
        $notification = ['message' => 'Customer Rejected Successfully!', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }
    
    /**
     * Display the Payment Detail page.
    */
    public function ViewPaymentDetail($id)
    {

        $customer = User::where('id', $id)->firstOrFail();
        
        // Get payments related to the same customer with status 'Partial'
        $customerlots = Payment::where('customer_id', $customer->id)
        ->get();
        
        // Get payments related to the same customer with status 'Partial'
        $customerlotpayments = Payment::where('customer_id', $customer->id)
        ->where('status', 'Partial')
        ->get();


        // Get payments related to the same customer
        $duedates = paymenttracker::with('payment')->where('customer_id', $customer->id)->get();

        return view('admin.payment_info.viewpayment', compact('customer', 'customerlots', 'customerlotpayments', 'duedates'));
    }

    public function getFullPrice($lotId)
    {
        $payment = Payment::where('id', $lotId)->first();
        $rebateAmount = PaymentSetting::where('id', $payment->payment_setting_id)->first();
        
        // Retrieve the monthly amount from PaymentTracker based on payment_id
        $paymenttrackers = paymenttracker::where('payment_id', $lotId)->where('payment_status', '!=', 'Paid')->get();

        $totalFullAmount = 0;
        $totalRebateAmount = 0;
        $totalMonthlyAmount = 0;

        foreach ($paymenttrackers as $paymenttracker) {
            // Check if the due date is greater than today's date
            if (strtotime($paymenttracker->due_date) > strtotime(now()->format('Y-m-d'))) {
                // Subtract rebate amount from the monthly price
                $monthlyAmount = $paymenttracker->price_monthly - $rebateAmount->rebate_price;
                // Add rebate amount to the total rebate
                $totalRebateAmount += $rebateAmount->rebate_price;
            } else {
                // No rebate, use the original monthly price
                $monthlyAmount = $paymenttracker->price_monthly;
            }

            // Add the monthly amount to the total monthly amount
            $totalMonthlyAmount += $monthlyAmount;

            // Add the monthly amount to the total full amount
            $totalFullAmount += $monthlyAmount;
        }

        $data = [
            'totalfullamount' => $totalFullAmount,
            'totalRebateAmount' => $totalRebateAmount,
            'totalMonthlyAmount' => $totalMonthlyAmount,
            'rebateAmount' => $rebateAmount,
            'paymenttracker' => $paymenttracker, // Note: This will contain the last paymenttracker in the loop
        ];

        return response()->json($data);
    }

    public function payFullPrice(Request $request)
    {
        $payment = Payment::where('id', $request->lot_id)->first();
        $rebateAmount = PaymentSetting::where('id', $payment->payment_setting_id)->first();
        
        // Retrieve the monthly amount from PaymentTracker based on payment_id
        $paymenttrackers = paymenttracker::where('payment_id', $request->lot_id)->where('payment_status', '!=', 'Paid')->get();

        $totalFullAmount = 0;
        $totalRebateAmount = 0;
        $totalMonthlyAmount = 0;

        foreach ($paymenttrackers as $paymenttracker) {
            // Check if the due date is greater than today's date
            if (strtotime($paymenttracker->due_date) > strtotime(now()->format('Y-m-d'))) {
                
                // Subtract rebate amount from the monthly price
                $monthlyAmount = $paymenttracker->price_monthly - $rebateAmount->rebate_price;
                // Add rebate amount to the total rebate
                $totalRebateAmount += $rebateAmount->rebate_price;
                $paymenttracker->date = now()->format('Y-m-d');
                $paymenttracker->payment_status = 'Paid';
                $paymenttracker->amount_paid = $paymenttracker->price_monthly - $rebateAmount->rebate_price;
                $paymenttracker->type = 'Office';
                $paymenttracker->save();
            } else {
                // No rebate, use the original monthly price
                $monthlyAmount = $paymenttracker->price_monthly;
                $paymenttracker->date = now()->format('Y-m-d');
                $paymenttracker->payment_status = 'Paid';
                $paymenttracker->amount_paid = $paymenttracker->price_monthly;
                $paymenttracker->type = 'Office';
                $paymenttracker->save();
            }

            // Add the monthly amount to the total monthly amount
            $totalMonthlyAmount += $monthlyAmount;

            // Add the monthly amount to the total full amount
            $totalFullAmount += $monthlyAmount;
        }

        if ($payment) {
            $payment->status = 'Fully Paid';
            $payment->total_amount_paid += $totalFullAmount;
            $payment->total_rebate_amount += $totalRebateAmount;
            $payment->save();
        }

        $notification = ['message' => 'Payments added Successfully!', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function getDueDate($lotId)
    {
        $payment = Payment::where('id', $lotId)->first();
    
        // Retrieve the monthly amount from PaymentTracker based on payment_id
        $paymenttracker = paymenttracker::where('payment_id', $lotId)->first();
    
        $dueDates = paymenttracker::where('payment_id', $lotId)
        ->where('payment_status', '!=', 'Paid')
        ->get();
    
        if ($paymenttracker) {
            // Create an associative array to include both payment tracker and due dates
            $data = [
                'dueDates' => $dueDates,
            ];
    
            // Return the array as a JSON response
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Payment details not found'], 404);
        }
    }

    public function getMonthlyPrice($paymenttrackerId)
    {
        // Retrieve the monthly amount from PaymentTracker based on payment_id
        $paymenttracker = paymenttracker::where('id', $paymenttrackerId)->first();
        $payment = Payment::where('id', $paymenttracker->payment_id)->first();
        $rebateAmount = PaymentSetting::where('id', $payment->payment_setting_id)->first();
        if ($paymenttracker) {
            // Create an associative array to include both payment tracker and due dates
            $data = [
                'paymenttracker' => $paymenttracker,
                'rebateAmount' => $rebateAmount,
            ];
    
            // Return the array as a JSON response
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Payment details not found'], 404);
        }
    }

    public function getMonthlyPrice1($lotId)
    {
        $payment = Payment::where('id', $lotId)->first();
    
        $rebateAmount = PaymentSetting::where('id', $payment->payment_setting_id)->first();
    
        // Retrieve the monthly amount from PaymentTracker based on payment_id
        $paymenttracker = paymenttracker::where('payment_id', $lotId)->first();
    
        $dueDates = paymenttracker::where('payment_id', $lotId)
        ->where('payment_status', '!=', 'Paid')
        ->get();
    
        if ($paymenttracker) {
            // Create an associative array to include both payment tracker and due dates
            $data = [
                'paymenttracker' => $paymenttracker,
                'dueDates' => $dueDates,
                'rebateAmount' => $rebateAmount,
            ];
    
            // Return the array as a JSON response
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Payment details not found'], 404);
        }
    }

    public function getMonthlyPrice2($lotId)
    {
        $payment = Payment::where('id', $lotId)->first();
    
        $rebateAmount = PaymentSetting::where('id', $payment->payment_setting_id)->first();
    
        // Retrieve the monthly amount from PaymentTracker based on payment_id
        $paymenttracker = paymenttracker::where('payment_id', $lotId)->first();
    
        $dueDates = paymenttracker::where('payment_id', $lotId)
        ->where('payment_status', '!=', 'Paid')
        ->get();
    
        if ($paymenttracker) {
            // Create an associative array to include both payment tracker and due dates
            $data = [
                'paymenttracker' => $paymenttracker,
                'dueDates' => $dueDates,
                'rebateAmount' => $rebateAmount,
            ];
    
            // Return the array as a JSON response
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Payment details not found'], 404);
        }
    }

    public function getMonthlyPrice3($lotId)
    {
        $payment = Payment::where('id', $lotId)->first();
    
        $rebateAmount = PaymentSetting::where('id', $payment->payment_setting_id)->first();
    
        // Retrieve the monthly amount from PaymentTracker based on payment_id
        $paymenttracker = paymenttracker::where('payment_id', $lotId)->first();
    
        $dueDates = paymenttracker::where('payment_id', $lotId)
        ->where('payment_status', '!=', 'Paid')
        ->get();
    
        if ($paymenttracker) {
            // Create an associative array to include both payment tracker and due dates
            $data = [
                'paymenttracker' => $paymenttracker,
                'dueDates' => $dueDates,
                'rebateAmount' => $rebateAmount,
            ];
    
            // Return the array as a JSON response
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Payment details not found'], 404);
        }
    }

    public function addPayment(Request $request)
    {
        $paymentIds = $request->input('payment_id');
        $amountPaidArray = $request->input('amount_paid');
        $totalPayment = $request->input('total_payment');

        // Iterate through each payment ID
        foreach ($paymentIds as $key => $paymentId) {
            // Find the payment tracker by ID
            $paymentTracker = paymenttracker::find($paymentId);

            // Update payment tracker columns
            if ($paymentTracker) {
                $paymentTracker->date = $request->input('today_date');
                $paymentTracker->payment_status = 'Paid';
                $paymentTracker->amount_paid = $amountPaidArray[$key];
                $paymentTracker->type = 'Office';
                $paymentTracker->save();
            }
            
            // Calculate total rebate amount
            $totalRebateAmount =($paymentTracker->price_monthly - $amountPaidArray[$key]);

            // Update payment table
            $payment = Payment::find($paymentTracker->payment_id);
            if ($payment) {
                $addedTotalAmountPaid = $payment->total_amount_paid + $amountPaidArray[$key];
                $addedRebateAmount = $payment->total_rebate_amount + $totalRebateAmount;
    
                // Check if total amount paid is equal to payment full installment price
                if ($payment->paymentsetting->installment_full_price <= ($addedTotalAmountPaid + $addedRebateAmount)) {
                    $payment->status = 'Fully Paid';
                    $payment->total_amount_paid = $payment->paymentsetting->installment_full_price;
                    $payment->total_rebate_amount += $totalRebateAmount;
                    $payment->save();
                }else{
                    $payment->total_amount_paid += $amountPaidArray[$key];
                    $payment->total_rebate_amount += $totalRebateAmount;
                    $payment->save();
                }
            }
        }
        
        $notification = ['message' => 'Payments added Successfully!', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function ViewEditCustomer(string $id)
    {
        // Get the payment details with lot, paymentsetting, and customer relationships based on the customer ID
        $customer = customer::where('id', $id)->firstOrFail();
        
        $province = refprovince::orderBy('created_at', 'DESC')->get();
        $barangay = refbrgy::orderBy('created_at', 'DESC')->get();
        $city = refcitymun::orderBy('created_at', 'DESC')->get();

        
        return view('admin.payment_info.editcustomer', compact('customer', 'province', 'city', 'barangay'));
    }

    public function UpdateCustomer(Request $request, string $id)
    {
        $customer = customer::findOrFail($id);

        // Validation Rules
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
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'cp_no' => 'required|digits:11',
            'occupation' => 'required|string',
            'place_of_birth' => 'required|string',
            'date_of_birth' => 'required|date',
            'sex' => 'required|string',
            'benificiary_fullname' => 'required|string',
            'benificiary_date_of_birth' => 'required|date',
            'relationship' => 'required|string',
            'id_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20048',
        ];

        // Validate the request data
        $validatedData = $request->validate($rules);

        // Upload valid id image if provided
        if ($request->hasFile('id_image')) {
            $image = $request->file('id_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/valid_id_images'), $imageName);
            $sanitizedData['id_image'] = $imageName;
        }

        // Extract and sanitize validated fields
        $sanitizedData = [
            'first_name' => ucwords(strtolower(trim($validatedData['first_name']))),
            'middle_name' => $validatedData['middle_name'] ? ucwords(strtolower(trim($validatedData['middle_name']))) : null,
            'last_name' => ucwords(strtolower(trim($validatedData['last_name']))),
            'suffix' => $validatedData['suffix'] ? ucwords(strtolower(trim($validatedData['suffix']))) : null,
            'province' => ucwords(strtolower(trim($validatedData['province']))),
            'city' => ucwords(strtolower(trim($validatedData['city']))),
            'barangay' => ucwords(strtolower(trim($validatedData['barangay']))),
            'street' => ucwords(strtolower(trim($validatedData['street']))),
            'landmark' => $validatedData['landmark'] ? ucwords(strtolower(trim($validatedData['landmark']))) : null,
            'email' => $validatedData['email'],
            'cp_no' => $validatedData['cp_no'],
            'occupation' => ucwords(strtolower(trim($validatedData['occupation']))),
            'place_of_birth' => ucwords(strtolower(trim($validatedData['place_of_birth']))),
            'date_of_birth' => $validatedData['date_of_birth'],
            'sex' => $validatedData['sex'],
            'benificiary_fullname' => ucwords(strtolower(trim($validatedData['benificiary_fullname']))),
            'benificiary_date_of_birth' => $validatedData['benificiary_date_of_birth'],
            'relationship' => ucwords(strtolower(trim($validatedData['relationship']))),
        ];

        // Update the customer record using the sanitized data
        $customer->update($sanitizedData);

        // Use session to store the success message
        session()->flash('success', 'Customer Details Updated Successfully');

        // Redirect back with the success message
        return redirect()->route('paymentsdetail', $customer->id);
    }

    /**
     * Display the Add lot page.
    */
    public function ViewAddLot($id)
    {

        $customer = User::where('id', $id)->firstOrFail();
        
        // Get payments related to the same customer with status 'Partial'
        $customerlots = Payment::where('customer_id', $customer->id)
        ->get();
        
        // Get payments related to the same customer with status 'Partial'
        $customerlotpayments = Payment::where('customer_id', $customer->id)
        ->where('status', 'Partial')
        ->get();


        // Get payments related to the same customer
        $duedates = paymenttracker::with('payment')->where('customer_id', $customer->id)->get();
        
        $lots = Lot::where('lot_status', 'Available')->orderBy('created_at', 'asc')->get();


        return view('admin.payment_info.addlot', compact('customer', 'lots', 'customerlots', 'customerlotpayments', 'duedates',));
    }

       /* code for creating user and puts the lot id and customer id and then show toast */
       public function AddLot(Request $request)
       {
        // get lot data if the checkbox is checked
        if ($request->has('lot_id')) {
            foreach ($request->input('lot_id') as $key => $value) {

                $paymentSettingId = $request->input("ptype.$key");
                $paymentSetting = PaymentSetting::find($paymentSettingId);
                $paymentData = [
                    'lot_id' => $request->input("lot_id.$key"),
                    'payment_setting_id' => $paymentSettingId,
                    'pay_thru' => $request->input("pthru"),
                    'customer_id' => $request->input("customer_id"),
                ];
        
                // Check payment type and modify paymentData array accordingly
                if ($paymentSetting->payment_type == 'Cash') {
                    $paymentData['status'] = 'Fully Paid';
                    $paymentData['downpayment'] = $paymentSetting->cash_full_price; // Add full payment data
                    $paymentData['total_amount_paid'] = $paymentSetting->cash_full_price;

                    // Create Payment record for Cash payment type
                    $payment = Payment::create($paymentData);
                } elseif ($paymentSetting->payment_type == 'Installment') {
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
                    foreach ($dueDates as $dueDate) {
                        // Compute price monthly based on no of years, downpayment, and installment full price
                        $installmentFullPrice = $paymentSetting->installment_full_price;
                        $downpayment = $request->input("downpayment.$key");
                        $noOfYear = $paymentSetting->no_year;
                        
                        // Calculate price monthly
                        $priceMonthly = ($installmentFullPrice - $downpayment) / ($noOfYear * 12);
                    
                        $paymentTrackerData = [
                            'payment_id' => $payment->id,
                            'date' => null,
                            'payment_status' => 'Pending',
                            'price_monthly' => $priceMonthly,
                            'amount_paid' => null,
                            'due_date' => $dueDate,
                            'customer_id' => $request->input("customer_id"),
                            // Other fields as needed
                        ];
                    
                        paymenttracker::create($paymentTrackerData);
                    }
                    
                }

                // Find the lot based on lot ID
                $lot = Lot::find($request->input("lot_id.$key"));

                // Check if the lot is found
                if ($lot) {
                    // Update lot data
                    $lotData = [
                        'customer_id' => $request->input("customer_id"), // Associate the customer with the lot using its ID
                        'lot_status' => 'Reserved', // Set lot status to Reserved
                    ];

                    // Update the lot record
                    $lot->update($lotData);
                }
            }
        }
        
        $notification = ['message' => 'Transfered Owner To Beneficiary Successfully!', 'alert-type' => 'success'];
        return redirect()->route('paymentsdetail', $request->input("customer_id"))->with($notification);
       
       }

    /**
     * Deletes the specified Customer
    */
    public function DeleteCustomer(Request $request)
    {
        $customerId = $request->input('customerId');

        // Find the Lot Type record by ID
        $customer = customer::findOrFail($customerId);

        $customer->delete();

        // Use session to store the success message
        session()->flash('success', 'Customer Deleted Successfully');
        
        // Redirect with success message
        return redirect()->route('payment');
    }


}
