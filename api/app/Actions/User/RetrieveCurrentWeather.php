<?php

namespace App\Actions\User;

use App\Models\User;
use App\Services\Weather\WeatherData;

class RetrieveCurrentWeather
{
    public function handle(User $user): WeatherData|bool
    {
        $weather = new \Weather();
        return $weather->get($user->latitude, $user->longitude);
    }
}
