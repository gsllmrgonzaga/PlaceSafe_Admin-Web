<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;

    protected $fillable = [
        'locations_name','province_id','locations_latitude','locations_longitude',
    ];

    protected $table = 'locations';
}