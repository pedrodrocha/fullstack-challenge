<?php

namespace App\Services\Weather;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Fluent;

class WeatherData implements Arrayable
{
    public string $lat;

    public string $long;

    public ?string $weather;

    public ?string $temp;

    public ?string $temp_min;

    public ?string $temp_max;

    public ?string $pressure;

    public ?string $clouds;

    public ?string $humidity;

    public ?string $sea_level;

    public ?string $wind_speed;

    public ?string $wind_gust;

    public ?string $wind_deg;

    public ?string $sunrise;

    public ?string $sunset;

    public ?string $country;

    public ?string $city;

    /**
     * Get the instance as an array.
     */
    public function toArray(): Fluent
    {
        return new Fluent(get_object_vars($this));
    }
}
