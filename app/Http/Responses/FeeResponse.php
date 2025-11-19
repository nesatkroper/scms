<?php

namespace App\Http\Responses;

class FeeResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'FeeResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'FeeResponse operation failed',
            'data' => $data,
        ];
    }
}