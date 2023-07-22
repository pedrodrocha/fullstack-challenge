<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Weather Providers.
    |
    */

    'open-weather' => [
        'key' => env('OPEN_WEATHER_API_KEY')
    ],

    /*
    |--------------------------------------------------------------------------
    | Driver
    |--------------------------------------------------------------------------
    |
    | The default driver you would like to use for weather retrieval.
    |
    */
    'driver' => \App\Services\Weather\Drivers\OpenWeather::class,

    /*
    |--------------------------------------------------------------------------
    | Weather Data
    |--------------------------------------------------------------------------
    |
    | Here you may configure the weather data instance that is created
    | and returned from the above drivers. The instance you
    | create must extend the built-in Weather Data class.
    |
    */
    'data' => \App\Services\Weather\WeatherData::class,


];
