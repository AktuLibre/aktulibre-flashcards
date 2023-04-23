<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Deck;
use Carbon\Carbon;

class QuizTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_request_should_be_successful()
    {
        $user = User::factory()->create();
        $deck = new Deck();
        $deck->name = "Testing deck";
        $deck->user()->associate( $user );
        $deck->created_at = Carbon::now();
        $deck->save();

        $response = $this->actingAs( $user )->getJson( "/api/decks/{$deck->id}/quiz" );
        $response->assertStatus(201);
    }
}
