<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Tizimga kirgan xodimning kompaniyasini olish
        $companyId = Auth::user()->company_id;

        // Jami mijozlar soni
        // GlobalScope tufayli bu avtomatik tarzda faqat shu kompaniya uchun ishlaydi
        $totalCustomers = Customer::count();

        // Jami qurilmalar soni
        $totalDevices = Device::count();

        // Faol qurilmalar soni
        $activeDevices = Device::where('status', 'active')->count();

        // Bloklangan qurilmalar soni
        $lockedDevices = Device::where('status', 'locked')->count();

        // Barcha ma'lumotlarni view fayliga yuborish
        return view('admin.dashboard', compact(
            'totalCustomers',
            'totalDevices',
            'activeDevices',
            'lockedDevices'
        ));
    }
}
