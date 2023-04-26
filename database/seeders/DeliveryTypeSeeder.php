<?php

namespace Database\Seeders;

use App\Models\DeliveryType;
use Illuminate\Database\Seeder;

class DeliveryTypeSeeder extends Seeder
{
    public $deliveryTypeTitles = [
        'courier',
        'pickup',
        'post_russia',
        'sdek'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->deliveryTypeTitles as $paymentTypeTitle) {
            DeliveryType::create([
                'title' => $paymentTypeTitle,
                'is_main' => false
            ]);
        }
    }
}
