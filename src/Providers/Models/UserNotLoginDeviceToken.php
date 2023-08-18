<?php

namespace Akshita\NotificationFirebaseTwilioEmailPackage\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotLoginDeviceToken extends Model
{    
    public function users()
    {
        return $this->belongsTo(Users::class);
    }

}

