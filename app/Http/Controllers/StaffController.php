<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    
    public function specificMunicipality($municipality)
    {
        // Retrieve attachments with 'Everyone' restriction and the specific municipality
        $files = Attachment::where('restrictions', 'Everyone')
            // Join with user profiles and filter by municipality
            ->whereHas('userProfile', function ($query) use ($municipality) {
                $query->where('municipality', $municipality);
            })
            ->orderBy('created_at', 'desc');

        // Pass the filtered attachments to the view
        return view('staff.staff_attachments', ['files' => $files->paginate(8)]);
    }
    public function attachments()
    {
        $userProfileId = auth()->user()->userProfile->id;
    
        $filesQuery = Attachment::where(function($query) use ($userProfileId) {
            $query->where('restrictions', 'Everyone')
                  ->orWhere(function($query) use ($userProfileId) {
                      $query->where('restrictions', 'Only_Me')
                            ->where('userprofile_id', $userProfileId);
                  });
        })->orderBy('created_at', 'desc');
    
        // Paginate the combined query
        $paginatedFiles = $filesQuery->paginate(8);
    
        // Return the view with the paginated files
        return view("staff.staff_attachments", ['files' => $paginatedFiles]);
    }
    

    public function municipality()
    {
        $municipality = auth()->user()->userProfile->municipality;
        $files = $this->getAttachments($municipality);
        return view("staff.staff_attachments", ['files' => $files->paginate(8)]);
    }

    public function onlyMe()
    {
        $files =  $this->getAttachments('Only_Me', auth()->user()->userProfile->id);
        return view("staff.staff_attachments", ['files' => $files->paginate(8)]);
    }

    public function createAttachment(){
        return view ('staff.staff_staffPostFile');
    }

    
    public function publicAttachments()
    {
        $files = $this->getAttachments('Public');
        return view("staff.staff_attachments", ['files' => $files->paginate(8)]);
    }



    private function getAttachments($restrictions, $userprofile_id = null)
    {
        // Initialize the query to order by creation date
        $filesQuery = Attachment::orderBy('created_at', 'desc');
    
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


    public function profile() {

        $user = auth()->user();

        $userProfile = $user->userProfile;

        return view("staff.staff_profile", [
            "user" => $user,
            "userProfile" => $userProfile
        ]);
    }

    public function edit(User $staff){
   
        if(auth()->id() !== $staff->userProfile->id){
            abort(404);
        }
        $editing = true;
        return view("staff.staff_profile", compact("staff", "editing"));
    }

    public function update(User $staff) {

        $profileId = $staff->userProfile->id;

        $validated = request()->validate([
            "name" => "required|min:5|max:40",
            "email" => "required|email|unique:userprofiles,email," . $profileId,
            "image" => "nullable|image"
        ]);
        

        if(request()->hasFile('image')){
            $imagePath = request()->file('image')->store('profiles', 'public');
            $validated['image'] = $imagePath;

            if ($staff->userProfile->profile){
            Storage::disk('public')->delete($staff->userProfile->profile);
            }
        }


        $staff->userProfile()->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'profile' => isset($validated['image']) ? $validated['image'] : $staff->userProfile->profile, 
        ]);
        
        return redirect()->route('staff.profile')->with('success','Profile update success!');
    }

    public function updatePasswordForm() {
        return view('staff.staff_updatePass');
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
        return redirect()->route('staff.profile')->with('success', 'Password successfully updated.');
    }

    public function goToRequest() {

        return view('staff.staff_request');
    }
    
}
