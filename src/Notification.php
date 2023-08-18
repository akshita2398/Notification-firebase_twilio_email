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
        if ($extra_data != Null) {
            foreach ($content as $key => $data) {
                $content[$key] = str_replace(
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
                $result['push_notification'] = ["status" => $this->sendFirebaseMessage($recipientData['firebase_token'], $data, $extra_data), "message" => "Firebase push Notification sent successfully."];
            }

            // if need to send twilio message then message = true 
            if ($content['SMS_message'] == true) {
                $message_deiver = config('notification.message_deiver.notification_message_deiver');
                $receiver = $recipientData['phone_number'];
                switch ($message_deiver) {
                    case 'twilio':
                        $response = self::sendTwilioSMS($receiver, $content['sms_message_body']);
                        break;

                    case 'nexmo':
                        $response = self::sendNexmoSMS($receiver, $content['sms_message_body']);
                        break;

                    default:
                        $result['SMS_message'] = ["status" => false, "message" => "Twilio message not sent."];
                        break;
                }
                $result['SMS_message'] = ["status" => $response, "message" => "Firebase push Notification sent successfully."];

            }

            // if need to send emails then emails = true 
            if ($content['email'] == true) {
                $result['email'] = ["status" => false, "message" => "email not sent."];
            }

        } else {
            return ["status" => "false", "message" => "Notification content not found."];
        }

        return ["status" => "true", "result" => $result];
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

    public static function sendTwilioSMS($receiver, $content)
    {
        $config = config('notification.twilio');
        try {
            $response = Http::withBasicAuth($config['account_sid'] ,  $config['auth_token'] )
            ->post("https://api.twilio.com/2010-04-01/Accounts/{$config['account_sid']}/Messages.json", [
                'From' => $config['messaging_service_id'],
                'To' => $receiver,
                'Body' =>  $content,
            ]);
            $response = $response->successful();
        } catch (\Exception $exception) {
            $response = false;
        }

        return $response;
    }

    public static function sendNexmoSMS($receiver, $content)
    {
        $config = config('notification.nexmo');
        $response = Http::post("https://rest.nexmo.com/sms/json", [
            'api_key' => $config['api_key'],
            'api_secret' =>  $config['api_secret'],
            'from' => $config['from'],
            'to' =>  $receiver,
            'text' =>  $content,
        ]);
        $responseData = $response->json();

        if ($responseData['messages'][0]['status'] == 0) {
            return true;
            // return response()->json(['message' => 'SMS sent successfully', 'message_id' => $responseData['messages'][0]['message-id']]);
        } else {
            return false;
            // return response()->json(['message' => 'Failed to send SMS'], $response->status());
        }
       
    }



}