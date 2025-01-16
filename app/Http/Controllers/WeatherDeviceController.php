<?php

namespace App\Http\Controllers;

use App\Models\WeatherDevice;
use Illuminate\Http\Request;

class WeatherDeviceController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'serial' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
        ]);

        $data = WeatherDevice::create([
            'serial' => 'DEVICE-005521',
            'location' => 'Kiasar ,Sari ,Mazandaran, Iran',
            'description' => 'سدتگاه مدل 2098',
        ]);

        return response()->json([
            'data' => [
                'message' => 'دستگاه با موفقیت تعریف شد',
                'data' => $data,
            ],
            'status' => 'success',
        ], 201);
    }

    public function show($deviceId)
    {
        $device = WeatherDevice::with('data')->find($deviceId);

        if (!$device) {
            return response()->json(['error' => 'دستگاهی با این مشخصات یافت نشد!'], 404);
        }

        return response()->json([
            'data' => [
                'message' => 'اطلاعات با موفقیت دریافت شد.',
                'device' => $device,
                'device_data' => $device->data,
            ],
            'status' => 'success',
        ], 200);
    }
}
