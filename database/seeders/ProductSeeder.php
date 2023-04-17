<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\ColorCategory;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
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
            $product = Product::factory()
                ->hasProductCategories(3)
                ->hasPriceChanges(5)
                ->hasSizes(5)
                ->create();

            Size::factory()
                ->count(5)
                ->for($product)
                ->hasPriceChangeSizes(5)
                ->create();
        }
    }
}
