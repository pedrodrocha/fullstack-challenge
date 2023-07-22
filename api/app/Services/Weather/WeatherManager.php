<?php

namespace App\Services\Weather;

use App\Services\Weather\Drivers\Driver;
use App\Services\Weather\Exceptions\DriverDoesNotExistException;

class WeatherManager
{
    /**
     * The current driver.
     */
    protected Driver $driver;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->setDefaultDriver();
    }

    /**
     * Set the current driver to use.
     */
    public function setDriver(Driver $driver): static
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Set the default weather driver to use.
     */
    public function setDefaultDriver(): static
    {
        $driver = $this->getDriver($this->getDefaultDriver());

        return $this->setDriver($driver);
    }

    /**
     * Attempt to create the weather driver.
     */
    protected function getDriver(string $driver): Driver
    {
        if (! class_exists($driver)) {
            throw DriverDoesNotExistException::forDriver($driver);
        }

        return app($driver);
    }

    /**
     * Get the default weather driver.
     */
    protected function getDefaultDriver(): string
    {
        return config('weather.driver');
    }

    /**
     * Attempt to retrieve the weather of the user.
     */
    public function get(float $lat, float $long)
    {
        $weather = $this->driver->get([
            'lat' => $lat,
            'long' => $long,
        ]);

        return $weather;
    }
}
