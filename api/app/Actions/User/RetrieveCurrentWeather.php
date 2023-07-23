<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class RetrieveCurrentWeather
{
    public function handle(User $user, bool|NULL $refresh): array
    {
        if (! Cache::has('weather_'.$user->id) || $refresh) {
            $weather = new \Weather();
            $weather = $weather->get($user->latitude, $user->longitude);

            $weatherObj = [
                'retrieved' => now(),
                'data' => $weather,
            ];

            if ($weather) {
                Cache::put('weather_'.$user->id, $weatherObj, now()->addHours(1));
            }

            return $weatherObj;
        }

        return  Cache::get('weather_'.$user->id);
    }
}
