<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BasicAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthorized_user_cannot_post_to_endpoint(): void
    {
        $response = $this->postJson(route('transport.price'));

        $response->assertStatus(401);
    }

    public function test_authorized_user_can_post_to_endpoint(): void
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

        $response = $this->actingAs($user)->postJson(route('transport.price'), $postRequestData);

        $response->assertStatus(200);
    }
}
