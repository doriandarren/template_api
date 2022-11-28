<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

class HandlerResponse
{

    /**
     * @param $message
     * @param $statusCode
     * @param null $errors
     * @return JsonResponse
     */
    public static function respondWithError($message, $statusCode, $errors=null): JsonResponse
    {
        $data = [
            'message' => $message,
            'errors' => $errors,
            'success' => FALSE,
            'status_code' => $statusCode
        ];
        return response()->json($data, $statusCode);
    }


}
