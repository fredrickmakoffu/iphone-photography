<?php

namespace App\Traits\Helpers;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function success($data, $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => collect($data)->except(['created_at', 'updated_at', 'deleted_at']),
        ], $code);
    }

    protected function error($message, $code = 500): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }
}
