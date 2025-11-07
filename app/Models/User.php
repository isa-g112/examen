<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'iduser';

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'country',
        'phone',
    ];

    protected $hidden = ['password'];

    public function getRouteKeyName()
    {
        return 'iduser';
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users', 'users_iduser', 'roles_idrole');
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class, 'users_iduser', 'iduser');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'iduser', 'iduser');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'users_iduser', 'iduser');
    }

    public function companies()
    {
        return $this->hasMany(Company::class, 'users_iduser', 'iduser');
    }
}
