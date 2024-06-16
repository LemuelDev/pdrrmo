<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferOfRequest extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name', 
        'userprofile_id', 
        'municipality_admin',
        'current_municipality',
        'requested_municipality',
        'user_type'
    ];
    
    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'userprofile_id');
    }
}
