<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccessModule extends Model
{
    use HasFactory;
    public function user_access()
    {
        return $this->hasMany(\App\Models\UserAccess::class,'user_access_id');
    }
}
