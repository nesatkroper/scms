<?php

namespace App\Http\Responses;

class SubjectResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'SubjectResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'SubjectResponse operation failed',
            'data' => $data,
        ];
    }
}