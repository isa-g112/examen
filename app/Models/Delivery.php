<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $table = 'deliveries';
    protected $primaryKey = 'iddelivery';

    protected $fillable = [
        'gender',
        'birth_day',
        'vehicle_type',
        'dni_document_front',
        'dni_document_back',
        'driving_license',
        'transit_license',
        'profile_photo',
        'users_iduser',
    ];

    public function getRouteKeyName()
    {
        return 'iddelivery';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_iduser', 'iduser');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'deliveries_iddelivery', 'iddelivery');
    }
}
