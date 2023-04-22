<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deck;
use App\Models\DeckItem;
use App\Http\Resources\Quiz\QuizDetailResource;
use App\Services\QuizGeneration\QuizGenerationService;

class ApiQuizController extends Controller
{
    public function __construct(
        private QuizGenerationService $generator,
    ) {}

    /**
     * Returns a generated quiz for this user
     *
     * @param Request $request
     * @param Deck $deck
     * @return QuizDetailResource
     */
    public function get( Request $request, Deck $deck )
    {
        return new QuizDetailResource(
            $this->generator->get_or_generate( $deck, $request->user() )
        );

        return response( 200 );
    }

    /**
     * Endpoint to report whether or not quiz item was answered correctly
     *
     * @return void
     */
    public function report_quiz_item_progress( Request $request, DeckItem $deckItem )
    {
        
    }
}
