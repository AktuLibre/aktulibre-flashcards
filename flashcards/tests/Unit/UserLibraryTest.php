<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class UserLibraryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_shouldCreateLibrary()
    {
        $user = new User([ 'email' => 'test@test.com', 'name' => 'Test', 'is_admin' => false, 'password' => 'admin'  ]);
        $user->save();

        $user->createLibrary();
        
        $this->assertTrue( 
            DB::table( 'libraries' )->where( 'user_id', $user->id )->count() == 1
        );
    }
}