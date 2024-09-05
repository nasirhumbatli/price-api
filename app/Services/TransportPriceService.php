<?php

namespace App\Services;

use App\Models\MongoDB\VehicleType;

class TransportPriceService
{
    public static function calculatePriceForVehicleType(array $cities): array
    {
        $totalDistance = GoogleDirectionsApi::getTotalDistance($cities);
        $vehicleTypes = VehicleType::all();
        $vehicle_types_and_price_list = [];

        foreach ($vehicleTypes as $vehicleType) {

            $vehicle_types_and_price_list[] =
                [
                    'vehicle_type' => $vehicleType->number,
                    'calculated_price' => $vehicleType->cost_km * $totalDistance,
                    'minimum_price' => $vehicleType->minimum,
                ];
        }

        return $vehicle_types_and_price_list;
    }
}
