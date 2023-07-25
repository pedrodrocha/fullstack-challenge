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
     * The loaded drivers.
     *
     * @var Driver[]
     */
    protected array $loaded = [];

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
    public function setDriver(Driver $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Set the default weather driver to use.
     */
    public function setDefaultDriver(): self
    {
        $defaultDriver = $this->getDefaultDriver();
        $this->loaded[] = $driver = $this->getDriver($defaultDriver);

        foreach ($this->getDriverFallbacks() as $fallback) {
            $driver->fallback($this->loaded[] = $this->getDriver($fallback));
        }

        return $this->setDriver($driver);
    }

    /**
     * Attempt to retrieve the weather of the user.
     */
    public function get(float $lat, float $long): WeatherData
    {
        $weather = $this->driver->get([
            'lat' => $lat,
            'long' => $long,
        ]);

        return $weather;
    }

    /**
     * Get the loaded driver instances.
     *
     * @return Driver[]
     */
    public function drivers(): array
    {
        return $this->loaded;
    }

    /**
     * Get the fallback location drivers to use.
     */
    protected function getDriverFallbacks(): array
    {
        return config('weather.fallbacks', []);
    }

    /**
     * Get the default weather driver.
     */
    protected function getDefaultDriver(): string
    {
        return config('weather.driver');
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
}
