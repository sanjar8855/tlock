<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            // Agar so'rov admin paneliga tegishli bo'lsa (marshrut nomi 'admin.' bilan boshlansa)
            if ($request->routeIs('admin.*')) {
                // Xodimlar uchun login sahifasiga yo'naltirish
                return route('admin.login');
            }

            // Boshqa barcha holatlar uchun (kelajakda mijozlar kabineti uchun)
            // mijozlar login sahifasiga yo'naltirish
            return route('customer.login');
        }
    }
}
