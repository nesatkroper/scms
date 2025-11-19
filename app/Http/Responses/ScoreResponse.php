<?php

namespace App\Http\Responses;

class ScoreResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'ScoreResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'ScoreResponse operation failed',
            'data' => $data,
        ];
    }
}