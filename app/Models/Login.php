<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Login extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table='login';

    protected $primaryKey='id';

    protected $fillable=[
        'account',
        'password',
        'name'
    ];

    public $timestamps=false;

}
