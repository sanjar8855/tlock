<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceLocation;
use Illuminate\Http\Request;
use App\Models\Device;

class DeviceController extends Controller
{
    /**
     * Qurilmaning joriy holatini va boshqaruv statusini tekshirish.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatus(Request $request)
    {
        // 1. So'rovdan kelgan IMEI ni tekshirish
        $request->validate(['imei' => 'required|string']);

        $device = Device::where('imei', $request->imei)->first();

        // 2. Agar qurilma topilmasa, xatolik qaytarish
        if (!$device) {
            return response()->json(['message' => 'Bunday IMEI raqamli qurilma topilmadi'], 404);
        }

        // 3. Token orqali kirgan mijoz shu qurilma egasi ekanligini tekshirish
        if ($request->user()->id !== $device->customer_id) {
            return response()->json(['message' => 'Bu qurilmani tekshirish uchun sizda ruxsat yo\'q'], 403);
        }

        // 4. Boshqaruv statusini aniqlash
        $managementStatus = $device->managed_by_company_id ? 'managed' : 'released';

        // 5. To'liq ma'lumotni JSON formatida qaytarish
        return response()->json([
            'imei' => $device->imei,
            'status' => $device->status,
            'management_status' => $managementStatus // <<< YANGI QO'SHILGAN MAYDON
        ]);
    }

    public function updateLocation(Request $request)
    {
        $validated = $request->validate([
            'imei' => 'required|string|exists:devices,imei',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
        ]);

        // Token orqali kirgan mijozni olish
        $customer = $request->user();

        // Qurilmani topish va u shu mijozga tegishli ekanligini tekshirish
        $device = Device::where('imei', $validated['imei'])
            ->where('customer_id', $customer->id)
            ->firstOrFail(); // Agar topilmasa yoki tegishli bo'lmasa, 404 xato beradi

        // Yangi joylashuvni bazaga saqlash
        DeviceLocation::create([
            'device_id' => $device->id,
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
        ]);

        return response()->json(['message' => 'Joylashuv muvaffaqiyatli saqlandi.']);
    }
}
