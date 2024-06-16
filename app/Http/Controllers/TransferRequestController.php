<?php

namespace App\Http\Controllers;

use App\Models\TransferOfRequest;
use App\Models\TransferRequest;
use Illuminate\Http\Request;

class TransferRequestController extends Controller
{
    public function destroy(TransferOfRequest $user) {
        
        $user->delete();

        return redirect()->route('admin.request')->with('success', 'Request Deleted Successfully');
    }

    public function store() {
        $user = auth()->user()->userProfile;

        $validated = request()->validate([
            "requested_municipality" => "required"
        ]);

        if ($user->user_type == 'admin'){
            TransferOfRequest::create([
                "name" => $user->name,
                "userprofile_id" => $user->id,
                "user_type" => $user->user_type,
                "current_municipality" => $user->municipality,
                "requested_municipality" => $validated["requested_municipality"],
                "municipality_admin" => "approved"
            ]);

            return redirect()->route('admin.profile')->with('success', "Requested Successfully");
        }else {
            TransferOfRequest::create([
                "name" => $user->name,
                "userprofile_id" => $user->id,
                "user_type" => $user->user_type,
                "current_municipality" => $user->municipality,
                "requested_municipality" => $validated["requested_municipality"],
                "municipality_admin" => "pending"
            ]);

            // route
            return redirect()->route('staff.profile')->with('success', "Requested Successfully");
        }




    }
}
