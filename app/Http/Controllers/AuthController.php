<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Notifications\WelcomeMailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //

    public function register(){
        return view ("shared.signin");
    }

    public function login(){
        return view ("shared.login");
    }
    public function store() {

        $requiredFields = ['lastname', 'firstname', 'email', 'username', 'password', 'municipality', 'profile_picture'];
    
        foreach ($requiredFields as $field) {
            if (empty(request($field))) {
                return back()->withErrors(['general' => 'All fields must be filled up.'])->withInput();
            }
        }
        
        $validated = request()->validate([
            "lastname" => "required|string|max:40",
            "firstname" => "required|string|max:40",
            "middlename" => "nullable|string|max:40",
            "email" => "required|email",
            "username" => "required|max:40",
            "password" => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/', // must contain at least one lowercase letter
                'regex:/[A-Z]/', // must contain at least one uppercase letter
                'regex:/[0-9]/', // must contain at least one number
                'regex:/[@$!%*?&#]/' // must contain a special character
            ],
            "municipality" => "required|string",
            "profile_picture" => "required|image|mimes:jpeg,png,jpg" // Optional field with validation for image file
        ], [
            'password.regex' => 'Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.'
        ]);

        // Check if email already exists in users table
            if (UserProfile::where('email', $validated['email'])->exists() && User::where('username', $validated['username'])->exists()) {
                return redirect()->back()->with('failed', 'This user already has an account.');
            }

    
        // Concatenate lastname, firstname, and middlename into name
        $name = $validated["lastname"] . ', ' . $validated["firstname"];
        if (!empty($validated["middlename"])) {
            $name .= ' ' . $validated["middlename"];
        }
    
        // Handle profile picture upload
        $profilePicturePath = null;
        if (request()->hasFile('profile_picture')) {
            $profilePicture = request()->file('profile_picture');
            $profilePicturePath = $profilePicture->store('profiles', 'public'); 
        }
    
        // Create the user profile
        $userProfile = UserProfile::create([
            "name" => $name,
            "email" => $validated["email"],
            "municipality" => $validated["municipality"],
            "profile" => $profilePicturePath // Add the path to the profile picture
        ]);
    
        // Create the user and associate it with the user profile
        User::create([
            "username" => $validated["username"],
            "password" => Hash::make($validated["password"]),
            "userprofile_id" => $userProfile->id 
        ]);
    
        session()->put('email', $validated['email']);
    
        // Send email notification
        $message = "Thanks for Signing up! Your Account is still for approval. We will contact you once your account is approved and ready to use.";
        Mail::to($validated["email"])->send(new WelcomeEmail(
            $message, 
            $name, // Use concatenated name here
            $validated["username"], 
            $validated["email"], 
            $validated["municipality"]
        ));
    
        return redirect()->route("confirmation");
    }
    
    

    public function authenticate(){
        
        $validated = request()->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'required' => 'All fields must be filled up', // Custom message for required fields
        ]);

         if (auth()->attempt($validated)){
        
            // $user = auth()->user()->load('userProfile');
            // dd($user, $user->userProfile); 
            $user = auth()->user();
            if ($user->userProfile->isPending == 'pending'){

                return redirect()->route("login")->with('failed', 'Your account is still for approval.');
            }else if ($user->userProfile->user_status == 'disabled'){
                
                return redirect()->route("login")->with('failed', 'Your account is disabled.');
            }else {

                request()->session()->regenerate();

                if ($user->userProfile->user_type === 'superadmin') {
                         
                    return redirect()->route('sa.admins');
                } elseif ($user->userProfile->user_type === 'admin') {
                 
                    if (auth()->user()->userProfile->municipality === 'pdrrmo'){
                        return redirect()->route('admin.users');
                    }else {
                        return redirect()->route('admin.staff');
                    }
        
                } elseif ($user->userProfile->user_type === 'staff') {
                    return redirect()->route('staff.attachments');
                }
            }

        }else {
                    // Check if the username exists in the database
                $usernameExists = User::where('username', request('username'))->exists();

                if ($usernameExists) {
                    // If username exists but password is wrong
                    return redirect()->route("login")->withErrors([
                        "password" => "Incorrect password. Please try again."
                    ])->withInput(request()->only('username'));
                } else {
                    // If username doesn't exist
                    return redirect()->route("login")->withErrors([
                        "username" => "Invalid login credentials. Please try again."
                    ]);
                }
        }
        
    }

    public function logout(){
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        
        return redirect()->route("login")->with("success","Logout Successfully");
    }


    public function destroy(User $user) {
        
        $user->userProfile()->delete();
        $user->delete();

        if (auth()->user()->userProfile->user_type === 'superadmin'){
            return redirect()->route('sa.staff')->with('success','User deleted successfully!');
        }else{
            if (auth()->user()->userProfile->municipality === 'pdrrmo') {
                return redirect()->route('admin.admin')->with('success','User deleted successfully!');
            }else {
                return redirect()->route('admin.staff')->with('success','User deleted successfully!');
            }
        }

    }

    public function confirmation() {
        return view('shared.confirmation');
    }

    public function goToForgotPassword() {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return view('shared.forgot-password');
    }
    
}
