<?php

namespace App\Services;

class APIService 
{
    public function responseSuccess($data, $message = 'success', $status_code = 200) {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status_code);
    }

    public function responseFailed($message, $status_code = 404) {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $status_code);
    }
}