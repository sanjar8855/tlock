<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;
use App\Models\Customer;

class DeviceSeeder extends Seeder
{
    public function run()
    {
        $customer1 = Customer::where('passport_number', 'AA1111111')->first();
        $customer2 = Customer::where('passport_number', 'BB2222222')->first();

        if ($customer1) {
            Device::create([
                'customer_id' => $customer1->id,
                'managed_by_company_id' => $customer1->company_id,
                'imei' => '111111111111111',
                'model_name' => 'Artel TV',
                'status' => 'active',
            ]);
        }

        if ($customer2) {
            Device::create([
                'customer_id' => $customer2->id,
                'managed_by_company_id' => $customer2->company_id,
                'imei' => '222222222222222',
                'model_name' => 'Samsung Galaxy',
                'status' => 'locked',
            ]);
        }
    }
}
