<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $primaryKey = 'idservice';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'categories_idcategory',
        'companies_idcompany',
    ];

    public function getRouteKeyName()
    {
        return 'idservice';
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_idcategory', 'idcategory');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'companies_idcompany', 'idcompany');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'services_idservice', 'idservice');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'services_idservice', 'idservice');
    }
}
