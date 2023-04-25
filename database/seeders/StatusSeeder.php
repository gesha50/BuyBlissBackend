<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public $statusTitles = [
        'no_status',
        'availability_check',
        'accepted',
        'in_transit',
        'completed',
        'cancel'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statusTitles as $statusTitle) {
            Status::create([
                'title' => $statusTitle
            ]);
        }
    }
}
