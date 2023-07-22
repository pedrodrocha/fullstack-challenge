<?php

use Illuminate\Support\Str;

return [

    'connections' => [
        'open-weather' => [
            'key' => env('OPEN_WEATHER_API_KEY')
        ]
    ],

    'driver' => \App\Services\Weather\Drivers\OpenWeather::class,


];
