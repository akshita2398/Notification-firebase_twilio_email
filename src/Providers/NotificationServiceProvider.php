<?php

namespace Akshita\NotificationFirebaseTwilioEmailPackage\Providers;

use Illuminate\Support\ServiceProvider;
use Akshita\NotificationFirebaseTwilioEmailPackage\Notification;

class NotificationServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        $this->publishes([
            __DIR__.'/notification.php' => config_path('notification.php'),
        ], 'notification-config');
    
        $this->mergeConfigFrom(__DIR__.'/notification.php', 'notification');
    }

    public function register()
    {
        $this->app->bind('notification', function () {
            return new Notification();
        });
    }
}
