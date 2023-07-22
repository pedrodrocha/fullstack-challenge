<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrentWeatherController extends Controller
{

    public function show(Request $request, int $userId)
    {
        $validator = Validator::make(['user_id' => $userId], [
            'user_id' => ['required', 'exists:users,id'],
        ])->stopOnFirstFailure(true);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 404);
        }


        return response()->json([
            'success' => true,
            'id' => $userId,
        ], 200);
    }

}
