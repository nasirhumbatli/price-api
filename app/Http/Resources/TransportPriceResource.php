<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransportPriceResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'vehicle_type' => $this['vehicle_type'],
            'price' => $this['calculated_price'] > $this['minimum_price'] ? round($this['calculated_price'], 3) : "Price is less than minimum",
        ];
    }
}
