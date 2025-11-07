<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'idproduct';

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
        return 'idproduct';
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
        return $this->hasMany(Cart::class, 'products_idproduct', 'idproduct');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'products_idproduct', 'idproduct');
    }
}
