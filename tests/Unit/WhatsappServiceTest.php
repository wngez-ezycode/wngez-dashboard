<?php

namespace Tests\Unit;

use App\Services\WhatsappService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WhatsappServiceTest extends TestCase
{
    public function test_it_sends_an_otp_with_the_configured_meta_template(): void
    {
        config()->set('services.whatsapp_cloud', [
            'access_token' => 'test-token',
            'phone_number_id' => '123456',
            'api_version' => 'v25.0',
            'otp_template' => 'waitmeyah_otp',
            'otp_language' => 'ar',
        ]);

        Http::fake([
            'graph.facebook.com/*' => Http::response([
                'messages' => [['id' => 'wamid.test']],
            ]),
        ]);

        $result = app(WhatsappService::class)->sendOtp('+20 114 097 3776', '845921');

        $this->assertTrue($result['success']);
        Http::assertSent(fn ($request) =>
            $request->url() === 'https://graph.facebook.com/v25.0/123456/messages'
            && $request->hasHeader('Authorization', 'Bearer test-token')
            && $request['to'] === '201140973776'
            && $request['template']['name'] === 'waitmeyah_otp'
            && $request['template']['components'][0]['parameters'][0]['text'] === '845921'
            && $request['template']['components'][1]['parameters'][0]['text'] === '845921'
        );
    }

    public function test_it_fails_cleanly_when_credentials_are_missing(): void
    {
        config()->set('services.whatsapp_cloud.access_token');
        config()->set('services.whatsapp_cloud.phone_number_id');

        $result = app(WhatsappService::class)->sendOtp('201140973776', '845921');

        $this->assertFalse($result['success']);
        Http::assertNothingSent();
    }
}
