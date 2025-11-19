<?php

namespace App\Http\Responses;

class ScheduleResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'ScheduleResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'ScheduleResponse operation failed',
            'data' => $data,
        ];
    }
}