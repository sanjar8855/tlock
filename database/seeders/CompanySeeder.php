<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run()
    {
        Company::create([
            'name' => 'Artel Market',
            'address' => 'Tashkent, Uzbekistan',
            'phone' => '+998712000001'
        ]);

        Company::create([
            'name' => 'Texnomart',
            'address' => 'Samarkand, Uzbekistan',
            'phone' => '+998712000002'
        ]);
    }
}
