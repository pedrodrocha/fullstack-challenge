<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrentWeatherController extends Controller
{

    public function show(Request $request, int $userId)
    {
        return response()->json([
            'success' => true,
            'id' => $userId,
        ], 200);
    }

}
