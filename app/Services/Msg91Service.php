<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class Msg91Service
{
    public function sendSms(string $to, string $message, array $variables = []): array
    {
        $flowId = config('msg91.flow_id');
        return $flowId
            ? $this->sendViaFlow($to, $flowId, $variables + ['message' => $message])
            : $this->sendViaSmsApi($to, $message);
    }

    private function sendViaFlow(string $to, string $flowId, array $vars): array
    {
        $payload = [
            'flow_id' => $flowId,
            'sender' => config('msg91.sender'),
            'recipients' => [
                array_merge(['mobiles' => $this->formatNumber($to)], $vars),
            ],
        ];

        $response = Http::withHeaders([
            'authkey' => config('msg91.auth_key'),
            'Content-Type' => 'application/json',
        ])->post('https://api.msg91.com/api/v5/flow/', $payload);

        return [
            'ok' => $response->successful(),
            'body' => $response->json(),
            'status' => $response->status(),
            'message_id' => $response->json('requestId') ?? $response->json('data.request_id') ?? null,
        ];
    }

    private function sendViaSmsApi(string $to, string $message): array
    {
        $payload = [
            'sender' => config('msg91.sender'),
            'route' => config('msg91.route'),
            'country' => config('msg91.country'),
            'sms' => [
                [
                    'message' => $message,
                    'to' => [$this->formatNumber($to)],
                ],
            ],
        ];

        $response = Http::withHeaders([
            'authkey' => config('msg91.auth_key'),
            'Content-Type' => 'application/json',
        ])->post('https://api.msg91.com/api/v2/sendsms', $payload);

        return [
            'ok' => $response->successful(),
            'body' => $response->json(),
            'status' => $response->status(),
            'message_id' => $response->json('sms.0.message_id') ?? null,
        ];
    }

    private function formatNumber(string $raw): string
    {
        $digits = preg_replace('/\\D+/', '', $raw);
        if (Str::startsWith($digits, config('msg91.country'))) {
            return $digits;
        }
        return config('msg91.country') . $digits;
    }
}
