<?php

namespace App\Services\Weather\Drivers;

abstract class Driver
{

    public function get(array $location)
    {
        $this->process($location);
    }

    abstract protected function process(array $location);

    abstract protected function hydrate();

}
