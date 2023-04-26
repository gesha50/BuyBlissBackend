<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\DeliveryType;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Status;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory()
            ->for(Status::where('id', 1)->first())
            ->for(PaymentType::where('id', 1)->first())
            ->for(DeliveryType::where('id', 1)->first())
            ->for(Address::factory())
            ->hasProducts(3)
            ->count(5)
            ->create();
    }
}
