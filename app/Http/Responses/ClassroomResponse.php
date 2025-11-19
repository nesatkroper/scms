<?php

namespace App\Http\Responses;

class ClassroomResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'ClassroomResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'ClassroomResponse operation failed',
            'data' => $data,
        ];
    }
}