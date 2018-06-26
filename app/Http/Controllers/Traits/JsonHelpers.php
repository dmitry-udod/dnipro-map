<?php

namespace App\Http\Controllers\Traits;

trait JsonHelpers
{
    protected function jsonError($message, $code)
    {
        return response(json_encode(['error' => $message]), $code);
    }

    private function jsonMessage($message, $code = 200)
    {
        return response(json_encode(['message' => $message]), $code);
    }

    private function jsonData($data, $code = 200, $metadata = null)
    {
        $result = ['data' => $data];
        if ($metadata !== null) {
            $result['metadata'] = $metadata;
        }
        return response()->json($result, $code);
    }

}