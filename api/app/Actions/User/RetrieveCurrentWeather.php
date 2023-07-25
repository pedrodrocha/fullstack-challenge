<?php

namespace App\Actions\User;

use App\Models\User;
use App\Services\Weather\WeatherData;
use Illuminate\Support\Facades\Cache;

class RetrieveCurrentWeather
{
    public function handle(User $user, bool $refresh): array
    {
        if (!Cache::has('weather_' . $user->id) || $refresh) {
            $weather = $this->fetchWeatherData($user->latitude, $user->longitude);

            if ($weather) {
                $weatherObj = [
                    'retrieved' => now(),
                    'data' => $weather,
                ];

                Cache::put('weather_' . $user->id, $weatherObj, now()->addHours(1));

                return $weatherObj;
            }
        }

        return Cache::get('weather_' . $user->id);

    }

    private function fetchWeatherData($latitude, $longitude): WeatherData
    {
        $weather = new \Weather();
        return $weather->get($latitude, $longitude);
    }
}
