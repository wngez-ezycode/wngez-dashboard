<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappService
{
    public function sendOtp(string $to, string $code): array
    {
        $accessToken = config('services.whatsapp_cloud.access_token');
        $phoneNumberId = config('services.whatsapp_cloud.phone_number_id');
        $apiVersion = config('services.whatsapp_cloud.api_version', 'v25.0');

        if (blank($accessToken) || blank($phoneNumberId)) {
            return ['success' => false, 'error' => 'WhatsApp Cloud API credentials are not configured.'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->acceptJson()
                ->post("https://graph.facebook.com/{$apiVersion}/{$phoneNumberId}/messages", [
                    'messaging_product' => 'whatsapp',
                    'to' => preg_replace('/\D+/', '', $to),
                    'type' => 'template',
                    'template' => [
                        'name' => config('services.whatsapp_cloud.otp_template', 'waitmeyah_otp'),
                        'language' => [
                            'code' => config('services.whatsapp_cloud.otp_language', 'ar'),
                        ],
                        'components' => [
                            [
                                'type' => 'body',
                                'parameters' => [[
                                    'type' => 'text',
                                    'text' => $code,
                                ]],
                            ],
                            [
                                'type' => 'button',
                                'sub_type' => 'url',
                                'index' => '0',
                                'parameters' => [[
                                    'type' => 'text',
                                    'text' => $code,
                                ]],
                            ],
                        ],
                    ],
                ]);

            $data = $response->json();
            if ($response->successful() && ! empty($data['messages'][0]['id'])) {
                return ['success' => true, 'id' => $data['messages'][0]['id']];
            }

            $error = $data['error']['message'] ?? 'Failed to send WhatsApp OTP.';
            Log::warning('WhatsApp Cloud OTP sending failed.', [
                'status_code' => $response->status(),
                'meta_error_code' => $data['error']['code'] ?? null,
                'error' => $error,
            ]);

            return ['success' => false, 'error' => $error];
        } catch (\Throwable $e) {
            Log::error('WhatsApp Cloud OTP request failed.', ['error' => $e->getMessage()]);

            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
