<?php

namespace Akshita\NotificationFirebaseTwilioEmailPackage;

use Illuminate\Support\Facades\Http;

class Notification
{
    public function test()
    { 
        return "Hi, This package is working. Use it for simplify and streamline sending notifications through Firebase Cloud Messaging, Twilio SMS, and Email.";
    }

    public function sendFirebaseMessage($recipient, $content )
    {
        $apiKey = config('notification.firebase.api_key');
        
        $data = [
            'to' => $recipient,
            "notification" => [
                "title" => $content['title'] ?? "New Message",
                "body" => $content['body'] ?? "New Notification",
                "click_action" => $content['click_action'] ?? "",
            ],
            'data' => [
                'values' => $content
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => 'key=' . $apiKey,
            'Content-Type: application/json',
        ])->post('https://fcm.googleapis.com/fcm/send', $data );


        return $response->successful();
    }

}