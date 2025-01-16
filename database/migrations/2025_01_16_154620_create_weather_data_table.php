<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weather_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained('weather_devices')->onDelete('cascade'); // ارتباط با جدول دستگاه‌ها
            $table->float('temperature'); // دما
            $table->float('humidity'); // رطوبت
            $table->float('wind_speed')->nullable(); // سرعت باد
            $table->string('wind_direction')->nullable(); // جهت باد
            $table->float('pressure')->nullable(); // فشار هوا
            $table->float('rainfall')->nullable(); // بارش باران
            $table->boolean('repair')->default(0); // بارش باران
            $table->timestamp('recorded_at'); // زمان ثبت داده
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_data');
    }
};
