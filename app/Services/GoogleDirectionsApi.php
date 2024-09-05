<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class GoogleDirectionsApi implements DirectionsApiInterface
{
    public function getDistance(string $origin, string $destination, string $waypoints): \Illuminate\Http\Client\Response
    {
        $response = Http::get(config('services.google_directions_api.url'), [
            'origin' => $origin,
            'destination' => $destination,
            'waypoints' => $waypoints,
            'key' => config('services.google_directions_api.key'),
        ]);

        if ($response['status'] !== "OK") {
            throw new \Exception("Error: {$response['status']}");
        }

        return $response;
    }

    public function getTotalDistance($cities): float
    {
        $origin = $cities[0];
        $countCities = count($cities);
        $destination = $cities[$countCities - 1];
        $prepareWaypoints = array_slice($cities, 1, $countCities - 2);
        $waypoints = implode('|', $prepareWaypoints);
        $data = self::getDistance($origin, $destination, $waypoints);
        $totalDistance = 0;

        foreach ($data['routes'][0]['legs'] as $leg) {
            $totalDistance += $leg['distance']['value'];  // Distance in meters
        }

        return $totalDistance / 1000;
    }
}
