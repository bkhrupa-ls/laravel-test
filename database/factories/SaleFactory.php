<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $quantity = rand(1, 10);
        $unitCost = $this->faker->randomFloat(2, 10, 100);

        return [
            'quantity' => $quantity,
            'unit_cost' => $unitCost,
            'selling_price' => Sale::calcSellingPrice($quantity, $unitCost)
        ];
    }
}
