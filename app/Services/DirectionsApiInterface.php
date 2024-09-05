<?php

namespace App\Services;

interface DirectionsApiInterface
{
    public function getDistance(string $origin, string $destination, string $waypoints);
    public function getTotalDistance($cities);
}
