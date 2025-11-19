<?php

namespace App\Http\Responses;

class DepartmentResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'DepartmentResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'DepartmentResponse operation failed',
            'data' => $data,
        ];
    }
}