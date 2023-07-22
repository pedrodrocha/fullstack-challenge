<?php

use Illuminate\Support\Str;

return [

    'connections' => [
        'open-weather' => [
            'url' => env('OPEN_WEATHER_URL'),
            'key' => env('OPEN_WEATHER_API_KEY')
        ]
    ],

    'driver' => \App\Services\Weather\Drivers\OpenWeather::class,


];
