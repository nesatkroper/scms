<?php

namespace App\Http\Responses;

class ExpenseCategoryResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'ExpenseCategoryResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'ExpenseCategoryResponse operation failed',
            'data' => $data,
        ];
    }
}