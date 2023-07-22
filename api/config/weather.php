<?php

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
        'key' => env('OPEN_WEATHER_API_KEY'),
    ],
    'weatherstack' => [
        'key' => env('WEATHERSTACK_API_KEY'),
    ],
    'api-ninjas' => [
        'key' => env('API_NINJAS_KEY'),
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
    | Driver Fallbacks
    |--------------------------------------------------------------------------
    |
    | The drivers you want to use to retrieve the user's whether
    | if the above selected driver is unavailable.
    |
    | These will be called upon in order (first to last).
    |
    */

    'fallbacks' => [
        \App\Services\Weather\Drivers\ApiNinjas::class,
        \App\Services\Weather\Drivers\Weatherstack::class,
    ],

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
