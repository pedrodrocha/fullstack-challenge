<?php

namespace App\Services\Weather\Drivers;

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
    protected function makeWeather(): WeatherData
    {
        return app(config('weather.weather', WeatherData::class));
    }

    /**
     * Attempt to fetch and process the whether data from the driver.
     */
    abstract protected function process(array $location): object;

    /**
     * Hydrate the Weather data object with the given weather data.
     */
    abstract protected function hydrate(WeatherData $weather, object $data): WeatherData;
}
