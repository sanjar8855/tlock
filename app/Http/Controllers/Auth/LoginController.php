<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Xodim uchun kirish formasini ko'rsatish.
     */
    public function showLoginForm()
    {
        // Matn o'rniga endi view faylini qaytaramiz
        return view('admin.auth.login');
    }

    /**
     * Xodimni autentifikatsiya qilish.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->filled('remember');

        // 'web' guardidan foydalanish
        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            // Muvaffaqiyatli kirsa admin panel bosh sahifasiga yo'naltirish
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Kiritilgan ma\'lumotlar mos kelmadi.',
        ])->onlyInput('email');
    }

    /**
     * Xodimni tizimdan chiqarish.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
