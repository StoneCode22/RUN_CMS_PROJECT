<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password'];

    public function getAuthIdentifierName()
    {
        return 'admin_id';
    }
}
