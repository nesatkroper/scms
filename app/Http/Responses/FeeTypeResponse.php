<?php

namespace App\Http\Responses;

class FeeTypeResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'FeeTypeResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'FeeTypeResponse operation failed',
            'data' => $data,
        ];
    }
}