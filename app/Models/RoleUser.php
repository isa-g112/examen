<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    protected $table = 'roles_users';
    protected $primaryKey = 'idroles_users';

    protected $fillable = [
        'users_iduser',
        'roles_idrole',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_iduser', 'iduser');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'roles_idrole', 'idrole');
    }
}
