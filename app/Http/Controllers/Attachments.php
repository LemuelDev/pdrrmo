<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Attachments extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'attachment' => 'required|file|mimes:pdf,doc,docx,pptx,xlsx|max:50000', 
            'restrictions' => 'required'
        ]);

        $file = $request->file('attachment');

        $filename = $file->getClientOriginalName();

        $existingAttachment = Attachment::where('filename', $filename)->first();

            if ($existingAttachment) {
                if (auth()->user()->userProfile->user_type === 'superadmin'){
                    return redirect()->route('sa.create')->with('failed','The file is already exists!');
                }else if (auth()->user()->userProfile->user_type === 'admin'){
                    return redirect()->route('admin.create')->with('failed','The file is already exists!');
                }else if (auth()->user()->userProfile->user_type === 'staff'){
                    return redirect()->route('staff.create')->with('failed','The file is already exists!');
                }
             }

        $filePath = request()->file('attachment')->store('files', 'public');

        Attachment::create([
            'filename' => $filename,
            'path' => $filePath,
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'restrictions' => $request->input('restrictions'),
            'userprofile_id' => auth()->user()->userProfile->id,
        ]);

        if (auth()->user()->userProfile->user_type === 'superadmin'){
            return redirect()->route('sa.attachments')->with('success','Uploaded Successfully!');
        }else if (auth()->user()->userProfile->user_type === 'admin'){
            return redirect()->route('admin.attachments')->with('success','Uploaded Successfully!');
        }else if (auth()->user()->userProfile->user_type === 'staff'){
            return redirect()->route('staff.attachments')->with('success','Uploaded Successfully!');
        }
    }



    public function edit (Attachment $file) {
        if(auth()->user()->userprofile->id !== $file->userprofile_id){
            if (auth()->user()->userProfile->user_type === 'superadmin'){
                return redirect()->route('sa.attachments')->with('failed','You are not the uploader of this file.');
            }else if (auth()->user()->userProfile->user_type === 'admin'){
                return redirect()->route('admin.attachments')->with('failed','You are not the uploader of this file.');
            }else if (auth()->user()->userProfile->user_type === 'staff'){
                return redirect()->route('staff.attachments')->with('failed','You are not the uploader of this file.');
            }
        }
        
        $editing = true;
        
        if (auth()->user()->userProfile->user_type === 'superadmin'){
            return view("superadmin.sa_attachments", compact("file", "editing"));
        }else if (auth()->user()->userProfile->user_type === 'admin'){
            return view("admin.adminAttachments", compact("file", "editing"));
        }else if (auth()->user()->userProfile->user_type === 'staff'){
            return view("staff.staff_attachments", compact("file", "editing"));
        }
       
    }

    public function update (Attachment $file) {
        $validated = request()->validate([
            "restrictions" => 'required'
        ]);

        $file->update([
            'restrictions' => $validated['restrictions']
        ]);

        if (auth()->user()->userProfile->user_type === 'superadmin'){
            return redirect()->route('sa.attachments')->with('success','Updated Successfully!');
        }else if (auth()->user()->userProfile->user_type === 'admin'){
            return redirect()->route('admin.attachments')->with('success','Updated Successfully!');
        }else if (auth()->user()->userProfile->user_type === 'staff'){
            return redirect()->route('staff.attachments')->with('success','Updated Successfully!');
        }

    }


    public function destroy (Attachment $file) {
        if(auth()->user()->userprofile->id !== $file->userprofile_id){
            if (auth()->user()->userProfile->user_type === 'superadmin'){
                return redirect()->route('sa.attachments')->with('failed','You are not the uploader of this file.');
            }else if (auth()->user()->userProfile->user_type === 'admin'){
                return redirect()->route('admin.attachments')->with('failed','You are not the uploader of this file.');
            }else if (auth()->user()->userProfile->user_type === 'staff'){
                return redirect()->route('staff.attachments')->with('failed','You are not the uploader of this file.');
            }
        }

        $file->delete();
         Storage::disk('public')->delete($file->path);
    

        if (auth()->user()->userProfile->user_type === 'superadmin'){
            return redirect()->route('sa.attachments')->with('success','Deleted Successfully!');
        }else if (auth()->user()->userProfile->user_type === 'admin'){
            return redirect()->route('admin.attachments')->with('success','Deleted Successfully!');
        }else if (auth()->user()->userProfile->user_type === 'staff'){
            return redirect()->route('staff.attachments')->with('success','Deleted Successfully!');
        }


    }
    
    
}
