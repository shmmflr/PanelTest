<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherData extends Model
{
    use HasFactory;
    protected $fillable = [
        'device_id', 'temperature', 'humidity', 'wind_speed',
        'wind_direction', 'pressure', 'rainfall', 'recorded_at','repair'
    ];

    public function device()
    {
        return $this->belongsTo(WeatherDevice::class, 'device_id');
    }
}
