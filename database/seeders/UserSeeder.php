<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $company1 = Company::where('name', 'Artel Market')->first();
        $company2 = Company::where('name', 'Texnomart')->first();

        if ($company1) {
            User::create([
                'name' => 'Artel Admin',
                'email' => 'admin@artel.test',
                'password' => Hash::make('password'),
                'company_id' => $company1->id,
                'role' => 'owner'
            ]);
        }

        if ($company2) {
            User::create([
                'name' => 'Texnomart Admin',
                'email' => 'admin@texno.test',
                'password' => Hash::make('password'),
                'company_id' => $company2->id,
                'role' => 'owner'
            ]);
        }
    }
}
