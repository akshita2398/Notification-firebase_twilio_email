<?php

namespace Akshita\NotificationFirebaseTwilioEmailPackage\Models;

use Illuminate\Database\Eloquent\Model;

class UserDeviceToken extends Model
{    
    protected $fillable = [
        'device_token',
        'device_type'
    ];
    
    public function users()
    {
        return $this->belongsTo(Users::class);
    }

}

