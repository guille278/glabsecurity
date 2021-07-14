<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    
    protected $connection = 'mysql';
    
    protected $table = 'users';

    protected $fillable = [
        'nombre',
        'apellidoP',
        'apellidoM',
        'email',
        'password',
        'telefono',
        'direccion',
    ];

    protected $hidden = [
        'password'
    ];
}
