<?php

namespace App\Http\Responses;

class TeacherSubjectResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'TeacherSubjectResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'TeacherSubjectResponse operation failed',
            'data' => $data,
        ];
    }
}