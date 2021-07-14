<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//use Illuminate\Database\Eloquent\Model;

class Sensor extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'sensor';

    protected $fillable = [
        'temp',
        'hum',
        "chipID"
    ];
}
