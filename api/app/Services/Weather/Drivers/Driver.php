<?php

namespace App\Services\Weather\Drivers;
use Illuminate\Support\Fluent;
use App\Services\Weather\WeatherData;

abstract class Driver
{

    public function get(array $location): WeatherData
    {
        $data = $this->process($location);

        $weather = $this->makeWeather();

        $weather = $this->hydrate($weather, $data);

        return $weather;
    }

    /**
     * Create a new whether instance.
     */
    protected function makeWeather()
    {
        return app(config('weather.weather', WeatherData::class));
    }

    abstract protected function process(array $location);

    abstract protected function hydrate(WeatherData $weather, object $data);

}
