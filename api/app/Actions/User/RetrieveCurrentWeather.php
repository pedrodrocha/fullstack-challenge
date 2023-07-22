<?php

namespace App\Actions\User;

use App\Models\User;
use App\Services\Weather\WeatherData;
use Illuminate\Support\Facades\Cache;

class RetrieveCurrentWeather
{
    public function handle(User $user): WeatherData|bool
    {
        if (! Cache::has('weather_' . $user->id)) {
            $weather = new \Weather();
            $weather = $weather->get($user->latitude, $user->longitude);

            if ($weather) {
                Cache::put(
                    'weather_' . $user->id,
                    [
                        'retrieved' => now(),
                        'data' => $weather,
                    ],
                    now()->addHours(1)
                );
            }

            return $weather;
        }



        return  Cache::get('weather_' . $user->id)['data'];
    }
}
