<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ZaloZNS
{
    const API_URL = 'https://openapi.zalo.me/v2.0/oa/message?access_token=Akw26QTUz8EYZ5i3JwGj';

    /**
     * Gửi tin nhắn ZNS.
     *
     * @param string $phone Số điện thoại nhận tin nhắn
     * @param string $templateId ID của template
     * @param array $params Tham số cho các biến trong template
     * @return bool
     */
    public function sendMessage(string $phone, string $templateId, array $params): bool
    {
        // Tạo dữ liệu để gửi lên Zalo ZNS
        $data = [
            'recipient' => [
                'user_id' => $phone,
            ],
            'message' => [
                'text' => '',
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_id' => $templateId,
                        'elements' => [
                            [
                                'params' => $params,
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $curl = curl_init(self::API_URL);

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Content-Length: ' . strlen(json_encode($data)),
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        if ($response) {
            return true;
        }

        return false;
    }

    public function sendZaloMessage($templateId, $recipient, $params){
        $code_verifier = bin2hex(random_bytes(32));
        $code_challenge = $this->base64_url_encode(hash('sha256', $code_verifier, true));
        dd($code_challenge);
        $accessToken = 'Akw26QTUz8EYZ5i3JwGj';
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => "Bearer ${accessToken}",
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

    function base64_url_encode($input) {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

}
