<?php


namespace App\Traits;

trait JSONResponseTrait

{
    public function jsonResponse($status_code, $data, $message, $error)
    {
        if ($error != null) {
            return response()->json([
                'error' => $error->getMessage()
            ], $status_code);
        }
        return response()->json([
            'data' => $data,
            'message' => $message
        ], $status_code);
    }

}
