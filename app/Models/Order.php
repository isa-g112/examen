<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'idorder';

    protected $fillable = [
        'date',
        'name_customer',
        'address',
        'phone',
        'status',
        'quantity',
        'products_idproduct',
        'services_idservice',
        'companies_idcompany',
        'users_iduser',
    ];

    public function getRouteKeyName()
    {
        return 'idorder';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_iduser', 'iduser');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'companies_idcompany', 'idcompany');
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
