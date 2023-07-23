<?php

namespace App\Http\Controllers;

use App\Actions\User\RetrieveCurrentWeather;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $refresh = $request['refresh'] === 'refresh' ? true : false;

        if ($weather = $action->handle(User::find($userId), $refresh)) {
            return response()->json([
                'success' => true,
                'data' => $weather['data'],
                'last_retrieved' => $weather['retrieved']
            ], 200);
        }

        return response()->json([
            'success' => false,
        ], 200);
    }
}
