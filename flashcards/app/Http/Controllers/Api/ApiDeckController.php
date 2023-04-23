<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Deck\Api\CreateDeck;
use App\Http\Resources\Deck\DeckResource;
use App\Models\Deck;
use App\Models\Flashcard;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ApiDeckController extends Controller
{
    /**
     * Get a list of decks for this registered user
     *
     * @param Request $request
     */
    public function index( Request $request ) 
    {
        
    }

    /**
     * Get deck by id
     *
     * @param Request $request
     * @param Deck $deck
     * @return App\Http\Resources\Deck\DeckDetailResource
     */
    public function get( Request $request, Deck $deck )
    {
        return new DeckResource( $deck );
    }

    public function create( CreateDeck $request )
    {
        $data = $request->validated();

        // Create deck
        $deck = new Deck();
        $deck->name = $data['name'];
        $deck->created_at = Carbon::now();
        $request->user()->decks()->save( $deck );

        // Now add this deck to user's library
        $request->user()
            ->getLibrary()
            ->decks()
            ->attach( $deck, [ 'created_at' => Carbon::now() ] );

        // Assign flashcards
        if ( isset( $data['cards'] ) ) 
        {
            foreach ( $data['cards'] as $card ) 
            {
                $deck->cards()->save( new Flashcard( $card ) );
            }
        }
        
        return new DeckResource( $deck );
    }
}
