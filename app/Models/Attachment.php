<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'path',
        'mime_type',
        'size',
        'restrictions',
        'userprofile_id',
    ];

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'userprofile_id');
    }


}
