<?php

namespace Tests\Feature\Http\Controllers;

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
    }

    public function testIndex()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('sales.index'));

        $response->assertStatus(200);
        $response->assertSee('Sales');
    }
}
