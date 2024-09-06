<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\GoogleDirectionsApi;

class GoogleDirectionsApiTest extends TestCase
{
    public function test_get_distance_by_using_google_directions_api()
    {
        $cities = [
            'Düsseldorf',
            'Dresden',
        ];

        $googleDirectionsApi = new GoogleDirectionsApi();
        $response =  $googleDirectionsApi->getDistance("Düsseldorf", "Dresden");

        $this->assertEquals($response['status'], "OK");
    }
}
