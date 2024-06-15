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
    public function store (){

        $validated = request()->validate([
            "name" => "required|min:5|max:40|unique:userprofiles,name",
            "email"=> "required|email|unique:userprofiles,email",
            "username" => "required|min:5|max:40|unique:users,username",
            "password" => "required|min:8",
            "municipality" => "required"
        ]);
    
        // Create the user profile
        $userProfile = UserProfile::create([
            "name"=> $validated["name"],
            "email"=> $validated["email"],
            "municipality" => $validated["municipality"],
        ]);
    
        // Create the user and associate it with the user profile
         User::create([
            "username" => $validated["username"],
            "password"=> Hash::make($validated["password"]),
            "userprofile_id" => $userProfile->id 
        ]);
        
        session()->put('email', $validated['email']);
        
        // Send email notification
        $message = "Thanks for Signing up! Your Account is still for approval. We will contact you once your account is approved and ready to use.";
        Mail::to($validated["email"])->send(new WelcomeEmail($message, $validated["name"], $validated["username"], $validated["email"], $validated["municipality"]));


        return redirect()->route("confirmation");

    }
    

    public function authenticate(){
        
        $validated = request()->validate([
            "username" => "required|min:5|max:40",
            "password" => "required|min:8"
         ]);


         if (auth()->attempt($validated)){
        
            // $user = auth()->user()->load('userProfile');
            // dd($user, $user->userProfile); 
            $user = auth()->user();
            if ($user->userProfile->isPending == 'pending'){

                return redirect()->route("login")->with('failed', 'Your account is still for approval.');
            }else if ($user->userProfile->user_status == 'inactive'){
                
                return redirect()->route("login")->with('failed', 'Your account is inactive.');
            }else {

                request()->session()->regenerate();

                if ($user->userProfile->user_type === 'superadmin') {
                         
                    return redirect()->route('sa.admins');
                } elseif ($user->userProfile->user_type === 'admin') {
                 
                    if (auth()->user()->userProfile->municipality === 'pdrrmo'){
                        return redirect()->route('admin.admin');
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
    
}
