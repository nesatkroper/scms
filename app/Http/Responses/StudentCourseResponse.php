<?php

namespace App\Http\Responses;

class StudentCourseResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'StudentCourseResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'StudentCourseResponse operation failed',
            'data' => $data,
        ];
    }
}