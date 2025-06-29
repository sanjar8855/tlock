<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Qurilmalarni o'zining egasi (customer) bilan birga olish (N+1 muammosini hal qiladi)
        $devices = Device::with('customer')->latest()->paginate(10);
        return view('admin.devices.index', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Formada tanlash uchun barcha mijozlar ro'yxatini olish
        $customers = Customer::orderBy('full_name')->get();
        return view('admin.devices.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ma'lumotlarni tekshirish
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'model_name' => 'required|string|max:255',
            'imei' => 'required|string|max:20|unique:devices,imei',
        ]);

        // Tizimga kirgan xodimning kompaniyasini olish
        $companyId = auth()->user()->company_id;

        $device = new \App\Models\Device();
        $device->customer_id = $validatedData['customer_id'];
        $device->model_name = $validatedData['model_name'];
        $device->imei = $validatedData['imei'];
        $device->status = 'active'; // Yangi qurilma har doim 'active' statusida bo'ladi
        $device->managed_by_company_id = $companyId; // Qurilmani shu kompaniya boshqaradi
        $device->save();

        return redirect()->route('admin.devices.index')->with('success', 'Qurilma muvaffaqiyatli qo\'shildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        // GlobalScope tufayli faqat o'z kompaniyasining qurilmasini ko'ra oladi
        // Qurilmaning joylashuv tarixini olish
        $locations = $device->locations()->paginate(15);

        return view('admin.devices.show', compact('device', 'locations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        // Formada tanlash uchun barcha mijozlar ro'yxatini olish
        $customers = Customer::orderBy('full_name')->get();
        return view('admin.devices.edit', compact('device', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Device $device)
    {
        // Ma'lumotlarni tekshirish (o'zini hisobga olmagan holda)
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'model_name' => 'required|string|max:255',
            'imei' => ['required', 'string', 'max:20', Rule::unique('devices')->ignore($device->id)],
        ]);

        // Qurilma ma'lumotlarini yangilash
        $device->update($validatedData);

        // Muvaffaqiyatli saqlangach, qurilmalar ro'yxatiga qaytish
        return redirect()->route('admin.devices.index')->with('success', 'Qurilma ma\'lumotlari muvaffaqiyatli yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        // Qurilmani o'chirish
        $device->delete();

        // Muvaffaqiyatli o'chirilgandan so'ng xabar bilan ro'yxatga qaytish
        return redirect()->route('admin.devices.index')->with('success', 'Qurilma muvaffaqiyatli o\'chirildi!');
    }

    /**
     * Qurilmaning statusini o'zgartirish.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Device $device)
    {
        // Hozirgi statusni tekshirib, uni teskarisiga o'zgartiramiz
        if ($device->status == 'active') {
            $device->status = 'locked';
            $message = 'Qurilma muvaffaqiyatli bloklandi.';
        } else {
            $device->status = 'active';
            $message = 'Qurilma muvaffaqiyatli aktivlashtirildi.';
        }

        // O'zgarishni ma'lumotlar bazasiga saqlash
        $device->save();

        // Muvaffaqiyatli xabar bilan orqaga qaytish
        return redirect()->route('admin.devices.index')->with('success', $message);
    }

    public function releaseDevice(Device $device)
    {
        // Faqat o'z kompaniyasi qurilmasini chiqara olishini tekshirish
        if (auth()->user()->company_id == $device->managed_by_company_id) {
            $device->managed_by_company_id = null;
            $device->save();
            return redirect()->route('admin.devices.index')->with('success', 'Qurilma shaxsiy boshqaruvga o\'tkazildi!');
        }

        return redirect()->route('admin.devices.index')->with('error', 'Bu amal uchun ruxsatingiz yo\'q!');
    }
}
