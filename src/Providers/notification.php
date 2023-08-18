<?php

return [
    'firebase' => [
        'api_key' => env('FIREBASE_SERVER_KEY'),
        // Other Firebase configuration options...
    ],
    
    'message_deiver' => [
        'notification_message_deiver' => env('NOTIFICATION_MESSAGE_DRIVER') ?? 'twilio', // twilio,  nexmo
    ],

    'twilio' => [
        'account_sid' => env('TWILIO_ACCOUNT_SID'),
        'auth_token' => env('TWILIO_AUTH_TOKEN'),
        'messaging_service_id' => env('TWILIO_SERVICE_ID'),
        // Other Twilio configuration options...
    ],

    'nexmo' => [
        'api_key' => env('NEXMO_API_KEY'),
        'api_secret' => env('NEXMO_API_SECRET'),
        'from' => env('NEXMO_FROM'),
        // Other nexmo configuration options...
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
