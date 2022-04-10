<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShipmentCostControllerTest extends TestCase
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

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }

    public function testIndex()
    {
        $response = $this->get(route('shipment-cost.index'));

        $response->assertStatus(200);
        $response->assertViewIs('shipping_partners');
        $response->assertSee(__('Log of Shipment costs'));
    }
}
