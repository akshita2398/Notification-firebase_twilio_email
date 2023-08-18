<?php

namespace Akshita\NotificationFirebaseTwilioEmailPackage\Providers;

use Illuminate\Support\ServiceProvider;
use Akshita\NotificationFirebaseTwilioEmailPackage\Notification;

class NotificationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('notification', function () {
            return new Notification();
        });
    }
}
