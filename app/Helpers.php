<?php

use Illuminate\Support\Facades\Http;
use Vonage\Client\Credentials\Basic;
use Vonage\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

if (!function_exists('SendResponse')) {

    function SendResponse($status_code,$message,$data = null){
        $response = [
            'status' => $status_code,
            'message' => $message,
        ];
        if($data){
            $response['data'] = $data;
        }
        return response()->json($response,$status_code);
    }
}

if (!function_exists('SendSMS')) {

    function SendSMS($phone,$message)
    {
        $basic = new Basic(env('VONAGE_API_KEY'), env('VONAGE_API_SECRET'));


        $client = new Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("201063153994", '2WayDeal SMS', $message)
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('SendTelegram')) {

    function SendTelegram($message)
    {
        Http::get('https://api.telegram.org/bot'.config('telegram.bot_token').'/sendMessage',[
            'chat_id' => config('telegram.chat_ids.group'),
            'text' => $message
        ]);
    }
}
if(!function_exists('UploadImage'))
{
    function uploadImage($file, $folder_path, $imageOldPath = null)
    {
        if ($imageOldPath && $imageOldPath != 'default.jpg') {
            File::delete(base_path('public_html/uploads/' . $imageOldPath));
        }

        $fileName = Str::uuid() .'.'. $file->extension();
        $path = $file->storeAs($folder_path, $fileName, 'images');

        return $folder_path . '/' . $fileName;
    }
}
