<?php

namespace App\Models\MongoDB;

use MongoDB\Laravel\Eloquent\Model;

class VehicleType extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'vehicleTypes';
}
