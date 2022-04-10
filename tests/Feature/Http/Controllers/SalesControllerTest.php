<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Database\Seeders\ProductSeeder;
use Database\Seeders\ShipmentCostSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SalesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \App\Models\User
     */
    protected mixed $user;

    protected function setUp(): void
    {
        parent::setUp();

        (new ProductSeeder())->call(ProductSeeder::class);
        (new ProductSeeder())->call(ShipmentCostSeeder::class);

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }

    public function testIndex()
    {
        $response = $this->get(route('sales.index'));

        $response->assertStatus(200);
        $response->assertSee($this->user->name);
        $response->assertViewIs('coffee_sales');
    }

    public function testStore()
    {
        /** @var \App\Models\Product $product */
        $product = Product::query()
            ->where('code', Product::CODE_GOLD_COFFEE)
            ->first();

        $response = $this
            ->post(
                route('sales.store'),
                [
                    'quantity' => 13,
                    'unit_cost' => 4.55,
                    'product' => $product->id,
                ]
            );


        $response->assertStatus(302);

        $sale = new Sale();

        $this->assertDatabaseHas(
            $sale->getTable(),
            [
                'unit_cost' => 455,
                'selling_price' => 8887,
                'product_id' => $product->id,
            ]
        );
    }
}
