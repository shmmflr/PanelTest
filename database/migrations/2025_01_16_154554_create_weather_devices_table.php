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
        Schema::create('weather_devices', function (Blueprint $table) {
            $table->id();
            $table->string('serial')->unique(); // سریال دستگاه
            $table->string('location')->nullable(); // مکان دستگاه
            $table->text('description')->nullable(); // توضیحات
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_devices');
    }
};
