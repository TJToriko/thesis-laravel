<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lot;
use App\Models\deceased;
use App\Models\deceasedbone;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\paymenttracker;
use Carbon\Carbon;
use App\Models\Maxdeceasedqty;

class DeceasedController extends Controller
{
    /**
     * Display the lots page.
    */
    public function ViewDeceased()
    {
        $deceased = deceased::with(['lot'])->get();
        $deceasedbone = deceasedbone::with(['deceased'])->get();
        $deceasedqty = Maxdeceasedqty::first();

        return view('admin.deceased', compact('deceased', 'deceasedbone', 'deceasedqty'));
    }

    /**
     * Display the add deceased page.
    */
    public function ViewAddDeceased()
    {
        $lots = Payment::where('status', '=', 'Fully Paid')
        ->orderBy('lot_id', 'asc')
        ->get();

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

        return view('admin.deceased_crud.adddeceased', compact('lots', 'totalCount'));
    }
    
    public function ViewAddBone()
    {
        $lots = Payment::where('status', '=', 'Fully Paid')
        ->orderBy('lot_id', 'asc')
        ->get();

        return view('admin.deceased_crud.addbone', compact('lots'));
    }

    public function getIntered($lotId)
    {
        $lot = Lot::where('id', $lotId)->first();
        $Intered = deceased::where('lot_id', $lotId)
        ->get();
    
        if ($Intered) {
            // Create an associative array to include both payment tracker and due dates
            $data = [
                'Intered' => $Intered,
                'section' => $lot->section,
                'lotNumber' => $lot->lot_no,
                'lotType' => $lot->lotType->lot_type_name,
                'lotTypeId' => $lot->lot_type_id,
                'lotClass' => $lot->lotClass->lot_class_name,
                'lotClassId' => $lot->lot_class_id,
                'lotId' => $lot->id,
            ];
    
            // Return the array as a JSON response
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Payment details not found'], 404);
        }
    }

    /* code for creating deceased and then show toast */
    public function addDeceased(Request $request)
    {

        // Validation Rules for deceased information
        $rules = [
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'suffix' => 'nullable|string',
            'certificate_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20048',
            'born' => 'required|date',
            'died' => 'required|date',
            'sex' => 'required|in:Male,Female',
            'age' => 'required|integer',
            'lot_id' => 'required|integer',
        ];
    
        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $deceasedCount = deceased::where('lot_id', $request->lot_id)
            ->count();
        $maxdeceased = Maxdeceasedqty::first();
        
        if ($deceasedCount ==  $maxdeceased->max_quantity_deceased) {

            $notification = ['message' => 'Lot reached Max Capacity!', 'alert-type' => 'error'];
            return redirect()->back()->with($notification)->withInput();
        }
        
        // Process and store deceased information
        $deceasedData = $request->only([
            'first_name',
            'middle_name',
            'last_name',
            'suffix',
            'born',
            'died',
            'sex',
            'age',
            'lot_id',
        ]);
    
        // Upload certificate image if provided
        if ($request->hasFile('certificate_image')) {
            $image = $request->file('certificate_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/certificate_images'), $imageName);
            $deceasedData['certificate_image'] = $imageName;
        }
    
        // Store deceased information
        $deceased = deceased::create($deceasedData);
    
        // check the checkbox if it is checked
        if ($request->has('withbone')) {
            // get bone data if the checkbox is checked
            if ($request->has('bone_first_name')) {
                foreach ($request->input('bone_first_name') as $key => $value) {
                    $boneData = [
                        'first_name' => $request->input("bone_first_name.$key"),
                        'middle_name' => $request->input("bone_middle_name.$key"),
                        'last_name' => $request->input("bone_last_name.$key"),
                        'suffix' => $request->input("bone_suffix.$key"),
                        'born' => $request->input("bone_born.$key"),
                        'died' => $request->input("bone_died.$key"),
                        'sex' => $request->input("bone_sex.$key"),
                        'age' => $request->input("bone_age.$key"),
                        'deceased_id' => $deceased->id, // Associate the bone with the deceased using its ID
                    ];
                    // Create DeceasedBone record
                    deceasedbone::create($boneData);
                }
            }
        }

        // Update lot status to 'Intered'
        $lotId = $request->input('lot_id');
        $lot = Lot::find($lotId);

        if ($lot) {
            $lot->lot_status = 'Intered';
            $lot->save();
        }

