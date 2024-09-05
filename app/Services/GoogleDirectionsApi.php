<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleDirectionsApi
{
    private static function getDistance(string $origin, string $destination, string $waypoints)
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

        return $response->json();
    }

    public static function getTotalDistance($cities)
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

    public static function getDistanceWithOriginAndDestination(array $cities): array
    {
        $destinations = [];
        for ($i = 0; $i < count($cities) - 1; $i++) {
            $destinations[] = [
                'origin' => $cities[$i],
                'destination' => $cities[$i + 1],
                'distance' => $distance = self::getDistance($cities[$i], $cities[$i + 1]),
            ];
        }
        return $destinations;
    }
}
