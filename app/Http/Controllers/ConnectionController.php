<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConnectionController extends Controller
{
    public function handleScript(Request $request)
    {
        $data = $request->all();
        
        Log::info("Received character data: ", $data);

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Received character data',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No data received.'
            ], 400);
        }
    }
}