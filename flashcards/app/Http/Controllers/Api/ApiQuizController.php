<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deck;
use App\Models\DeckItem;

class ApiQuizController extends Controller
{
    /**
     * Returns a generated quiz for this user
     *
     * @param Request $request
     * @param Deck $deck
     * @return QuizDetailResource
     */
    public function get( Request $request, Deck $deck )
    {
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
