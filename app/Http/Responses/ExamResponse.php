<?php

namespace App\Http\Responses;

class ExamResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'ExamResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'ExamResponse operation failed',
            'data' => $data,
        ];
    }
}