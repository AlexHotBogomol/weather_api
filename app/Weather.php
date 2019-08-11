<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $fillable = ['city', 'temperature', 'humidity', 'wind_speed', 'pressure'];
    public $timestamps = false;
    public function getCityAttribute($value)
    {
        return ucfirst($value);
    }
}
