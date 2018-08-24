<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    protected $table = 'administrator';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'work_number',
        'avatr',
        'login_count',
        'create_ip',
        'last_login_ip',
        'status'
    ];

    protected $hidden = [
        'password'
    ];
}
