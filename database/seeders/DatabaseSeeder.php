<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\WeatherData;
use App\Models\WeatherDevice;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ایجاد دستگاه نمونه
        $device = WeatherDevice::create([
            'serial' => 'DEVICE-123456',
            'location' => 'Tehran, Iran',
            'description' => 'A sample weather monitoring device.',
        ]);

        // تولید 100 داده فیک برای دستگاه
        for ($i = 0; $i < 100; $i++) {
            WeatherData::create([
                'device_id' => $device->id,
                'temperature' => rand(-10, 40) + (rand(0, 100) / 100), // دمای تصادفی
                'humidity' => rand(0, 100), // رطوبت تصادفی
                'wind_speed' => rand(0, 20) + (rand(0, 100) / 100), // سرعت باد تصادفی
                'wind_direction' => ['N', 'E', 'S', 'W'][rand(0, 3)], // جهت باد تصادفی
                'pressure' => rand(900, 1100) + (rand(0, 100) / 100), // فشار هوا تصادفی
                'rainfall' => rand(0, 50) + (rand(0, 100) / 100), // میزان بارش تصادفی
                'recorded_at' => Carbon::now()->subMinutes($i), // زمان ثبت داده
            ]);
        }
    }
}
