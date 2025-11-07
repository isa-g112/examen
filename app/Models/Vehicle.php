<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';
    protected $primaryKey = 'idvehicle';

    protected $fillable = [
        'brand',
        'model',
        'year',
        'plate',
        'deliveries_iddelivery',
    ];

    public function getRouteKeyName()
    {
        return 'idvehicle';
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'deliveries_iddelivery', 'iddelivery');
    }
}
