<?php

namespace Akshita\NotificationFirebaseTwilioEmailPackage\Models;

use Illuminate\Database\Eloquent\Model;

class UserDeviceToken extends Model
{    
    public function users()
    {
        return $this->belongsTo(Users::class);
    }

}

