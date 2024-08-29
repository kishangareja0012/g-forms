<?php

use App\Models\Input;
use Illuminate\Support\Facades\Route;

define('EXCEPTION', 'Exception');
define('FORM_CREATED', 'FormCreated');

if (!function_exists('getRouteName')) {
    function getRouteName()
    {
        return Route::currentRouteName();
    }
}

if (!function_exists('jsonResponse')) {
    function jsonResponse($success, $type, $status, $message = '', $data = [])
    {
        return response()->json([
            "success" => $success,
            "type" => $type,
            "message" => $message,
            "data" => $data,
            "code" => $status
        ], $status);
    }
}

if (!function_exists('getTypeName')) {
    function getTypeName($type)
    {
        return Input::where('type', $type)->first();
    }
}
