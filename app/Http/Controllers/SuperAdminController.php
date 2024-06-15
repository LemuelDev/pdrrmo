<?php

namespace App\Http\Controllers;

use App\Mail\ApproveEmail;
use App\Models\Attachment;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SuperAdminController extends Controller
{
    public function index() {
        $adminQuery = UserProfile::orderBy('created_at', 'asc')
        ->where('isPending', '!=', 'pending')
        ->where('user_status', 'active')
        ->where('user_type', 'admin');
        

        if (request()->has('search')) {
            $searchQuery = request()->get('search');
            $adminQuery->where('name', 'like', '%' . $searchQuery . '%');
        }

        $admins = $adminQuery;

        return view("superadmin.sa_admins", [
            "admins" => $admins->paginate(8)
        ]);
        
    }

    public function specificMunicipality($municipality)
    {
        // Retrieve attachments with 'Everyone' restriction and the specific municipality
        $files = Attachment::where('restrictions', 'Everyone')
            // Join with user profiles and filter by municipality
            ->whereHas('userProfile', function ($query) use ($municipality) {
                $query->where('municipality', $municipality);
            })
            ->orderBy('created_at', 'asc');

        // Pass the filtered attachments to the view
        return view('superadmin.sa_attachments', ['files' => $files->paginate(8)]);
    }

    public function attachments()
    {
        $userProfileId = auth()->user()->userProfile->id;
    
        // Query for attachments with 'Everyone' restriction
        $filesQuery = $this->getAttachments(['Everyone']);
    
        // Query for attachments with 'Only_Me' restriction for the current user
        $userFilesQuery = $this->getAttachments(['Only_Me'], $userProfileId);
    
        // Combine the two queries using the union() method
        $combinedQuery = $filesQuery->union($userFilesQuery);
    
        // Paginate the combined query
        $paginatedFiles = $combinedQuery->paginate(8);
    
        // Return the view with the paginated files
        return view("superadmin.sa_attachments", ['files' => $paginatedFiles]);
    }
    

    public function municipality()
    {
        $municipality = auth()->user()->userProfile->municipality;
        $files = $this->getAttachments($municipality);
        return view("superadmin.sa_attachments", ['files' => $files->paginate(8)]);
    }

    public function onlyMe()
    {
        $files =  $this->getAttachments('Only_Me', auth()->user()->userProfile->id);
        return view("superadmin.sa_attachments", ['files' => $files->paginate(8)]);
    }

    public function publicAttachments()
    {
        $files = $this->getAttachments('Public');
        return view("superadmin.sa_attachments", ['files' => $files->paginate(8)]);
    }

    public function createAttachment(){
        return view ('superadmin.sa_saPostFile');
    }


    private function getAttachments($restrictions, $userprofile_id = null)
    {
        // Initialize the query to order by creation date
        $filesQuery = Attachment::orderBy('created_at', 'asc');
    
        // Handle the restrictions provided as a single string or an array
        if (is_array($restrictions)) {
            $filesQuery->whereIn('restrictions', $restrictions);
            // If 'Only_Me' restriction is specified, filter by user profile ID if provided
            if (in_array('Only_Me', $restrictions) && $userprofile_id !== null) {
                $filesQuery->where('userprofile_id', $userprofile_id);
            }
        } else {
            // For a single restriction, apply it to the query
            $filesQuery->where('restrictions', $restrictions);
        }
    
        // Apply user profile ID filter if provided
        if ($userprofile_id !== null) {
            $filesQuery->where('userprofile_id', $userprofile_id);
            
        }
    
        // Apply search filter if a search query is present in the request
        if (request()->has('search')) {
            $searchQuery = request()->get('search');
            $filesQuery->where('filename', 'like', '%' . $searchQuery . '%');
        }
    
        // Execute the query and return the collection of attachments
        return $filesQuery;
    }
    public function staff() {

        $staffsQuery = UserProfile::orderBy('created_at', 'asc')
        ->where('isPending', '!=', 'pending')
        ->where('user_type', 'staff');

        if (request()->has('search')) {
            $searchQuery = request()->get('search');
            $staffsQuery->where('name', 'like', '%' . $searchQuery . '%');
        }

        $staffs = $staffsQuery;

        return view("superadmin.sa_staff", [
            "staffs" => $staffs->paginate(8)
        ]);
       
    }



    public function profile() {
        return view("superadmin.sa_profile");
    }

    

    public function approval() {
        $staffs = UserProfile::orderBy('created_at', 'asc')
        ->where(function ($query) {
            $query->where('isPending', 'pending')
                ->orWhere('user_status', 'inactive');
        });
        return view("superadmin.sa_approval", [
            "staffs" => $staffs->paginate(8)
        ]);
        
    }

      
    public function edit(User $sa){

        if(auth()->id() !== $sa->userProfile->id){
            abort(404);
        }
        $editing = true;
        return view("superadmin.sa_profile", compact("sa", "editing"));
    }
    
    public function approve(User $user) {

        $user->userProfile()->update([
            "isPending" => 'approved',
            "user_status" => 'active'
        ]);
        $message = "Your account is finally approved and active. You can now login to the portal and use the system as of now.";
        Mail::to($user->userProfile->email)->send(new ApproveEmail($message));
        return redirect()->route('sa.approval')->with('success', 'User is now finally approve.');
    }

    public function editStaff(User $staff){
        
        return view("superadmin.sa_updateCard", [
            "staff" => $staff,
            
        ]);
    }

    public function updateStaff(User $staff) {

        $validated = request()->validate([
            // "email" => 'required',
            "user_type" => 'required',
            "user_status" => 'required',
            "isPending" => 'required',
            'municipality'=> 'required',
        ]);
        

        $staff->userProfile()->update([
            'user_type'=> $validated['user_type'],
            'user_status'=> $validated['user_status'],
            'isPending'=> $validated['isPending'],
            'municipality'=> $validated['municipality'],
            
        ]);
        
        return redirect()->route('sa.staff')->with('success',' Updated Successfully!');
    }

    public function editAdmin(User $admin){
        
        return view("superadmin.sa_updateAdmin", [
            "admin" => $admin,
            
        ]);
    }

    public function updateAdmin(User $admin) {

        $validated = request()->validate([
            // "email" => 'required',
            "user_type" => 'required',
            "user_status" => 'required',
            "isPending" => 'required',
            'municipality'=> 'required',
        ]);
        

        $admin->userProfile()->update([
            'user_type'=> $validated['user_type'],
            'user_status'=> $validated['user_status'],
            'isPending'=> $validated['isPending'],
            'municipality'=> $validated['municipality'],
            
        ]);
        
        return redirect()->route('sa.admins')->with('success',' Updated Successfully!');
    }

    public function update(User $sa) {

        $profileId = $sa->userProfile->id;

        $validated = request()->validate([
            "name" => "required|min:5|max:40",
            "email" => "required|email|unique:userprofiles,email," . $profileId,
            "username" => "required|min:5|max:40",
            "municipality" => "required",
            "image" => "nullable|image"
        ]);
        
        if(request()->hasFile('image')){
            $imagePath = request()->file('image')->store('profiles', 'public');
            $validated['image'] = $imagePath;

            if ($sa->userProfile->profile){
            Storage::disk('public')->delete($sa->userProfile->profile);
            }
        }

        $sa->update([
            'username' => $validated['username'],
        ]);

        $sa->userProfile()->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'municipality' => $validated['municipality'],
            'profile' => isset($validated['image']) ? $validated['image'] : $sa->userProfile->profile, 
        ]);
        
        return redirect()->route('sa.profile')->with('success','Profile update success!');
    }

    public function specificStaff($municipality) {
        
        $staffs = UserProfile::where('municipality', $municipality)->where('user_type', 'staff');
        return view("superadmin.sa_staff", [
            "staffs" => $staffs->paginate(8)
        ]);
    }

    public function specificAdmin($municipality) {
        
        $staffs = UserProfile::where('municipality', $municipality)->where('user_type', 'admin');
        return view("superadmin.sa_admins", [
            "admins" => $staffs->paginate(8)
        ]);
    }

    public function updatePasswordForm() {
        return view('superadmin.sa_updatePass');
    }

    public function updatePassword(User $user) {
        // Validate the request inputs
        $validated = request()->validate([
            "old_password" => "required|min:8",
            "new_password" => "required|min:8|confirmed" // Ensure new password is confirmed
        ]);
        
        // Check if the old password matches the current password
        if (!Hash::check($validated["old_password"], $user->password)) {
            // Redirect back with an error if the current password does not match
            return redirect()->back()->with('failed', "Your current password is incorrect.");
        };
        
        // Update the user's password
        $user->update([
            "password" => Hash::make($validated["new_password"])
        ]);

        $user->save();
    
        // Redirect back with a success message
        return redirect()->route('sa.profile')->with('success', 'Password successfully updated.');
    }
}