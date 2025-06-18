<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /**
     * Mijoz uchun ro'yxatdan o'tish formasini ko'rsatish.
     */
    public function showRegistrationForm()
    {
        return view('customer.auth.register');
    }

    /**
     * Yangi mijozni ro'yxatdan o'tkazish.
     */
    public function register(Request $request)
    {
        // 1. Ma'lumotlarni tekshirish (Validation)
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'passport_number' => ['required', 'string', 'max:20', 'unique:customers'],
            'phone_number' => ['required', 'string', 'max:20', 'unique:customers'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 2. Yangi mijoz yaratish
        $customer = Customer::create([
            'full_name' => $request->full_name,
            'passport_number' => $request->passport_number,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // company_id bu yerda bo'sh (NULL) bo'ladi, chunki mijoz mustaqil ro'yxatdan o'tmoqda
        ]);

        // 3. Yangi mijoz haqida hodisa (event) e'lon qilish
        event(new Registered($customer));

        // 4. Yangi mijozni tizimga avtomatik kiritish
        Auth::guard('customers')->login($customer);

        // 5. Muvaffaqiyatli ro'yxatdan o'tgach, shaxsiy kabinetga yo'naltirish
        return redirect()->intended('/dashboard');
    }
}
