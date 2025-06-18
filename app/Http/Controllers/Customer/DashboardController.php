<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Device;

class DashboardController extends Controller
{
    /**
     * Mijozning shaxsiy kabinetini ko'rsatish.
     */
    public function index()
    {
        // Tizimga kirgan mijozni olish
        $customer = Auth::guard('customers')->user();

        // Mijozga tegishli qurilmalarni olish
        $devices = $customer->devices()->with('managingCompany')->get();

        return view('customer.dashboard', compact('customer', 'devices'));
    }

    /**
     * Mijoz o'z qurilmasining statusini o'zgartirishi.
     */
    public function changeDeviceStatus(Request $request, Device $device)
    {
        // 1. Bu qurilma haqiqatdan ham shu mijozniki ekanligini tekshirish
        if (Auth::guard('customers')->id() !== $device->customer_id) {
            return redirect()->back()->with('error', 'Bu amal uchun ruxsatingiz yo\'q!');
        }

        // 2. Bu qurilma shaxsiy boshqaruvda ekanligini tekshirish
        if ($device->managed_by_company_id !== null) {
            return redirect()->back()->with('error', 'Bu qurilma kompaniya boshqaruvida. Statusni o\'zgartira olmaysiz.');
        }

        // 3. Statusni o'zgartirish
        $device->status = ($device->status == 'active') ? 'locked' : 'active';
        $device->save();

        return redirect()->route('customer.dashboard')->with('success', 'Qurilma holati muvaffaqiyatli o\'zgartirildi!');
    }
}
