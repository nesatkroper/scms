<?php

namespace App\Http\Responses;

class ExpenseResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'ExpenseResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'ExpenseResponse operation failed',
            'data' => $data,
        ];
    }
}