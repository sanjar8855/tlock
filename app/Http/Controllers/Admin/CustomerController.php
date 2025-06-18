<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hozircha barcha mijozlarni olamiz
        // Keyinchalik faqat o'z kompaniyasining mijozlarini olishni sozlaymiz
        $customers = Customer::latest()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Ma'lumotlarni tekshirish (Validation)
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'passport_number' => 'required|string|max:20|unique:customers,passport_number',
            'phone_number' => 'required|string|max:20|unique:customers,phone_number',
            'email' => 'nullable|email|max:255|unique:customers,email',
            'password' => 'nullable|string|min:8',
        ]);

        // 2. Tizimga kirgan xodimning kompaniyasini olish
        $companyId = auth()->user()->company_id;
        if (!$companyId) {
            // Agar biror sabab bilan xodim kompaniyaga biriktirilmagan bo'lsa
            return back()->withErrors(['error' => 'Siz hech qaysi kompaniyaga biriktirilmagansiz!'])->withInput();
        }

        // 3. Yangi mijoz obyektini yaratish
        $customer = new \App\Models\Customer();
        $customer->company_id = $companyId;
        $customer->full_name = $validatedData['full_name'];
        $customer->passport_number = $validatedData['passport_number'];
        $customer->phone_number = $validatedData['phone_number'];

        // Agar ixtiyoriy maydonlar to'ldirilgan bo'lsa
        if (!empty($validatedData['email'])) {
            $customer->email = $validatedData['email'];
        }
        if (!empty($validatedData['password'])) {
            $customer->password = \Illuminate\Support\Facades\Hash::make($validatedData['password']);
        }

        // 4. Ma'lumotlar bazasiga saqlash
        $customer->save();

        // 5. Muvaffaqiyatli saqlangach, mijozlar ro'yxatiga qaytish
        return redirect()->route('admin.customers.index')->with('success', 'Mijoz muvaffaqiyatli qo\'shildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $customer = \App\Models\Customer::findOrFail($id);

        // Ma'lumotlarni tekshirish (o'zini hisobga olmagan holda)
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'passport_number' => ['required', 'string', 'max:20', Rule::unique('customers')->ignore($customer->id)],
            'phone_number' => ['required', 'string', 'max:20', Rule::unique('customers')->ignore($customer->id)],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('customers')->ignore($customer->id)],
            'password' => 'nullable|string|min:8',
        ]);

        // Mijoz ma'lumotlarini yangilash
        $customer->full_name = $validatedData['full_name'];
        $customer->passport_number = $validatedData['passport_number'];
        $customer->phone_number = $validatedData['phone_number'];
        $customer->email = $validatedData['email'];

        // Agar yangi parol kiritilgan bo'lsa, uni hashlab yangilash
        if (!empty($validatedData['password'])) {
            $customer->password = \Illuminate\Support\Facades\Hash::make($validatedData['password']);
        }

        // Ma'lumotlar bazasiga saqlash
        $customer->save();

        // Muvaffaqiyatli saqlangach, mijozlar ro'yxatiga qaytish
        return redirect()->route('admin.customers.index')->with('success', 'Mijoz ma\'lumotlari muvaffaqiyatli yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Mijoz muvaffaqiyatli o\'chirildi!');
    }
}
