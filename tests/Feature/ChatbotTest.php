<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ChatbotTest extends TestCase
{
    use RefreshDatabase;

    public function test_chatbot_endpoint_returns_model_reply(): void
    {
        config()->set('services.xai.api_key', 'test-key');
        config()->set('services.xai.model', 'grok-4.20-reasoning');
        $token = 'test-token';

        Http::fake([
            'https://api.x.ai/v1/responses' => Http::response([
                'output_text' => 'We offer pressure, flow, level, analytical, and process instruments.',
            ], 200),
        ]);

        $response = $this
            ->withSession(['_token' => $token])
            ->withHeader('X-CSRF-TOKEN', $token)
            ->postJson('/chatbot/message', [
                'message' => 'What products do you offer?',
                'history' => [],
            ]);

        $response->assertOk();
        $response->assertJson([
            'reply' => 'We offer pressure, flow, level, analytical, and process instruments.',
            'model' => 'grok-4.20-reasoning',
        ]);
    }

    public function test_chatbot_endpoint_returns_configuration_error_without_api_key(): void
    {
        config()->set('services.xai.api_key', null);
        $token = 'test-token';

        $response = $this
            ->withSession(['_token' => $token])
            ->withHeader('X-CSRF-TOKEN', $token)
            ->postJson('/chatbot/message', [
                'message' => 'Hello',
            ]);

        $response->assertStatus(503);
        $response->assertJson([
            'message' => 'Chatbot is not configured yet. Please add your XAI_API_KEY in the .env file.',
        ]);
    }
}
