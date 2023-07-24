<?php

namespace Tests\Feature;

use App\Services\Weather\Drivers\Driver;
use App\Services\Weather\Exceptions\DriverDoesNotExistException;
use App\Services\Weather\WeatherData;
use Mockery\MockInterface;
use Tests\TestCase;

class WeatherServiceTest extends TestCase
{
    public function test_can_return_weather_data(): void
    {
        $mock = $this->mock(\Weather::class, function (MockInterface $mock) {
            $mock->shouldReceive('get')->once()->andReturn(new WeatherData());
        });

        app(\Weather::class)->get(-54.3346, 51.2853);
    }

    public function test_can_fallback_to_other_drivers(): void
    {
        $fallback = $this->mock(Driver::class, function (MockInterface $mock) {
            $mock
                ->shouldAllowMockingProtectedMethods();
        });

        $driver = $this->mock(Driver::class, function (MockInterface $mock) {
            $mock
            ->makePartial()
            ->shouldReceive('get')->once()->andReturn(new WeatherData());
        });

        $driver->fallback($fallback);

        $weather = new \Weather();
        $weather->setDriver($driver);

        $this->assertInstanceOf(WeatherData::class, $weather->get(-54.3346, 51.2853));
    }

    public function test_throws_exception_when_default_driver_does_not_exists()
    {
        config(['weather.driver' => 'Test']);

        $this->expectException(DriverDoesNotExistException::class);
        app(\Weather::class)->get(-54.3346, 51.2853);
    }
}
