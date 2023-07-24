<?php

namespace App\Services\Weather\Drivers;

use App\Services\Weather\WeatherData;
use Illuminate\Support\Facades\Http;

class OpenWeather extends Driver
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
        $weather->lat = $data->coord->lat ?? round($this->location['lat'], 2);
        $weather->long = $data->coord->lon ?? round($this->location['long'], 2);
        $weather->weather = $data->weather[0]->main ?? null;
        $weather->temp = $data->main->temp ?? null;
        $weather->temp_min = $data->main->temp_min ?? null;
        $weather->temp_max = $data->main->temp_max ?? null;
        $weather->pressure = $data->main->pressure ?? null;
        $weather->humidity = $data->main->humidity ?? null;
        $weather->sea_level = $data->main->sea_level ?? null;
        $weather->wind_speed = $data->wind->speed ?? null;
        $weather->wind_deg = $data->wind->deg ?? null;
        $weather->wind_gust = $data->wind->gust ?? null;
        $weather->clouds = $data->clouds->all ?? null;
        $weather->sunrise = $data->sys->sunrise ?? null;
        $weather->sunset = $data->sys->sunset ?? null;
        $weather->country = $data->sys->country ?? null;
        $weather->city = $data->name ?? null;

        return $weather;
    }

    /**
     *  Method for building an url for requesting Open Weather.
     */
    protected function getUrl(): string
    {
        $lat = $this->location['lat'];
        $long = $this->location['long'];

        $key = config('weather.open-weather')['key'];

        return "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$long&appid=$key&units=metric";
    }

    /**
     * Method for requesting Open Weather the weather for a location.
     */
    protected function getWeather(string $url): object
    {
        $response = Http::get($url);

        if ($response->status() === 200) {
            return $response->object();
        }

        return  (object) [];
    }
}
