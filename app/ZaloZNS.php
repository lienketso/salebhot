<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

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

        $accessToken = 'Z2zqT92npoMF9dXyaBV2BOafVNcDoy9ntrnXFAEYd2RpJaqHj96bADa0Ppc5teqotnjJ0Q64Xp3CS6mLkQAGCVisTZZeuBmAkmHHKkdAxd2k12HOwvRjIw1oDMB7kurAkYjcPjZNdsgOGbXmmeQFTxz4Q5pIeQ4HY5D5G_gR-M-SV10stQBCPQTG8tJ4ZE0viN0wRF-0_6Iv43DyoTdqHB4r4aMill1_lrr9JwUNdsRgN5mmhfQZFST17GI8XE9JzbeeT93Emd_8NISobOBWFDjl2JQ0lE8wubCE8w2VjW6xNKqc_RYB8P9GVGZTbP4ifmftVzV4obAk1I5rGYgcZc2Ifyqc';
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'access_token' => "${accessToken}",
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
        $app_id = '726851519957413814';
        $app_callback_url = 'https://sale.baohiemoto.vn/zalo';
        $zalo_permission_url = 'https://oauth.zaloapp.com/v4/oa/permission';
        $codes = $this->generate_pkce_codes();
        $auth_uri = $zalo_permission_url . "?" . http_build_query( array(
                "app_id" => $app_id,
                "redirect_uri" => $app_callback_url,
                "code_challenge" => $codes["challenge"],
            ) );
        header("Location: {$auth_uri}");
    }
    function base64_url_encode($input) {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }



}
