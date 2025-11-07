<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $primaryKey = 'idcart';

    protected $fillable = [
        'iduser',
        'products_idproduct',
        'services_idservice',
    ];

    public function getRouteKeyName()
    {
        return 'idcart';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_idproduct', 'idproduct');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'services_idservice', 'idservice');
    }
}
