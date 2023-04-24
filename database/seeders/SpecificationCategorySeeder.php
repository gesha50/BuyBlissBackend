<?php

namespace Database\Seeders;

use App\Models\Specification;
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
        SpecificationCategory::factory()
            ->has(Specification::factory()->hasSpecificationValues(2)->count(3))
            ->count(5)->create();
    }
}
