<?php

namespace App\Services\Weather\Drivers;

use App\Services\Weather\WeatherData;
use Illuminate\Support\Facades\Http;

class ApiNinjas extends Driver
{
    /**
     * Location with longitude and latitude
     *
     * @var array
     */
    protected $location;

    protected function process(array $location): object
    {
        $this->location = $location;
        $url = $this->getUrl();

        return $this->getWeather($url);
    }

    protected function hydrate(WeatherData $weather, object $data): WeatherData
    {
        $weather->lat = round($this->location['lat'], 2);
        $weather->long = round($this->location['long'], 2);
        $weather->temp = $data->temp ?? null;
        $weather->temp_min = $data->min_temp ?? null;
        $weather->temp_max = $data->max_temp ?? null;
        $weather->humidity = $data->humidity ?? null;
        $weather->wind_speed = $data->wind_speed ?? null;
        $weather->wind_deg = $data->wind_degrees ?? null;
        $weather->clouds = $data->cloud_pct ?? null;
        $weather->sunrise = $data->sunrise ?? null;
        $weather->sunset = $data->sunset ?? null;

        return $weather;
    }

    /**
     *  Method for building an url for requesting Open Weather.
     */
    protected function getUrl(): string
    {
        $lat = round($this->location['lat'], 2);
        $long = round($this->location['long'], 2);

        return "https://api.api-ninjas.com/v1/weather?lat=$lat&lon=$long";
    }

    /**
     * Method for requesting Open Weather the weather for a location.
     */
    protected function getWeather(string $url): object
    {
        $response = Http::withHeaders([
            'X-Api-Key' => config('weather.api-ninjas')['key'],
        ])->get($url);

        if ($response->status() === 200) {
            return $response->object();
        }

        return  (object) [];
    }
}
