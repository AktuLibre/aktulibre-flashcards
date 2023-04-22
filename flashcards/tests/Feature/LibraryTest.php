<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Deck;
use Carbon\Carbon;

class LibraryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_library_succesful()
    {
        $user = User::factory()->create();
        $deck = new Deck();
        $deck->name = "Test deck";
        $deck->user()->associate($user);
        $deck->created_at = Carbon::now();
        $deck->save();

        $response = $this->actingAs($user)->getJson("/api/library");
        $response->assertStatus(200);
    }
}
