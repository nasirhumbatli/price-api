<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransportPriceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_returns_correct_price_list_for_all_vehicle_types(): void
    {
        $user = User::factory()->create();
        $postRequestData = [
            "addresses" => [
                [
                    "city" => "Düsseldorf",
                    "zip" => "40210",
                    "country" => "DE"
                ],
                [
                    "city" => "Dresden",
                    "zip" => "01067",
                    "country" => "DE"
                ]
            ]
        ];
        $correctResult = [
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


        $response = $this->actingAs($user)->postJson(route('transport.price'), $postRequestData);

        $response->assertStatus(200);
        $response->assertJson($correctResult);
    }

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
