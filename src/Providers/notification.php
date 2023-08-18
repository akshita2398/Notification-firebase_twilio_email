<?php

return [
    'firebase' => [
        'api_key' => env('FIREBASE_SERVER_KEY'),
        // Other Firebase configuration options...
    ],

    'twilio' => [
        'account_sid' => env('TWILIO_ACCOUNT_SID'),
        'auth_token' => env('TWILIO_AUTH_TOKEN'),
        // Other Twilio configuration options...
    ],

  
    'email' => [
        'mail_mailer' => env('MAIL_MAILER'),
        'mail_host' => env('MAIL_HOST'),
        'mail_username' => env('MAIL_USERNAME'),
        'mail_password' => env('MAIL_PASSWORD'),
        'mail_from_name' => env('MAIL_FROM_NAME'),
        // Other Email configuration options...
    ],
];
