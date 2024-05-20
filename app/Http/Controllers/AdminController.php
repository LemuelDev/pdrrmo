<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    
    public function specificMunicipality($municipality = null)
    {
   
        // Retrieve attachments with 'Everyone' restriction and the specific municipality
        $files = Attachment::where('restrictions', 'Everyone')
            // Join with user profiles and filter by municipality
            ->whereHas('userProfile', function ($query) use ($municipality) {
                $query->where('municipality', $municipality);
            })
            ->orderBy('created_at', 'asc');

        // Pass the filtered attachments to the view
        return view('admin.adminAttachments', ['files' => $files->paginate(8)]);
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
        return view("admin.adminAttachments", ['files' => $paginatedFiles]);
    }
    

    public function municipality()
    {
        $municipality = auth()->user()->userProfile->municipality;
        $files = $this->getAttachments($municipality);
        return view("admin.adminAttachments", ['files' => $files->paginate(8)]);
    }



    public function index() {

        if (auth()->user()->userProfile->municipality === 'pdrrmo' && auth()->user()->userProfile->user_type === 'admin' ) {
            
            $staffsQuery = UserProfile::orderBy('created_at', 'asc')
            ->where('isPending', '!=', 'pending')
            ->where('user_status', '!=', 'inactive')
            ->where('user_type', 'staff');

            if (request()->has('search')) { 
                $searchQuery = request()->get('search');
                $staffsQuery->where('name', 'like', '%' . $searchQuery . '%');
            }
    
            $staffs = $staffsQuery;
    
            return view("admin.adminStaff", [
                "staffs" => $staffs->paginate(8)
            ]);

        }

        $staffsQuery = UserProfile::orderBy('created_at', 'asc')
        ->where('isPending', '!=', 'pending')
        ->where('user_status', '!=', 'inactive')
        ->where('user_type', 'staff')
        ->where('municipality' , auth()->user()->userProfile->municipality);

        if (request()->has('search')) { 
            $searchQuery = request()->get('search');
            $staffsQuery->where('name', 'like', '%' . $searchQuery . '%');
        }

        $staffs = $staffsQuery;

        return view("admin.adminStaff", [
            "staffs" => $staffs->paginate(8)
        ]);
    }

    public function specificStaff($municipality) {
        
        $staffs = UserProfile::where('municipality', $municipality)->where('user_type', 'staff');
        return view("admin.adminStaff", [
            "staffs" => $staffs->paginate(8)
        ]);
    }

    
    public function admin() {

        if (auth()->user()->userProfile->municipality === 'pdrrmo' && auth()->user()->userProfile->user_type === 'admin' ) {
            $adminQuery = UserProfile::orderBy('created_at', 'asc')
                    ->where('isPending', '!=', 'pending')
                    ->where('user_status', 'active')
                    ->where('user_type', 'admin')
                    ->where('id', '!=', auth()->user()->userProfile->id );
                    

                    if (request()->has('search')) {
                        $searchQuery = request()->get('search');
                        $adminQuery->where('name', 'like', '%' . $searchQuery . '%');
                    }

                    $admins = $adminQuery;

                    return view("admin.adminAdmins", [
                        "admins" => $admins->paginate(8)
                    ]);
        }
        
        $adminQuery = UserProfile::orderBy('created_at', 'asc')
                    ->where('isPending', '!=', 'pending')
                    ->where('user_status', 'active')
                    ->where('user_type', 'admin')
                    ->where('municipality', auth()->user()->userProfile->municipality);

                    if (request()->has('search')) {
                        $searchQuery = request()->get('search');
                        $adminQuery->where('name', 'like', '%' . $searchQuery . '%');
                    }

                    $admins = $adminQuery;

                    return view("admin.adminAdmins", [
                        "admins" => $admins->paginate(8)
                    ]);
    }

    
    public function editAdmin(User $admin){
        
        return view("admin.adminUpdateAdmin", [
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
        
        return redirect()->route('admin.admin')->with('success',' Updated Successfully!');
    }
    

    public function specificAdmin($municipality) {
        
        $staffs = UserProfile::where('municipality', $municipality)->where('user_type', 'admin');
        return view("admin.adminAdmins", [
            "admins" => $staffs->paginate(8)
        ]);
    }
    
    public function publicAttachments()
    {
        $files = $this->getAttachments('Public');
        return view("admin.adminAttachments", ['files' => $files->paginate(8)]);
    }


    public function createAttachment(){
        return view ('admin.adminPostFile');
    }

    public function onlyme()
    {
        $files =  $this->getAttachments('Only_Me', auth()->user()->userProfile->id);
        return view("admin.adminAttachments", ['files' => $files->paginate(8)]);
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
    
    public function profile() {
        return view("admin.adminProfile");
    }
    public function approval() {

        if(auth()->user()->userProfile->municipality === 'pdrrmo'){
            $staffs = UserProfile::orderBy('created_at', 'asc')
            ->where(function ($query) {
                $query->where('isPending', 'pending')
                    ->orWhere('user_status', 'inactive');
            });
    
    
            return view("admin.adminApproval", [
                "staffs" => $staffs->paginate(8)
            ]);
        }

        $staffs = UserProfile::orderBy('created_at', 'asc')
        ->where('user_type', 'staff')
        ->where('municipality', auth()->user()->userProfile->municipality)
        ->where(function ($query) {
            $query->where('isPending', 'pending')
                ->orWhere('user_status', 'inactive');
        });


        return view("admin.adminApproval", [
            "staffs" => $staffs->paginate(8)
        ]);
    }
    
    
    public function edit(User $admin){

        if(auth()->id() !== $admin->userProfile->id){
            abort(404);
        }
        $editing = true;
        return view("admin.adminProfile", compact("admin", "editing"));
    }

    public function update(User $admin) {

        $profileId = $admin->userProfile->id;

        $validated = request()->validate([
            "name" => "required|min:5|max:40",
            "email" => "required|email|unique:userprofiles,email," . $profileId,
            "image" => "nullable|image"
        ]);
        

        if(request()->hasFile('image')){
            $imagePath = request()->file('image')->store('profiles', 'public');
            $validated['image'] = $imagePath;
            
            if ($admin->userProfile->profile){
            Storage::disk('public')->delete($admin->userProfile->profile);
            }
        }


        $admin->userProfile()->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'profile' => isset($validated['image']) ? $validated['image'] : $admin->userProfile->profile, 
        ]);
        
        return redirect()->route('admin.profile')->with('success','Profile update success!');
    }

    
    public function editStaff(User $staff){
        
        return view("admin.adminUpdateStaff", [
            "staff" => $staff,
            
        ]);
    }

    public function updateStaff(User $staff) {

        if (auth()->user()->userProfile->municipality === 'pdrrmo'){
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

            return redirect()->route('admin.staff')->with('success',' Updated Successfully!');
        }


        $validated = request()->validate([
            "user_status" => 'required',
            "isPending" => 'required',
        ]);
        

        $staff->userProfile()->update([
            'user_status'=> $validated['user_status'],
            'isPending'=> $validated['isPending'],
            
        ]);
        
        return redirect()->route('admin.staff')->with('success',' Updated Successfully!');
    }


    public function approve(User $user) {

        $user->userProfile()->update([
            "isPending" => 'approved',
            "user_status" => 'active'
        ]);
        return redirect()->route('admin.approval')->with('success', 'User is now finally approve.');
    }
}
