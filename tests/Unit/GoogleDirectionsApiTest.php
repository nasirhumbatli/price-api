<?php

namespace Tests\Unit;

use App\Http\Resources\TransportPriceCollection;
use App\Http\Resources\TransportPriceResource;
use App\Services\TransportPriceService;
use Tests\TestCase;
use App\Services\GoogleDirectionsApi;

class GoogleDirectionsApiTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_calculate_price_for_vehicle_type()
    {
        $cities = [
            'Düsseldorf',
            'Dresden',
        ];

        $correctResponse = [
            [
                "vehicle_type" => 5,
                "price" => 145.021
            ],
            [
                "vehicle_type" => 14,
                "price" => 197.228
            ],
            [
                "vehicle_type" => 13,
                "price" => 290.042
            ],
            [
                "vehicle_type" => 9,
                "price" => "Price is less than minimum"
            ],
            [
                "vehicle_type" => 0,
                "price" => 140.96
            ],
            [
                "vehicle_type" => 8,
                "price" => "Price is less than minimum"
            ],
            [
                "vehicle_type" => 6,
                "price" => "Price is less than minimum"
            ],
            [
                "vehicle_type" => 4,
                "price" => "Price is less than minimum"
            ],
            [
                "vehicle_type" => 10,
                "price" => "Price is less than minimum"
            ],
            [
                "vehicle_type" => 12,
                "price" => 140.96
            ],
            [
                "vehicle_type" => 16,
                "price" => "Price is less than minimum"
            ],
            [
                "vehicle_type" => 7,
                "price" => "Price is less than minimum"
            ],
            [
                "vehicle_type" => 11,
                "price" => 140.96
            ],
            [
                "vehicle_type" => 15,
                "price" => "Price is less than minimum"
            ],
            [
                "vehicle_type" => 17,
                "price" => "Price is less than minimum"
            ],
            [
                "vehicle_type" => 2,
                "price" => "Price is less than minimum"
            ],
            [
                "vehicle_type" => 3,
                "price" => "Price is less than minimum"
            ],
            [
                "vehicle_type" => 1,
                "price" => "Price is less than minimum"
            ]
        ];

        $list = (new TransportPriceService(new GoogleDirectionsApi()))->calculatePriceForVehicleType($cities);
        $data = new TransportPriceCollection($list);
        $this->assertEquals($data->toJson(), json_encode($correctResponse));
    }
}
