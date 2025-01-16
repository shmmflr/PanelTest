<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherDevice extends Model
{
    use HasFactory;

    protected $fillable = ['serial', 'location', 'description'];

    public function data()
    {
        return $this->hasMany(WeatherData::class, 'device_id');
    }
}
