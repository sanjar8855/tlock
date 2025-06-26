<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Device;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'passport_number' => 'required|string',
            'phone_number' => 'required|string',
        ]);

        // Mijozni pasport raqami bo'yicha topish
        $customer = Customer::where('passport_number', $request->passport_number)->first();

        // Agar mijoz topilsa va paroli (telefon raqami) to'g'ri kelsa
        if ($customer && Hash::check($request->phone_number, $customer->password)) {
            // Darhol doimiy, asosiy Sanctum tokenini yaratamiz
            $token = $customer->createToken('device-login-token')->plainTextToken;

            // Mobil ilovaga tokenni va mijozning qurilmalar ro'yxatini yuboramiz
            // Bu bilan ilova qaysi IMEI ni tekshirishni biladi
            return response()->json([
                'message' => 'Shaxs tasdiqlandi. Endi qurilmangizni tasdiqlang.',
                'token' => $token,
                'customer' => $customer,
                'user_devices' => $customer->devices()->pluck('imei') // Mijozning barcha IMEI raqamlari
            ]);
        }

        return response()->json(['message' => 'Pasport raqami yoki telefon raqami xato'], 401);
    }

    public function verifyDevice(Request $request)
    {
        $request->validate(['imei' => 'required|string']);

        // Token orqali kirgan mijozni olish (chunki bu marshrut 'auth:sanctum' bilan himoyalangan)
        $customer = $request->user();

        // Qurilmani tekshirish
        $deviceExists = $customer->devices()->where('imei', $request->imei)->exists();

        if ($deviceExists) {
            return response()->json(['message' => true]);
        }

        return response()->json(['message' => false], 403);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Muvaffaqiyatli chiqildi']);
    }
}
