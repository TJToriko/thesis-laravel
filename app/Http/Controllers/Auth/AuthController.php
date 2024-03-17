<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\refcitymun;
use App\Models\refbrgy;
use App\Models\refprovince;
use App\Models\registrationnotification;
use Pusher\Pusher;

class AuthController extends Controller
{
    /* display login page */
    public function ViewLogin()
    {
        return view('auth/login');
    }

    /* display Sign Up page */
    public function ViewSignup()
    {
        $province = refprovince::orderBy('provDesc', 'asc')->get();
        $city = refcitymun::orderBy('citymunDesc', 'asc')->get();
        $barangay = refbrgy::orderBy('brgyDesc', 'asc')->get();

        return view('auth.signup', compact('province','city','barangay'));
    }

    /* display login page */
    public function ViewEmailSuccess()
    {
        return view('auth/success');
    }

    /* proccess user login information */
    public function loginAction(Request $request)
    {
        // Sanitize input
        $username = strip_tags($request->input('username'));
        $password = strip_tags($request->input('password'));
    
        // Validation
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
    
        // Attempt login
        if (!Auth::attempt(['username' => $username, 'password' => $password], $request->boolean('remember'))) {
            return redirect()->route('login')->withErrors(['Invalid username/password.']);
        }
    
        $user = Auth::user();
    
        if ($user->role == 'customer') {
            // Check if the email is verified
            if ($user->status == 'approved') {
                return redirect()->route('index');
            } else {
                return redirect()->route('login')->withErrors(['Please wait till account is accepted.']);
            }
        } elseif ($user->role == 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role == 'collector') {
            return redirect()->route('dashboard');
        }
    }

    /* creation of user CUSTOMER */
    public function CreateCustomer(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'suffix' => 'nullable|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'barangay' => 'required|string',
            'street' => 'required|string',
            'landmark' => 'nullable|string',
            'place_of_birth' => 'required|string',
            'date_of_birth' => 'required|date',
            'occupation' => 'required|string',
            'contact_number' => 'required|digits:11',
            'valid_id' => 'required|image|mimes:jpeg,png,jpg|max:20048',
            'email' => 'required|email|unique:users',
            'sex' => 'required|string|in:Male,Female',
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
            'terms_and_conditions' => 'required|accepted',
        ]);

        // Upload valid ID image if provided
        if ($request->hasFile('valid_id')) {
            $image = $request->file('valid_id');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/customer_valid_id'), $imageName);
            $validIdPath = $imageName;
        }

        // Create a new user instance
        $save = new User();
        
        // Assign values from the request to the user model
        $save->first_name = $request->input('first_name');
        $save->middle_name = $request->input('middle_name');
        $save->last_name = $request->input('last_name');
        $save->suffix = $request->input('suffix');
        $save->province = $request->input('province');
        $save->city = $request->input('city');
        $save->barangay = $request->input('barangay');
        $save->street = $request->input('street');
        $save->landmark = $request->input('landmark');
        $save->place_of_birth = $request->input('place_of_birth');
        $save->date_of_birth = $request->input('date_of_birth');
        $save->occupation = $request->input('occupation');
        $save->contact_number = $request->input('contact_number');
        $save->valid_id = $validIdPath;
        $save->email = $request->input('email');
        $save->sex = $request->input('sex');
        $save->role = 'customer';
        $save->status = 'pending';
        $save->username = $request->input('username');
        $save->password = bcrypt($request->input('password'));

        $save->save();

        // Redirect or return a response as needed
        return redirect()->route('signup.success')->with('success', 'Registration have been sent successfully!');
    }

    /* logouts user account */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
    
        $request->session()->invalidate();
    
        return redirect('login');
    }
}
