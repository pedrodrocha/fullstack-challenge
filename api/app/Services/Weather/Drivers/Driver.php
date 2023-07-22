<?php

namespace App\Services\Weather\Drivers;

use App\Services\Weather\WeatherData;

abstract class Driver
{
    /**
     * The fallback driver.
     */
    protected ?Driver $fallback = null;

    /**
     * Append a fallback driver to the end of the chain.
     */
    public function fallback(Driver $handler): void
    {
        if (is_null($this->fallback)) {
            $this->fallback = $handler;
        } else {
            $this->fallback->fallback($handler);
        }
    }

    public function get(array $location): bool|WeatherData
    {
        $data = $this->process($location);

        if ((array) $data !== []) {
            $weather = $this->makeWeather();

            return $this->hydrate($weather, $data);
        }

        return $this->fallback ? $this->fallback->get($location) : false;
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

    /**
     * Determine if the given fluent data is not empty.
     */
    protected function isEmpty(object $data): bool
    {
        return empty(array_filter($data->getAttributes()));
    }
}
