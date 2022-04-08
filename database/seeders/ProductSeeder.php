<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProductSeeder extends Seeder
{
    public $products = [
        [
            'name' => 'Gold coffee',
            'code' => 'gold_coffee'
        ],
        [
            'name' => 'Arabic coffee',
            'code' => 'arabic_coffee'
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
