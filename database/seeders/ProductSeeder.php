<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public $products = [
        [
            'name' => 'Gold coffee',
            'code' => Product::CODE_GOLD_COFFEE,
            'profit_margin' => Product::PROFIT_MARGIN_GOLD_COFFEE,
        ],
        [
            'name' => 'Arabic coffee',
            'code' => Product::CODE_ARABIC_COFFEE,
            'profit_margin' => Product::PROFIT_MARGIN_ARABIC_COFFEE,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->products as $product) {
            if (!Product::query()->where('code', $product['code'])->exists()) {
                Product::factory()->create($product);
            }
        }
    }
}
