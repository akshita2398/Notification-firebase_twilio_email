<?php

namespace Akshita\NotificationFirebaseTwilioEmailPackage;

use Illuminate\Support\Facades\Http;

class Notification
{
    public function test()
    {
        return "Hi, This package is working. Use it for simplify and streamline sending notifications through Firebase Cloud Messaging, Twilio SMS, and Email.";
    }

    public function replace_veriables($content, $extra_data)
    {
        if($extra_data != Null){
            foreach($content as $key => $data ){
                $content[$key] =  str_replace(
                    array_map(function ($v) {
                        return '{{' . $v . '}}';
                    }, array_keys($extra_data)),
                    array_values($extra_data),
                    $content[$key]
                );
            }
        }
        return $content;
    }

    public function sendNotification($recipientData, $action, $extra_data = null)
    {
        $content = config("notificationContent.{$action}");

        if ($content) {
            $content = $this->replace_veriables($content, $extra_data);

            // if need to send firebase push notification then push_notification = true 
            if ($content['push_notification'] == true) {
                $data = [
                    "title" => $content['title'],
                    "body" => $content['body'],
                    "click_action" => $content['click_action'],
                ];
                $result['push_notification'] = ["status" => $this->sendFirebaseMessage($recipientData['firebase_token'], $data, $extra_data),  "message" => "Firebase push Notification sent successfully." ];
            }

            // if need to send twilio message then message = true 
            if ($content['twilio_message'] == true) {
                $result['twilio_message'] = ["status" => false,  "message" => "Twilio message not sent."  ];
            }


            // if need to send emails then emails = true 
            if ($content['email'] == true) {
                $result['email'] = ["status" => false ,  "message" => "email not sent." ];
            }

        } else {
            return ["status" => "false", "message" => "Notification content not found."];
        }

        return ["status" => "true", "result" =>  $result ];
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