<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Actions\User\RetrieveCurrentWeather;

class CurrentWeatherController extends Controller
{

    public function show(Request $request, RetrieveCurrentWeather $action, int $userId)
    {
        $validator = Validator::make(['user_id' => $userId], [
            'user_id' => ['required', 'exists:users,id'],
        ])->stopOnFirstFailure(true);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 404);
        }

        if ($weather = $action->handle(User::find($userId))) {
            return response()->json([
                'success' => true,
                'data' => $weather,
            ], 200);
        }

        return response()->json([
            'success' => false,
        ], 200);


    }

}
