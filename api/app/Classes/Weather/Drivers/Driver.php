<?php

namespace App\Classes\Weather\Drivers;

abstract class Driver
{

    public function get($lat, $long)
    {
        echo $lat;
        echo $long;
    }

    abstract protected function process();

}
