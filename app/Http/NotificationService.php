<?php

namespace App\Http;

use GuzzleHttp\Client;

class NotificationService
{
    static public function pushFirebase($deviceId, $payload = []) {
        try {
            // set headers and body according to firebase docs 
            // https://firebase.google.com/docs/cloud-messaging/server#implementing-http-connection-server-protocol
            
            $headers = [
                'Content-Type' => 'application/json',
                // auth key using enviroment variable
                'Authorization' => 'key=' . env('FIREBASE_KEY'),
            ];
            
            // insert new broadcast
            $requestUrl = 'https://fcm.googleapis.com/fcm/send';
            $body = [
                'to' => $deviceId,
                'data' => $payload
            ];

            $client = new Client;
            
            $response = $client->request('POST', $requestUrl, [
                'headers' => $headers,
                'json' => $body,
                'verify' => false,
            ]);
            
            $responseData = json_decode($response->getBody());
            
            \Log::info('send notification sucsess');
        }
        catch (\GuzzleHttp\Exception\ClientException $e){
            // handle request exception to firebase service here
            \Log::error('send notification failed' . $e->getMessage());          
        }
        catch (Exception $e) {
            \Log::error('send notification failed' . $e->getMessage());
        }
    }
}
