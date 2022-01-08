<?php

namespace Tests\Feature\Http\Controllers\User;

use Illuminate\Support\Carbon;
use Tests\ControllerTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatisticControllerTest extends ControllerTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs($this->product->user);
    }

    public function testResponse()
    {
        $response = $this->getJson(route('users.statistics', [
            'start_at' => Carbon::today()->subWeek()->format('Y-m-d'),
            'end_at' => Carbon::today()->addWeek()->format('Y-m-d')
        ]))->assertOk();

        $response->assertJsonStructure(['total_cost' => ['value']]);
    }
}
