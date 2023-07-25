<?php

namespace App\Http\Controllers;

use App\Actions\User\RetrieveCurrentWeather;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CurrentWeatherController extends Controller
{
    public function show(Request $request, RetrieveCurrentWeather $action, int $userId)
    {
        // Validate the user_id
        $validator = Validator::make(['user_id' => $userId], [
            'user_id' => ['required', 'exists:users,id'],
        ])->stopOnFirstFailure(true);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], Response::HTTP_NOT_FOUND);
        }

        // Check the refresh flag
        $refresh = $request->input('refresh') === 'refresh';

        try {
            // Retrieve weather data using the action
            $weather = $action->handle(User::findOrFail($userId), $refresh);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving weather data.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($weather !== []) {
            return response()->json([
                'success' => true,
                'data' => $weather['data'],
                'last_retrieved' => $weather['retrieved'],
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => false,
        ], Response::HTTP_OK);
    }
}
