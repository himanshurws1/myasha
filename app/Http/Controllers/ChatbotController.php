<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
            'history' => ['nullable', 'array', 'max:12'],
            'history.*.role' => ['required', 'string', 'in:user,assistant'],
            'history.*.content' => ['required', 'string', 'max:2000'],
        ]);

        $apiKey = config('services.xai.api_key');

        if (! $apiKey) {
            return response()->json([
                'message' => 'Chatbot is not configured yet. Please add your XAI_API_KEY in the .env file.',
            ], 503);
        }

        $site = config('site');
        $history = collect($validated['history'] ?? [])
            ->take(-10)
            ->map(fn (array $item) => [
                'role' => $item['role'],
                'content' => $item['content'],
            ])
            ->values()
            ->all();

        $input = array_merge($history, [
            [
                'role' => 'user',
                'content' => $validated['message'],
            ],
        ]);

        $response = Http::withToken($apiKey)
            ->timeout(30)
            ->acceptJson()
            ->post('https://api.x.ai/v1/responses', [
                'model' => config('services.xai.model'),
                'instructions' => $this->instructions($site),
                'input' => $input,
            ]);

        if ($response->failed()) {
            return response()->json([
                'message' => 'The chatbot could not respond right now. Please try again in a moment.',
                'details' => $response->json('error.message'),
            ], 502);
        }

        $data = $response->json();
        $reply = $this->extractReply($data);

        if (! $reply) {
            return response()->json([
                'message' => 'The chatbot did not return a readable reply. Please try again.',
            ], 502);
        }

        return response()->json([
            'reply' => $reply,
            'model' => config('services.xai.model'),
        ]);
    }

    protected function instructions(array $site): string
    {
        $categories = collect($site['product_categories'] ?? [])
            ->pluck('title')
            ->implode(', ');

        $industries = collect($site['industries_applications'] ?? [])
            ->pluck('title')
            ->implode(', ');

        return implode("\n", [
            'You are the website assistant for ' . $site['name'] . '.',
            'Answer briefly, clearly, and professionally.',
            'Focus on company details, products, industries, quotations, and contact help.',
            'If the user asks for address, email, or phone, use these exact details:',
            'Address: ' . $site['address'],
            'Email: ' . $site['email'],
            'Phone: ' . $site['phone'],
            'Product categories: ' . $categories,
            'Industries: ' . $industries,
            'If you are unsure, say you can help the user submit an enquiry through the contact form.',
            'Do not invent unavailable pricing, stock, or technical specs.',
        ]);
    }

    protected function extractReply(array $data): ?string
    {
        if (! empty($data['output_text']) && is_string($data['output_text'])) {
            return trim($data['output_text']);
        }

        foreach (($data['output'] ?? []) as $outputItem) {
            if (($outputItem['type'] ?? null) !== 'message') {
                continue;
            }

            foreach (($outputItem['content'] ?? []) as $contentItem) {
                if (($contentItem['type'] ?? null) === 'output_text' && ! empty($contentItem['text'])) {
                    return trim($contentItem['text']);
                }
            }
        }

        return null;
    }
}
