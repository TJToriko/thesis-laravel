<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LotType;
use App\Models\LotClass;
use App\Models\PaymentSetting;
use App\Models\paymenttracker;
use Carbon\Carbon;

class PaymentSettingController extends Controller
{
    /**
     * Display the payment setting page.
    */
    public function ViewPaymentSettings()
    {
        $paymentsetting = PaymentSetting::with(['lotType', 'lotClass'])->get();

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

        return view('admin.settings.paymentsetting', compact('paymentsetting', 'totalCount'));
    }

    /**
     * Display the Add Payment Setting page.
    */
    public function ViewAddPaymentSettings()
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

        return view('admin.settings.setting_crud.addpayment', compact('lottype','lotclass', 'totalCount'));
    }

    /* code for creating Payment Setting and then show toast */
    public function AddPaymentSetting(Request $request)
    {
        // Validation Rules
        $rules = [
            'lot_type_id' => 'required|string',
            'lot_class_id' => 'nullable|string',
            'payment_name' => 'required|string',
            'payment_type' => 'required|string',
            'cash_full_price' => 'nullable|numeric|min:0',
            'installment_full_price' => 'nullable|numeric|min:0',
            'no_year' => 'nullable|numeric|min:0',
            'installment_monthly_price' => 'nullable|numeric|min:0',
            'with_rebate' => 'nullable|string',
            'rebate_price' => 'nullable|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
        ];

        // Validate the request data
        $validatedData = $request->validate($rules);

        // Determine the value for 'with_rebate' based on checkbox status
        $withRebateValue = ($request->input('with_rebate') === 'yes') ? 'yes' : 'no';

        // Set 'no_year' to 0 if 'payment_type' is 'Cash'
        $noYear = ($validatedData['payment_type'] === 'Cash') ? 0 : $validatedData['no_year'];

        // Set 'no_year' to 0 if 'payment_type' is 'Cash'
        $noYear = ($validatedData['payment_type'] === '') ? Null : $validatedData['no_year'];

        // Sanitize the data
        $sanitizedData = [
            'lot_type_id' => $validatedData['lot_type_id'],
            'lot_class_id' => $validatedData['lot_class_id'] ?? null,
            'payment_name' => trim($validatedData['payment_name']),
            'payment_type' => trim($validatedData['payment_type']),
            'cash_full_price' => $validatedData['cash_full_price'] ?? null,
            'installment_full_price' => $validatedData['installment_full_price'] ?? null,
            'no_year' => $noYear,
            'installment_monthly_price' => $validatedData['installment_monthly_price'] ?? null,
            'with_rebate' => $withRebateValue,
            'rebate_price' => $validatedData['rebate_price'] ?? null,
            'min_amount' => $validatedData['min_amount'] ?? null,
        ];

        // Create the PaymentSetting record
        PaymentSetting::create($sanitizedData);

        // Use session to store the success message
        session()->flash('success', 'Payment Added Successfully');

        // Redirect back with the success message
        return redirect()->route('psetting');
    }

    /**
     * Deletes the specified Payment
    */
    public function DeletePaymentSetting(Request $request)
    {
        $paymentId = $request->input('paymentId');

        // Find the Lot Type record by ID
        $paymentsetting = PaymentSetting::findOrFail($paymentId);

        $paymentsetting->delete();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }

    /**
     * Display the payment setting page.
    */
    public function ViewEditPaymentSetting(string $id)
    {
        $paymentsetting = PaymentSetting::with(['lotType', 'lotClass'])->findOrFail($id);
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
        return view('admin.settings.setting_crud.editpayment', compact('paymentsetting','lottype','lotclass', 'totalCount'));
    }
  
    /* code for updating Payment Setting and then show toast */
    public function UpdatePaymentSetting(Request $request, string $id)
    {
        $paymentsetting = PaymentSetting::findOrFail($id);

        // Validation Rules
        $rules = [
            'lot_type_id' => 'required|string',
            'lot_class_id' => 'nullable|string',
            'payment_name' => 'required|string',
            'payment_type' => 'required|string',
            'cash_full_price' => 'nullable|numeric|min:0',
            'installment_full_price' => 'nullable|numeric|min:0',
            'no_year' => 'nullable|numeric|min:0',
            'installment_monthly_price' => 'nullable|numeric|min:0',
            'with_rebate' => 'nullable|string',
            'rebate_price' => 'nullable|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
        ];

        // Validate the request data
        $validatedData = $request->validate($rules);

        // Determine the value for 'with_rebate' based on checkbox status
        $withRebateValue = ($request->input('with_rebate') === 'yes') ? 'yes' : 'no';

        // Set 'no_year' to 0 if 'payment_type' is 'Cash'
        $noYear = ($validatedData['payment_type'] === 'Cash') ? 0 : $validatedData['no_year'];

        // Sanitize the data
        $sanitizedData = [
            'lot_type_id' => ucwords(strtolower(trim($validatedData['lot_type_id']))),
            'lot_class_id' => ucwords(strtolower(trim($validatedData['lot_class_id']))),
            'payment_name' => trim($validatedData['payment_name']),
            'payment_type' => trim($validatedData['payment_type']),
            'cash_full_price' => $validatedData['cash_full_price'] ?? null,
            'installment_full_price' => $validatedData['installment_full_price'] ?? null,
            'no_year' => $noYear,
            'installment_monthly_price' => $validatedData['installment_monthly_price'] ?? null,
            'with_rebate' => $withRebateValue,
            'min_amount' => $validatedData['min_amount'] ?? null,
        ];

        // Update the PaymentSetting record using the instance
        $paymentsetting->update($sanitizedData);

        // Use session to store the success message
        session()->flash('success', 'Payment Updated Successfully');

        // Redirect back with the success message
        return redirect()->route('psetting');
    }

}
