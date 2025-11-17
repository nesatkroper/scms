<?php

namespace App\Http\Responses;

class PasswordResetTokenResponse
{
    public static function success($data = null, string $message = null): array
    {
        return [
            'success' => true,
            'message' => $message ?? 'PasswordResetTokenResponse operation successful',
            'data' => $data,
        ];
    }

    public static function error(string $message = null, $data = null): array
    {
        return [
            'success' => false,
            'message' => $message ?? 'PasswordResetTokenResponse operation failed',
            'data' => $data,
        ];
    }
}