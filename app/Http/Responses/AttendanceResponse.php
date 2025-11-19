<?php

namespace App\Http\Responses;

class AttendanceResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'AttendanceResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'AttendanceResponse operation failed',
            'data' => $data,
        ];
    }
}