<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone|regex:/^09[0-9]{9}$/', // شماره تماس یونیک
            'username' => 'required|string|unique:users,username|min:6|regex:/^[A-Za-z0-9]+$/',
            'national_id' => 'nullable|string|unique:users,national_id|min:10|max:10', // شماره ملی یونیک
            'password' => 'required|string|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'username' => $request->username,
            'national_id' => $request->national_id??'',
            'password' => Hash::make($request->password),
        ]);
    
        $token = JWTAuth::fromUser($user);
    
        return response()->json(['token' => $token]);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username_or_phone' => 'required|string', // شماره همراه یا نام کاربری
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // پیدا کردن یوزر بر اساس نام کاربری یا شماره تماس
        $user = User::where('username', $request->username_or_phone)
            ->orWhere('phone', $request->username_or_phone)
            ->first();

        if (!$user) {
            return response()->json(['error' => 'کاربر یافت نشد'], 404);
        }

        // بررسی رمز عبور
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'رمز عبور نادرست است'], 401);
        }

        // ایجاد توکن
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'ورود موفقیت‌آمیز بود',
            'token' => $token,
        ]);
    }
}
