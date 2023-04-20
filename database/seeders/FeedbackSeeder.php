<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\Product;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::factory()->create();
        Feedback::factory()
            ->for($product)
            ->count(5)
            ->create();
    }
}
