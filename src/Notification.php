<?php

namespace Akshita\NotificationFirebaseTwilioEmailPackage;

use Illuminate\Support\Facades\Http;

class Notification
{
    public function test()
    {
        return "Hi, This package is working. Use it for simplify and streamline sending notifications through Firebase Cloud Messaging, Twilio SMS, and Email.";
    }

    public function sendNotification($recipientData, $action, $extra_data = null)
    {
        $content = config("notificationContent.{$action}");

        if ($content) {
            // if need to send firebase push notification then push_notification = true 
            if ($content['push_notification'] == true) {
                $content = [
                    "title" => $content['title'],
                    "body" => $content['body'],
                    "click_action" => $content['click_action'],
                ];
                $result['push_notification'] = ["status" => $this->sendFirebaseMessage($recipientData['firebase_token'], $content, $extra_data)];
            }

            // if need to send twilio message then message = true 
            if ($content['message'] == true) {
                $result['message'] = ["status" => false ];
            }


            // if need to send emails then emails = true 
            if ($content['email'] == true) {
                $result['email'] = ["status" => false ];
            }

        } else {
            return ["status" => "false", "message" => "Notification content not found."];
        }

        return $result;
    }

    public function sendFirebaseMessage($recipient, $content, $extra_data)
    {
        $apiKey = config('notification.firebase.api_key');

        $data = [
            'registration_ids' => $recipient,
            "notification" => [
                "title" => $content['title'] ?? "New Message",
                "body" => $content['body'] ?? "New Notification",
                "click_action" => $content['click_action'] ?? "",
            ],
            'data' => [
                'values' => $extra_data
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => 'key=' . $apiKey,
            'Content-Type: application/json',
        ])->post('https://fcm.googleapis.com/fcm/send', $data);


        return $response->successful();
    }

}