<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Deck;
use App\Models\Flashcard;
use App\Services\QuizGeneration\CardRaters\DefaultCardRater;
use App\Services\QuizGeneration\QuizGenerationService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class QuizGeneratorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_generates_quiz()
    {
        $generator = new QuizGenerationService( new DefaultCardRater() );
        $user = User::factory()->create();
        $deck = Deck::factory()->for( $user )
            ->has( Flashcard::factory()->count( 20 ), 'cards' )
            ->create();

        $quiz = $generator->generate_quiz( $deck, $user );

        $this->assertTrue( DB::table( 'quizzes' )->count() == 1, "Should insert quiz record into database" );
        $this->assertCount( 10, $quiz->items()->get(), "Quiz should contain 10 items" );
    }

    public function test_generates_small_quiz()
    {
        $generator = new QuizGenerationService( new DefaultCardRater() );
        $user = User::factory()->create();
        $deck = Deck::factory()->for( $user )
            ->has( Flashcard::factory()->count( 5 ), 'cards' ) // Does not have enough cards to make 10 card quiz
            ->create();

        $quiz = $generator->generate_quiz( $deck, $user );

        $this->assertTrue( DB::table( 'quizzes' )->count() == 1, "Should insert quiz record into database" );
        $this->assertCount( 5, $quiz->items()->get(), "Quiz should contain 5 items" );
    }

    public function test_retrieves_quiz()
    {
        $generator = new QuizGenerationService( new DefaultCardRater() );
        $user = User::factory()->create();
        $deck = Deck::factory()->for( $user )
            ->has( Flashcard::factory()->count( 5 ), 'cards' ) // Does not have enough cards to make 10 card quiz
            ->create();

        $quiz = $generator->generate_quiz( $deck, $user );
        $quiz_2 = $generator->get_or_generate( $deck, $user );

        $this->assertEquals( $quiz->id, $quiz_2->id, "Should retrieve existing quiz" );
    }

    public function test_generates_new_quiz_if_past_is_complete()
    {
        $generator = new QuizGenerationService( new DefaultCardRater() );
        $user = User::factory()->create();
        $deck = Deck::factory()->for( $user )
            ->has( Flashcard::factory()->count( 5 ), 'cards' ) // Does not have enough cards to make 10 card quiz
            ->create();

        $quiz = $generator->generate_quiz( $deck, $user );
        $quiz->date_taken = Carbon::now();
        $quiz->save();

        $quiz_2 = $generator->get_or_generate( $deck, $user );

        $this->assertNotEquals( $quiz->id, $quiz_2->id, "Should generate new quiz" );
    }
}
