<?php

namespace App\Services\Weather\Drivers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class OpenWeather extends Driver
{

    protected function process(array $location)
    {
        $url = $this->getUrl($location);

        $this->getWeather($url);
        return true;
    }

    protected function hydrate()
    {
        return false;
    }

    /**
     *
     */
    protected function getUrl(array $location): string
    {
        $base = 'https://api.openweathermap.org/data/2.5/weather?';

        $lat = round($location['lat'], 2);
        $long = round($location['long'], 2);

        $key = config('weather.connections')['open-weather']['key'];

        $url =
            $base . "lat=$lat&" . "long=$long&" . "appid=$key&" . 'units=metric';

        return $url;
    }

    protected function getWeather(string $url):Response
    {

        $response = Http::get($url);

        return $response;

    }
}
