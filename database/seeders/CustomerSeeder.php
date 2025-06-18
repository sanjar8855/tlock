<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Company;
use Illuminate\Support\Facades\Hash; // <<< HASH QILISH UCHUN IMPORT QILING

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company1 = Company::where('name', 'Artel Market')->first();
        $company2 = Company::where('name', 'Texnomart')->first();

        if ($company1) {
            Customer::create([
                'company_id' => $company1->id,
                'full_name' => 'Aliev Vali',
                'passport_number' => 'AA1111111',
                'phone_number' => '+998901111111',
                'password' => Hash::make('+998901111111') // Telefon raqamini hashlab, parol sifatida saqlaymiz
            ]);
        }

        if ($company2) {
            Customer::create([
                'company_id' => $company2->id,
                'full_name' => 'Valiev Ali',
                'passport_number' => 'BB2222222',
                'phone_number' => '+998902222222',
                'password' => Hash::make('+998902222222')
            ]);
        }
    }
}
