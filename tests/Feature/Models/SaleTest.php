<?php

namespace Tests\Feature\Models;

use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleTest extends TestCase
{

    use RefreshDatabase;

    public function testCast()
    {
        $sale = new Sale();

        $sale->quantity = 10.81;
        // will be rounded
        $sale->unit_cost = 20.5411;
        $sale->selling_price = 63.6798;

        $this->assertSame(10, $sale->quantity);
        $this->assertSame('20.54', $sale->unit_cost);
        $this->assertSame('63.68', $sale->selling_price);
    }

    public function dataSellingPrices(): array
    {
        return [
            [
                1,
                0,
                0
            ],
            [
                1,
                10,
                23.33
            ],
            [
                2,
                20.50,
                64.67
            ],
            [
                5,
                12.00,
                90.00
            ],
            [
                7,
                50.88,
                484.88
            ]
        ];
    }

    /**
     * @dataProvider dataSellingPrices
     */
    public function testCalcSellingPrice($quantity, $unitCost, $expectedSellingPrice)
    {
        $this->assertEquals(
            Sale::calcSellingPrice($quantity, $unitCost),
            $expectedSellingPrice
        );
    }
}
