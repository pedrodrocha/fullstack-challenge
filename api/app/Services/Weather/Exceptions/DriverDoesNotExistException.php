<?php

namespace App\Services\Weather\Exceptions;

class DriverDoesNotExistException extends WeatherException
{
    /**
     * Create a new exception for the non-existent driver.
     */
    public static function forDriver(string $driver): static
    {
        return new static(
            "The location driver [$driver] does not exist."
        );
    }
}