        $notification = ['message' => 'Deceased Added Successfully!', 'alert-type' => 'success'];
        return redirect()->route('deceased')->with($notification);
    }

    public function addBone(Request $request)
    {
        /* dd($request->all()); */
        // Validation Rules for deceased information
        $rules = [
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'suffix' => 'nullable|string',
            'born' => 'required|date',
            'died' => 'required|date',
            'sex' => 'required|in:Male,Female',
            'age' => 'required|integer',
            'deceased_id' => 'required|integer',
        ];
    
        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $boneCount = deceasedbone::where('deceased_id', $request->deceased_id)
            ->count();

        $maxbone = Maxdeceasedqty::first();

        if ($boneCount == $maxbone->max_quantity_bones) {

            $notification = ['message' => 'Lot reached Max Bone Capacity!', 'alert-type' => 'error'];
            return redirect()->back()->with($notification)->withInput();
        }
        
        // Process and store deceased information
        $deceasedData = $request->only([
            'first_name',
            'middle_name',
            'last_name',
            'suffix',
            'born',
            'died',
            'sex',
            'age',
            'deceased_id',
        ]);
        /* dd($deceasedData); */
        // Store deceased information
        deceasedbone::create($deceasedData);

        $notification = ['message' => 'Bones Added Successfully!', 'alert-type' => 'success'];
        return redirect()->route('deceased')->with($notification);
    }

    /**
     * Deletes the specified Deceased
    */
    public function DeleteDeceased(Request $request)
    {
        $deceasedId = $request->input('deceasedId');

        // Find the Lot Type record by ID
        $deceased = deceased::findOrFail($deceasedId);

        $deceased->delete();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }

    /**
     * Deletes the specified Deceased Bone
    */
    public function DeleteDeceasedBone(Request $request)
    {
        $deceasedboneId = $request->input('deceasedboneId');

        // Find the Lot Type record by ID
        $deceasedbone = deceasedbone::findOrFail($deceasedboneId);

        $deceasedbone->delete();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }

    /**
     * Display the payment setting page.
    */
    public function ViewEditDeceased(string $id)
    {
        $deceased = deceased::with(['lot','bones'])->findOrFail($id);
        $deceasedbone = deceasedbone::with(['deceased'])->get();
        $lots = Lot::orderBy('created_at', 'asc')->get();

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

        return view('admin.deceased_crud.editdeceased', compact('deceased','deceasedbone','lots', 'totalCount'));
    }

    /* code for Editing deceased and then show toast */
    public function UpdateDeceased(Request $request, string $id)
    {

        $deceased = deceased::findOrFail($id);
        
        // Validation Rules for deceased information
        $rules = [
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'suffix' => 'nullable|string',
            'certificate_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:20048',
            'born' => 'required|date',
            'died' => 'required|date',
            'sex' => 'required|in:Male,Female',
            'age' => 'required|integer',
            'lot_id' => 'required|integer',
        ];
    
        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Process and store deceased information
        $deceasedData = $request->only([
            'first_name',
            'middle_name',
            'last_name',
            'suffix',
            'born',
            'died',
            'sex',
            'age',
            'lot_id',
        ]);
    
        // Upload certificate image if provided
        if ($request->hasFile('certificate_image')) {
            $image = $request->file('certificate_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/certificate_images'), $imageName);
            $deceasedData['certificate_image'] = $imageName;
        }
    
        // Store deceased information using the retrieved instance
        $deceased->update($deceasedData);
    
        // Check the checkbox for additional bones
        if ($request->has('withbone')) {
            // Update existing bones if provided
            if ($request->has('bone_ids')) {
                foreach ($request->input('bone_ids') as $key => $boneId) {
                    $bone = deceasedbone::findOrFail($boneId);

                    $boneData = [
                        'first_name' => $request->input("bone_first_name.$key"),
                        'middle_name' => $request->input("bone_middle_name.$key"),
                        'last_name' => $request->input("bone_last_name.$key"),
                        'suffix' => $request->input("bone_suffix.$key"),
                        'born' => $request->input("bone_born.$key"),
                        'died' => $request->input("bone_died.$key"),
                        'sex' => $request->input("bone_sex.$key"),
                        'age' => $request->input("bone_age.$key"),
                    ];

                    // Update the existing bone record
                    $bone->update($boneData);
                }
            }

            // Create new bones if provided
            if ($request->has('new_bone_first_name')) {
                foreach ($request->input('new_bone_first_name') as $key => $value) {
                    $newBoneData = [
                        'first_name' => $request->input("new_bone_first_name.$key"),
                        'middle_name' => $request->input("new_bone_middle_name.$key"),
                        'last_name' => $request->input("new_bone_last_name.$key"),
                        'suffix' => $request->input("new_bone_suffix.$key"),
                        'born' => $request->input("new_bone_born.$key"),
                        'died' => $request->input("new_bone_died.$key"),
                        'sex' => $request->input("new_bone_sex.$key"),
                        'age' => $request->input("new_bone_age.$key"),
                        'deceased_id' => $deceased->id,
                    ];

                    // Create the new bone record
                    deceasedbone::create($newBoneData);
                }
            }
        }

        // Use session to store the success message
        session()->flash('success', 'Deceased Updated Successfully');
    
        // Redirect with success message
        return redirect()->route('deceased');
    }

    public function updateDeceasedQuantity(Request $request)
    {

        // Finding the Coupon model instance by ID
        $maxdeceasedqty = Maxdeceasedqty::first();

        // Inserting into the database
        $maxdeceasedqty->update([
            'max_quantity_deceased' => $request->fresh_body_qty,
        ]);

        $notification=array('message' => 'Updated Successfully!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function updateBoneQuantity(Request $request)
    {

        // Finding the Coupon model instance by ID
        $maxdeceasedqty = Maxdeceasedqty::first();

        // Inserting into the database
        $maxdeceasedqty->update([
            'max_quantity_bones' => $request->bone_qty,
        ]);

        $notification=array('message' => 'Updated Successfully!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
