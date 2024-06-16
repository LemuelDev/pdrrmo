<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "municipality",
        "profile"
    ];

    protected $table = 'userprofiles';


    public function user()
    {
            return $this->hasOne(User::class, 'userprofile_id')->onDelete('cascade');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'userprofile_id');
    }

    public function transferRequest()
    {
        return $this->hasMany(TransferOfRequest::class, 'userprofile_id');
    }

    public function getImageUrl(){
        
        if ($this->profile !== null){
            return url('storage/'.$this->profile);
        }
        
        return "https://ui-avatars.com/api/?name={$this->name}";
    }
}
