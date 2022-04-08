<?php

namespace Tests\Feature\Models;

use App\Models\Product;
use App\Models\Sale;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        (new ProductSeeder())->call(ProductSeeder::class);
    }

    public function testCast()
    {
        $sale = new Sale();

        $sale->quantity = 10.81;
        $sale->unit_cost = 2054;
        $sale->selling_price = 6368;

        $this->assertSame(10, $sale->quantity);
        $this->assertSame('2054', $sale->unit_cost->getAmount());
        $this->assertSame('6368', $sale->selling_price->getAmount());
        $this->assertSame('63.68', $sale->selling_price->formatByDecimal());
    }

    public function dataGoldCoffeeSellingPrices(): array
    {
        return [
            [
                1,
                0,
                0
            ],
            [
                1,
                1000,
                2333
            ],
            [
                2,
                2050,
                6467
            ],
            [
                5,
                1200,
                9000
            ],
            [
                7,
                5088,
                48488
            ]
        ];
    }

    /**
     * @dataProvider dataGoldCoffeeSellingPrices
     */
    public function testGoldCoffeeCalcSellingPrice($quantity, $unitCost, $expectedSellingPrice)
    {
        $product = Product::query()
            ->where('code', Product::CODE_GOLD_COFFEE)
            ->first();
        $expectedSellingPrice = money($expectedSellingPrice);
        $unitCost = money($unitCost);

        $result = Sale::calcSellingPrice($quantity, $unitCost, $product);

        $this->assertSame(
            $result->getAmount(),
            $expectedSellingPrice->getAmount()
        );
    }

    public function dataArabicCoffeeSellingPrices(): array
    {
        return [
            [
                1,
                0,
                0
            ],
            [
                1,
                1000,
                2176
            ],
            [
                2,
                2050,
                5824
            ],
            [
                5,
                1200,
                8059
            ],
            [
                9,
                1380,
                15612
            ]
        ];
    }

    /**
     * @dataProvider dataArabicCoffeeSellingPrices
     */
    public function testArabicCoffeeCalcSellingPrice($quantity, $unitCost, $expectedSellingPrice)
    {
        $product = Product::query()
            ->where('code', Product::CODE_ARABIC_COFFEE)
            ->first();
        $expectedSellingPrice = money($expectedSellingPrice);
        $unitCost = money($unitCost);

        $result = Sale::calcSellingPrice($quantity, $unitCost, $product);

        $this->assertSame(
            $result->getAmount(),
            $expectedSellingPrice->getAmount()
        );
    }
}
