<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransportPriceTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_a_validation_error_on_an_array_containing_one_item(): void
    {
        $user = User::factory()->create();
        $postRequestData = [
            "addresses" => [
                [
                    "city" => "Düsseldorf",
                    "zip" => "40210",
                    "country" => "DE"
                ]
            ]
        ];

        $response = $this->actingAs($user)->postJson(route('transport.price'), $postRequestData);

        $response->assertStatus(422);
        $response->assertInvalid('addresses');
    }

    public function test_country_zip_and_city_combination_non_exists_in_database():void
    {
        $user = User::factory()->create();
        $postRequestData = [
            "addresses" => [
                [
                    "city" => "Düsseldorf-WRONG",
                    "zip" => "40210-000",
                    "country" => "DE-WRONG"
                ],
                [
                    "city" => "Dresden-WRONG",
                    "zip" => "01067-000",
                    "country" => "DE-WRONG"
                ]
            ]
        ];

        $response = $this->actingAs($user)->postJson(route('transport.price'), $postRequestData);

        $response->assertStatus(422);
        $response->assertInvalid([
            'addresses.0.city',
            'addresses.1.city',
            'addresses.0.zip',
            'addresses.1.zip',
            'addresses.0.country',
            'addresses.1.country',
        ]);
    }
}
