<?php

namespace Database\Seeders;

use App\Models\SpecificationCategory;
use Illuminate\Database\Seeder;

class SpecificationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpecificationCategory::factory()->count(5)->create();
    }
}
