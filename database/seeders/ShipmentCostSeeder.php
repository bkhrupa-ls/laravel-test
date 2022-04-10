<?php

namespace Database\Seeders;

use App\Models\ShipmentCost;
use Illuminate\Database\Seeder;

class ShipmentCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cost = 1000;

        if (!ShipmentCost::query()->where('cost', $cost)->exists()) {
            ShipmentCost::factory()->create(['cost' => 1000]); // 10.00
        }
    }
}
