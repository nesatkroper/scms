<?php

namespace App\Http\Responses;

class SessionResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'SessionResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'SessionResponse operation failed',
            'data' => $data,
        ];
    }
}