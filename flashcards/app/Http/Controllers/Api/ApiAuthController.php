<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ApiLogin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class ApiAuthController extends Controller
{
    public function login( ApiLogin $request ) 
    {
        $creds = $request->validated();
        
        if ( !Auth::attempt( $creds ) )
        {
            $request->session()->regenerate();

            return response()->json([
                'message' => 'Incorrect email or password.'
            ], 401 );
        }

        $user = Auth::user();
        $user->last_login = Carbon::now();
        $user->save();

        return response()->json([
            'token' => $user->createToken( 'browser-token' )->plainTextToken,
        ]);
    }

    public function register( ApiLogin $request ) {
        $creds = $request->validated();
        
        if ( Auth::attempt( $creds ) )
        {
            $request->session()->regenerate();

            return response()->json([
                'message' => 'This user is already registered.'
            ], 401 );
        }

        $user = User::create([
            'name' => $request["email"], 
            'password' => $request["password"],
            'email' => $request["email"]
        ]);

        $user->is_admin = false;

        $user->save();
        
        return response()->json([
            'message' => "New user created"
        ], 200 );
    }
}
