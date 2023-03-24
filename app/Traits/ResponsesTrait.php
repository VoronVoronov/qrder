<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponsesTrait
{
    public function success($data = null, $message = null, $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message' => $message
        ], $code);
    }

    public function error($message = null, $code = 400): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }
}
