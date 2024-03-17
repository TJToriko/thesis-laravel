<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carousel;
use App\Models\Aboutus;
use App\Models\Policy;
use App\Models\Logo;
use App\Models\Services;
use Illuminate\Support\Facades\Validator;
use App\Models\paymenttracker;
use Carbon\Carbon;

class SystemSettingController extends Controller
{
    /**
     * Display the system setting page.
    */
    public function ViewSystemSetting()
    {
        $carousels = Carousel::orderBy('id', 'ASC')->get();
        $policys = Policy::orderBy('id', 'ASC')->get();
        $aboutus = Aboutus::orderBy('id', 'ASC')->first();
        $logo = Logo::orderBy('id', 'ASC')->first();
        $services = Services::orderBy('id', 'ASC')->get();


        return view('admin.system_setting.systemsetting', compact('carousels', 'aboutus', 'policys', 'logo', 'services'));
    }

    /**
     * Adding the carousel in database
     */
    public function AddCarousel(Request $request)
    {
        // Validate the form data
        $rules = [
            'carousel_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20048',
            'carousel_desc' => 'required|string',
            'carousel_header' => 'required|string',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        // Upload valid id image if provided
        if ($request->hasFile('carousel_image')) {
            $image = $request->file('carousel_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/carousel_images'), $imageName);
            $imagePath = $imageName;
        }

        // Create a new Carousel instance
        $carousel = new Carousel();
        $carousel->image = $imagePath;
        $carousel->description = $request->input('carousel_desc');
        $carousel->header = $request->input('carousel_header');
        
        // Save the carousel to the database
        $carousel->save();
            
        // Success message
        return redirect()->back()->with('success', 'Carousel added successfully!');
    }

    /**
     * Update the About us table in database
     */
    public function UpdateAboutus(Request $request, string $id)
    {
        $about = Aboutus::findOrFail($id);

        // Validate the form data
        $rules = [
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20048',
            'about_desc' => 'required|string',
            'header' => 'required|string',
            'description' => 'required|string',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        // Upload valid id image if provided
        if ($request->hasFile('about_image')) {
            $image = $request->file('about_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/aboutus_images'), $imageName);
            $about->about_us_image = $imageName;
        }

        // Update the about record with the new data
        $about->about_us_desc = $request->input('about_desc');
        $about->header = $request->input('header');
        $about->description = $request->input('description');
        $about->save();
            
        // Success message
        return redirect()->back()->with('success', 'About us Updated successfully!');
    }

    /**
     * Deletes the specified Carousel
    */
    public function DeleteCarousel(Request $request)
    {
        $carouselId = $request->input('carouselId');

        // Find the Lot Type record by ID
        $carousel = Carousel::findOrFail($carouselId);

        $carousel->delete();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }

    /* Fetch the specified Carousel */
    public function GetCarousel($id)
    {
        $carousel = Carousel::find($id);
        return response()->json($carousel);
    }

    public function UpdateCarousel(Request $request, string $id)
    {
        $carousel = Carousel::findOrFail($id);

        // Validate the form data
        $rules = [
            'carousel_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20048',
            'carousel_desc' => 'required|string',
            'carousel_header' => 'required|string',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        // Upload valid id image if provided
        if ($request->hasFile('carousel_image')) {
            $image = $request->file('carousel_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/carousel_images'), $imageName);
            $carousel->image = $imageName;
        }

        // Update the about record with the new data
        $carousel->description = $request->input('carousel_desc');
        $carousel->header = $request->input('carousel_header');
        $carousel->save();

        // Success message
        return redirect()->back()->with('success', 'Carousel Updated successfully!');
    }


    /**
     * Adding the policy in database
     */
    public function AddPolicy(Request $request)
    {
        // Validate the form data
        $rules = [
            'policy_name' => 'required|string',
            'policy_desc' => 'required|string',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        // Create a new policy instance
        $policy = new Policy();
        $policy->policy_name = $request->input('policy_name');
        $policy->policy_desc = $request->input('policy_desc');
        
        // Save the policy to the database
        $policy->save();
            
        // Success message
        return redirect()->back()->with('success', 'Policy added successfully!');
    }

    /**
     * Deletes the specified Policy
    */
    public function DeletePolicy(Request $request)
    {
        $policyId = $request->input('policyId');

        // Find the Lot Type record by ID
        $policy = Policy::findOrFail($policyId);

        $policy->delete();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }


    /**
     * Update the Logo table in database
     */
    public function UpdateLogo(Request $request, string $id)
    {
        $logo = Logo::findOrFail($id);

        // Validate the form data
        $rules = [
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20048',
            'logo_desc' => 'required|string',
            'logo_name' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        // Upload valid id image if provided
        if ($request->hasFile('logo_image')) {
            $image = $request->file('logo_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/logo_images'), $imageName);
            $logo->logo_image = $imageName;
        }

        // Update the about record with the new data
        $logo->logo_desc = $request->input('logo_desc');
        $logo->logo_name = $request->input('logo_name');
        $logo->email = $request->input('email');
        $logo->contact = $request->input('contact');
        $logo->save();
            
        // Success message
        return redirect()->back()->with('success', 'Logo & Descriptions Updated successfully!');
    }

    /**
     * Adding the Service in database
     */
    public function AddService(Request $request)
    {
        // Validate the form data
        $rules = [
            'service_name' => 'required|string',
            'service_desc' => 'required|string',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        // Create a new service instance
        $service = new Services();
        $service->service_name = $request->input('service_name');
        $service->service_desc = $request->input('service_desc');
        
        // Save the policy to the database
        $service->save();
            
        // Success message
        return redirect()->back()->with('success', 'Service added successfully!');
    }

    /**
     * Deletes the specified Service
    */
    public function DeleteService(Request $request)
    {
        $serviceId = $request->input('serviceId');

        // Find the service record by ID
        $service = Services::findOrFail($serviceId);

        $service->delete();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }

    /* Fetch the specified Policy */
    public function GetPolicy($id)
    {
        $policy = Policy::find($id);
        return response()->json($policy);
    }

    public function UpdatePolicy(Request $request, string $id)
    {
        $policy = Policy::findOrFail($id);

        // Validate the form data
        $rules = [
            'policy_desc' => 'required|string',
            'policy_name' => 'required|string',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        // Update the about record with the new data
        $policy->policy_name = $request->input('policy_name');
        $policy->policy_desc = $request->input('policy_desc');
        $policy->save();

        // Success message
        return redirect()->back()->with('success', 'Policy Updated successfully!');
    }

    /* Fetch the specified Service */
    public function GetService($id)
    {
        $service = Services::find($id);
        return response()->json($service);
    }

    public function UpdateService(Request $request, string $id)
    {
        $service = Services::findOrFail($id);

        // Validate the form data
        $rules = [
            'service_desc' => 'required|string',
            'service_name' => 'required|string',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        // Update the about record with the new data
        $service->service_name = $request->input('service_name');
        $service->service_desc = $request->input('service_desc');
        $service->save();

        // Success message
        return redirect()->back()->with('success', 'Service Updated successfully!');
    }

}
