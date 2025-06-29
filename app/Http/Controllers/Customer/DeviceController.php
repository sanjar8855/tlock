<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    /**
     * Mijoz uchun yangi qurilma qo'shish formasini ko'rsatish.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('customer.devices.create');
    }

    /**
     * Yangi qurilmani ma'lumotlar bazasiga saqlash.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Ma'lumotlarni tekshirish (Validation)
        $validatedData = $request->validate([
            'model_name' => 'required|string|max:255',
            'imei' => 'required|string|max:20|unique:devices,imei',
        ]);

        // 2. Tizimga kirgan mijozni olish
        $customer = Auth::guard('customers')->user();

        // 3. Yangi qurilma obyektini yaratish
        $device = new Device();
        $device->customer_id = $customer->id; // Qurilmani shu mijozga bog'lash
        $device->model_name = $validatedData['model_name'];
        $device->imei = $validatedData['imei'];
        $device->status = 'active'; // Yangi qurilma har doim 'active' bo'ladi
        $device->managed_by_company_id = null; // Qurilma shaxsiy boshqaruvda

        // 4. Ma'lumotlar bazasiga saqlash
        $device->save();

        // 5. Muvaffaqiyatli saqlangach, shaxsiy kabinetga qaytish
        return redirect()->route('customer.dashboard')->with('success', 'Yangi qurilma muvaffaqiyatli qo\'shildi!');
    }

    public function show(Device $device)
    {
        // XAVFSIZLIK TEKSHIRUVI: Bu qurilma haqiqatan ham shu mijozniki ekanligini tekshirish
        if (Auth::guard('customers')->id() !== $device->customer_id) {
            abort(403, 'Bu amal uchun ruxsatingiz yo\'q');
        }

        // Qurilmaning joylashuv tarixini olish
        $locations = $device->locations()->paginate(10);

        return view('customer.devices.show', compact('device', 'locations'));
    }
}

