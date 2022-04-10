<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use App\Models\ShipmentCost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AjaxControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \App\Models\User
     */
    protected mixed $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }

    public function testActionCalcSellingPrice()
    {
        $this->post(route('ajax.sale.calc-selling-price'))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'selling_price' => 0
                ]
            ]);

        //
        ShipmentCost::factory()->create(['cost' => 10]);
        $product = Product::factory()->create(['profit_margin' => 10]);

        $this->post(
            route('ajax.sale.calc-selling-price'),
            [
                'product' => $product->id,
                'quantity' => 1,
                'unit_cost' => 10
            ]
        )
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'selling_price' => toMoney('11.21')->format()
                ]
            ]);
    }
}
