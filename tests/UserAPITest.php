<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class UserAPITest
 */
class UserAPITest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Tests getting all users
     */
    public function testGetAllUsers()
    {
        $user1 = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user2 = \Phoenix\Models\User::create(['email' => 'test2@fake.com','password'=>bcrypt('helloworld')]);
        $this->json('GET','api/users')->seeJson(['email'=> 'test2@fake.com']);
    }

    /**
     * Tests creating a new user
     */
    public function testNewUser()
    {
        $this->json('POST', 'api/users', ['email' => 'test@test.com', 'password' => bcrypt('test1234')])
            ->seeJson([
                'email' => 'test@test.com',
            ]);
    }
}
