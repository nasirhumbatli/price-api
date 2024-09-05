<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddressesRequest;
use App\Http\Resources\TransportPriceCollection;
use App\Services\TransportPriceService;
use Illuminate\Http\Resources\Json\JsonResource;

class TransportPriceController extends Controller
{
    public function getVehicleTypeAndPriceList(AddressesRequest $request): JsonResource
    {
       $list = TransportPriceService::calculatePriceForVehicleType($request->validated('addresses.*.city'));

       return new TransportPriceCollection($list);
    }
}
