<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\ColorCategory;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $max = 10;
        for($c=1; $c<=$max; $c++) {
            Color::factory()
                ->count(4)
                ->hasProducts(3)
                ->hasPriceChangeColors(4)
                ->create();
        }
    }
}
