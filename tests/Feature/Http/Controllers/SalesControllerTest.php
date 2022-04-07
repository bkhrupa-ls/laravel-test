<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
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

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }

    public function testIndex()
    {
        $response = $this->get(route('sales.index'));

        $response->assertStatus(200);
        $response->assertSee('Sales');
    }

    public function testStore()
    {
        $response = $this
            ->followingRedirects()
            ->post(
                route('sales.store'),
                [
                    'quantity' => 13,
                    'unit_cost' => 4.55
                ]
            );

        $response->assertStatus(200);
        $response->assertSee('88.87');

        $sale = new Sale();

        $this->assertDatabaseHas(
            $sale->getTable(),
            [
                'unit_cost' => 455,
                'selling_price' => 8887
            ]
        );
    }
}
