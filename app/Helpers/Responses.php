<?php

if (!function_exists('successResponse')) {
    function successResponse($data = [])
    {
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
if (!function_exists('errorResponse')) {
    function errorResponse($message, $statusNum)
    {
        return response()->json([
            'status' => false,
            'message' => $message
        ], $statusNum);
    }
}
if (!function_exists('successMessage')) {
    function successMessage($message)
    {
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }
}

if (!function_exists('returnTokens')) {
    function returnTokens($tokens)
    {
        $data['token_type'] = $tokens['token_type'];
        $data['access_token'] = $tokens['access_token'];
        $data['refresh_token'] = $tokens['refresh_token'];
        return response()->json([
            'status' => true,
            'message' => $data
        ]);
    }
}

