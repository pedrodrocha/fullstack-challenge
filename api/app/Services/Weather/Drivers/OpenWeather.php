<?php

namespace App\Services\Weather\Drivers;

use Illuminate\Support\Fluent;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Services\Weather\WeatherData;

class OpenWeather extends Driver
{

    protected function process(array $location)
    {
        $url = $this->getUrl($location);

        return $this->getWeather($url);
    }

    protected function hydrate(WeatherData $weather, object $data)
    {
        $weather->lat = $data->coord->lat;
        $weather->long = $data->coord->lon;
        $weather->weather = $data->weather[0]->main ?? null;
        $weather->temp = $data->main->temp ?? null;
        $weather->temp_min = $data->main->temp_min ?? null;
        $weather->temp_max = $data->main->temp_max ?? null;
        $weather->pressure = $data->main->pressure ?? null;
        $weather->humidity = $data->main->humidity ?? null;
        $weather->sea_level = $data->main->sea_level ?? null;
        $weather->wind_speed = $data->wind->speed ?? null;
        $weather->wind_deg = $data->wind->deg ?? null;
        $weather->sunrise = $data->sys->sunrise ?? null;
        $weather->sunset = $data->sys->sunset ?? null;
        $weather->country = $data->sys->country ?? null;
        $weather->city = $data->name ?? null;

        return $weather;
    }

    /**
     *
     */
    protected function getUrl(array $location): string
    {
        $lat = round($location['lat'], 2);
        $long = round($location['long'], 2);

        $key = config('weather.connections')['open-weather']['key'];

        return "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$long&appid=$key";
    }

    protected function getWeather(string $url): bool|object
    {

        $response = Http::get($url);

        return $response->object();

    }
}
