<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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

    public function sendZaloMessage($templateId, $recipient, $params){
        $setting = Setting::where('setting_key','zalo_access_token')->first();
        $accessZaloToken = $setting->setting_value;
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'access_token' => "${accessZaloToken}",
            ]
        ]);
        try {
            $response = $client->post('https://business.openapi.zalo.me/message/template', [
                'form_params' => [
                    'template_id' => $templateId,
                    'recipient' => $recipient,
                    'params' => json_encode($params),
                ],
            ]);
            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

    function generate_pkce_codes() {

        $code_verifier = bin2hex(random_bytes(32));
        $code_challenge = $this->base64_url_encode(hash('sha256', $code_verifier, true));
        return array(
            "verifier" => $code_verifier,
            "challenge" => $code_challenge
        );
    }
    public function getAuthCode(){
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
    function base64_url_encode($input) {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }



}
