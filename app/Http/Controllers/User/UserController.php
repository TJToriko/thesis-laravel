<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lot;
use App\Models\Carousel;
use App\Models\Aboutus;
use App\Models\Policy;
use App\Models\Logo;
use App\Models\Services;
use App\Models\PaymentSetting;
use App\Models\paymenttracker;
use App\Models\Payment;
use DateTime;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the user landing page.
    */
    public function ViewLandingPage()
    {
        $carousels = Carousel::orderBy('id', 'ASC')->get();
        $policys = Policy::orderBy('id', 'ASC')->get();
        $services = Services::orderBy('id', 'ASC')->get();
        return view('users.index', compact('carousels', 'policys', 'services'));
    }

    /**
     * Display the Gravesite page.
    */
    public function ViewGravesitePage()
    {
        $lotstatusget = Lot::orderBy('id', 'ASC')->get();

        // Convert PHP array to a JavaScript array
        $lotstatus = json_encode($lotstatusget);
    
        return view('users.gravesite', compact('lotstatusget'));
    }

    /**
     * Display the Contact page.
    */
    public function ViewContactPage()
    {
        return view('users.contact');
    }
    
    /**
     * Display the Profile page.
    */
    public function ViewProfilePage()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Retrieve payments matching the criteria
        $userlot = Payment::where('customer_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $totallots = Lot::where('customer_id', Auth::id())->count();
        $reservedlots = Payment::where('customer_id', Auth::id())->where('status', 'Partial')->count();
        $paidlots = Payment::where('customer_id', Auth::id())->where('status', 'Fully Paid')->count();

        return view('users.profile.home', compact('userlot', 'totallots', 'reservedlots', 'paidlots'));
    }

    /**
     * Display the Reserve page.
    */
    public function ViewReservePage()
    {
        /* dd(session()->has('session_lot_id')); */
        $lotstatusget = Lot::orderBy('id', 'ASC')->get();

        // Convert PHP array to a JavaScript array
        $lotstatus = json_encode($lotstatusget);

        return view('users.reserved', compact('lotstatusget'));
    }

    /**
     * Display the My Lot page.
    */
    public function ViewMyLotPage()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Retrieve payments matching the criteria
        $userlot = Payment::where('customer_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('users.profile.mylots', compact('userlot'));
    }

    /**
     * Display the Lot Page.
    */
    public function ViewMyLot($id)
    {
        $userlot = Payment::findOrFail($id);
        $paymenttracker = paymenttracker::where('payment_id', $id)->get();
        return view('users.profile.viewlot', compact('userlot', 'paymenttracker'));
    }
    

    //Reservation Page
    public function sessionlotstoreuser(Request $request, $id)
    {
        // Get the existing session data or an empty array if it doesn't exist
        $sessionData = $request->session()->get('session_lot_id', []);
    
        // Add the new ID to the array if it doesn't already exist
        if (!in_array($id, $sessionData)) {
            $sessionData[] = $id;
            $request->session()->put('session_lot_id', $sessionData);
    
            $notification = ['message' => 'Lot added!', 'alert-type' => 'success'];
            return redirect()->route('reserve')->with($notification);
        } else {
            $notification = ['message' => 'Lot is already in session!', 'alert-type' => 'warning'];
            return redirect()->back()->with($notification);
        }
    }

    public function sessionlotremoveuser(Request $request, $id)
    {
        $sessionKey = 'session_lot_id';

        // Get the existing session data or an empty array if it doesn't exist
        $sessionData = $request->session()->get($sessionKey, []);

        // Check if the ID exists in the array
        if (($key = array_search($id, $sessionData)) !== false) {
            // Remove the ID from the array
            unset($sessionData[$key]);

            // If the length is 1, forget the entire session key
            if (empty($sessionData)) {
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

    public function CustomerAddLot(Request $request)
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
                 'customer_id' => Auth::id(),
                 'date_to_collect' => $request->input("date_to_collect"),
             ];
     
             // Check payment type and modify paymentData array accordingly
             if ($paymentSetting->payment_type == 'Cash') {
                 $paymentData['status'] = 'Pending';
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
     
                 $paymentData['status'] = 'Pending';
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
                         'customer_id' => Auth::id(),
                         // Other fields as needed
                     ];

                     paymenttracker::create($paymentTrackerData);

                     // Update total amount paid
                     $totalAmountPaid += $priceMonthly;
                 }
                 
             }
         }
     }

     // Forget the session variable directly
     $request->session()->forget('session_lot_id');
     
     $notification = ['message' => 'Process Successfully! Now waiting for Payment for Successfully Reserving', 'alert-type' => 'success'];
     return redirect()->route('profile.user')->with($notification);
    
    }
}
