<?php

namespace App\Services\Weather\Drivers;

use App\Services\Weather\WeatherData;
use Illuminate\Support\Facades\Http;

class Weatherstack extends Driver
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
        $weather->weather = $data->current->weather_descriptions[0] ?? null;
        $weather->temp = $data->current->temperature ?? null;
        $weather->pressure = $data->current->pressure ?? null;
        $weather->humidity = $data->current->humidity ?? null;
        $weather->wind_speed = $data->current->wind_speed ?? null;
        $weather->wind_deg = $data->current->wind_degree ?? null;
        $weather->clouds = $data->current->cloudcover ?? null;
        $weather->country = $data->location->country ?? null;
        $weather->city = $data->location->name ?? null;

        return $weather;
    }

    /**
     *  Method for building an url for requesting Open Weather.
     */
    protected function getUrl(): string
    {
        $lat = round(floatval($this->location['lat']), 2);
        $long = round(floatval($this->location['long']), 2);

        $key = config('weather.weatherstack')['key'];

        return "http://api.weatherstack.com/current?access_key=$key&query=$lat,$long&units=m";
    }

    /**
     * Method for requesting Open Weather the weather for a location.
     */
    protected function getWeather(string $url): object
    {
        try {
            $response = Http::get($url);

            if ($response->successful()) {
                return $response->object();
            }
        } catch (\Exception $e) {
            return  (object) [];
        }

        return  (object) [];
    }
}
