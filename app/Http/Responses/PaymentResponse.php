<?php

namespace App\Http\Responses;

class PaymentResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'PaymentResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'PaymentResponse operation failed',
            'data' => $data,
        ];
    }
}