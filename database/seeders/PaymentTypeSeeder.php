<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    public $paymentTypeTitles = [
        'cash_upon_receipt',
        'online',
        'card_upon_receipt',
        'transfer_to_card'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->paymentTypeTitles as $paymentTypeTitle) {
            PaymentType::create([
                'title' => $paymentTypeTitle,
                'is_main' => false
            ]);
        }
    }
}
