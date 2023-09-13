<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use Setting\Models\Setting;

class ZaloZNS
{
    /**
     * Gửi tin nhắn ZNS.
     *
     * @param string $phone Số điện thoại nhận tin nhắn
     * @param string $templateId ID của template
     * @param array $params Tham số cho các biến trong template
     * @return bool
     */

    public function sendZnsApi($templateId, $recipient, $params){
        $setting = Setting::where('setting_key','zalo_access_token')->first();
        $accessZaloToken = $setting->setting_value;
        $url = 'https://business.openapi.zalo.me/message/template';

        $data = json_encode([
            "phone" => $recipient,
            "template_id" => $templateId,
            "template_data" => $params,
            "tracking_id" => "tracking_id"
        ]);

        $headers = [
            'Content-Type: application/json',
            'access_token' => "${accessZaloToken}"
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

// Handle the response as per your application logic
        if ($response === false) {
            // cURL request failed
            $error = curl_error($ch);
            // Handle the error
        } else {
            // cURL request successful
            // Handle the response
            $responseData = json_decode($response, true);
            return $responseData;
            // Process the response
        }

    }
    public function sendZaloMessage($templateId, $recipient, $params){
        $client = new Client();
        $setting = Setting::where('setting_key','zalo_access_token')->first();
        $accessZaloToken = $setting->setting_value;
        $autoAccessToken = $this->getAccessToken();
        $phone = substr_replace($recipient,'84',0,1);
        $response = $client->post('https://business.openapi.zalo.me/message/template', [
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/json',
                'access_token' => $autoAccessToken, // Add your access token here
            ],
            RequestOptions::JSON => [
                'phone' => $phone,
                'template_id' => $templateId,
                'template_data' => $params,
                'tracking_id' => 'tracking_id',
            ],
        ]);
    }

    function generate_pkce_codes() {

        $code_verifier = bin2hex(random_bytes(32));
        $code_challenge = $this->base64_url_encode(hash('sha256', $code_verifier, true));
        return array(
            "verifier" => $code_verifier,
            "challenge" => $code_challenge
        );
    }
    public function getAuthCode(Request $request){
        $appId = 'YOUR_APP_ID';
        $appSecret = 'YOUR_APP_SECRET';
        $redirectUri = 'YOUR_REDIRECT_URI'; // URI mà bạn định nghĩa để nhận lại access token từ Zalo

        $response = Http::get('https://oauth.zaloapp.com/v3/oa/permission?app_id='.$appId.'&redirect_uri='.$redirectUri.'&state=YOUR_STATE');

        // Sau khi nhấn đồng ý trên trang xác thực Zalo, người dùng sẽ được chuyển đến URI của bạn,
        // và tham số code sẽ được trả về
        $code = $request->query('code');

        $response = Http::post('https://oauth.zaloapp.com/v3/access_token', [
            'app_id' => $appId,
            'app_secret' => $appSecret,
            'code' => $code
        ]);

        if ($response->ok()) {
            $accessToken = $response->json()['access_token'];
            return response()->json(['access_token' => $accessToken]);
        }

        return response()->json(['error' => 'Failed to get access token'], 400);
    }

    public function getAccessToken()
    {
        $setting = Setting::where('setting_key','zalo_refresh_token')->first();
        $secretKey = env('ZALO_SECRET_KEY');
        $code_verifier = bin2hex(random_bytes(32));
        $code_challenge = base64_url_encode_zalo(hash('sha256', $code_verifier, true));
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'secret_key' => "${secretKey}",
            ]
        ]);
        $response = $client->post('https://oauth.zaloapp.com/v4/oa/access_token', [
            'form_params' => [
                'app_id' => env('ZALO_OA_ID'),
                'grant_type' => 'refresh_token',
                'refresh_token'=>$setting->setting_value,
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        Setting::updateOrCreate(['setting_key'=>'zalo_refresh_token'],['setting_value'=>$data['refresh_token']]);
        return $data['access_token'];

    }

    function base64_url_encode($input) {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }



}
