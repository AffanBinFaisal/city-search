<?php

namespace App\Models;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    protected $collection = 'cities';
    protected $fillable = ['locId','country','region','city','postalCode','latitude','longitude','metroCode','areaCode'];
    protected $connection = 'mongodb';
}
