<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\DeliveryType;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->hasAddresses(3)->create();
    }
}
