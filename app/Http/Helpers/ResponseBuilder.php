<?php

namespace App\Http\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseBuilder
{
    public static function success(mixed $data = null, string $message = '', int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'locale' => app()->getLocale(),
            'message' => $message,
            'result' => $data,
        ], $statusCode);
    }

    public static function error(string $message = '', array $errors = [], int $statusCode = 500): JsonResponse
    {
        return response()->json([
            'locale' => app()->getLocale(),
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }
}
