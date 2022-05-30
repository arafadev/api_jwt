<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

trait ApiResponse
{
    public function apiResponse($data = null, $msg = null, $status = null)
    {
        $info = [
            'message' => $msg,
            'status' => $status,
            'data' => $data,
        ];
        return response($info, $status);
    }
}
