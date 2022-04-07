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
        $sale->unit_cost = 2054;
        $sale->selling_price = 6368;

        $this->assertSame(10, $sale->quantity);
        $this->assertSame('2054', $sale->unit_cost->getAmount());
        $this->assertSame('6368', $sale->selling_price->getAmount());
        $this->assertSame('63.68', $sale->selling_price->formatByDecimal());
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
     * @dataProvider dataSellingPrices
     */
    public function testCalcSellingPrice($quantity, $unitCost, $expectedSellingPrice)
    {
        $expectedSellingPrice = money($expectedSellingPrice);
        $unitCost = money($unitCost);

        $result = Sale::calcSellingPrice($quantity, $unitCost);

        $this->assertSame(
            $result->getAmount(),
            $expectedSellingPrice->getAmount()
        );
    }
}
