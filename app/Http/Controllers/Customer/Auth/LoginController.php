<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Mijoz uchun kirish formasini ko'rsatish.
     */
    public function showLoginForm()
    {
        return view('customer.auth.login');
    }

    /**
     * Mijozni autentifikatsiya qilish.
     */
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Login maydoni email yoki pasport raqami ekanligini aniqlash
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'passport_number';

        // Kirishga urinish uchun ma'lumotlarni tayyorlash
        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        // Agar birinchi urinish (parol bilan) muvaffaqiyatsiz bo'lsa,
        // parolni telefon raqami sifatida tekshirish
        if (!Auth::guard('customers')->attempt($credentials)) {
            // Parol maydonini telefon raqami sifatida tekshirib ko'ramiz
            $customer = \App\Models\Customer::where($loginType, $request->login)->first();

            if ($customer && \Illuminate\Support\Facades\Hash::check($request->password, $customer->password)) {
                Auth::guard('customers')->login($customer);
            } else {
                // Agar ikkala urinish ham xato bo'lsa
                return back()->withErrors(['login' => 'Kiritilgan ma\'lumotlar mos kelmadi.'])->onlyInput('login');
            }
        }

        // Sessiyani yangilash va shaxsiy kabinetga yo'naltirish
        $request->session()->regenerate();
        return redirect()->intended('/dashboard'); // Keyinchalik bu manzilni yaratamiz
    }

    /**
     * Mijozni tizimdan chiqarish.
     */
    public function logout(Request $request)
    {
        Auth::guard('customers')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

