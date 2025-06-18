<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
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

        // Agar mijoz topilsa va uning paroli (bizning holatda telefon raqami) to'g'ri kelsa
        if ($customer && Hash::check($request->phone_number, $customer->password)) {

            // Eski tokenlarni o'chirish va yangisini yaratish
            $customer->tokens()->delete();
            $token = $customer->createToken('mobile-app-token')->plainTextToken;

            return response()->json([
                'message' => 'Muvaffaqiyatli kirildi',
                'token' => $token,
                'customer' => $customer // Ilovada mijoz ma'lumotlarini ko'rsatish uchun
            ]);
        }

        // Agar ma'lumotlar xato bo'lsa
        return response()->json([
            'message' => 'Pasport raqami yoki telefon raqami xato'
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Muvaffaqiyatli chiqildi']);
    }
}
