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


    public function testNewUser()
    {
        $this->json('POST', 'api/users', ['email' => 'test@test.com', 'password' => bcrypt('test1234')])
            ->seeJson([
                'email' => 'test@test.com',
            ]);
    }

    /**
     * Tests creating a new teamspeak as a regular user
     * @group api-users-teamspeak
     */
    public function testNewTeamspeak()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->uuid = 'ec4bcb20-ab04-11e6-b0a4-33bff998e138';
        $user->save();

        $this->actingAs($user,'api')->json('POST', 'api/user/teamspeak', ['uuid' => 'number1', 'description' => 'Home Computer', 'user_uuid' => 'ec4bcb20-ab04-11e6-b0a4-33bff998e138'])
            ->seeJson([
                'uuid' => 'number1',
            ]);
    }

    /**
     * Tests creating a new teamspeak with super admin role
     * @group api-users-teamspeak
     */
    public function testNewTeamspeakSuperAdmin()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Grant permission to user to make request
        $role = \Phoenix\Models\Auth\Role::whereName('superadmin')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Create user test
        $userTest = \Phoenix\Models\User::create(['email' => 'test2@fake.com','password'=>bcrypt('helloworld')]);
        $userTest->uuid = 'ec4bcb20-ab04-11e6-b0a4-33bff998e138';
        $userTest->save();

        $this->actingAs($user,'api')->json('POST', 'api/user/teamspeak', ['uuid' => 'number1', 'description' => 'Home Computer', 'user_uuid' => 'ec4bcb20-ab04-11e6-b0a4-33bff998e138'])
            ->seeJson([
                'uuid' => 'number1',
            ]);
    }

    /**
     * Tests creating a new teamspeak with a mismatching user uuid
     * @group api-users-teamspeak
     */
    public function testNewTeamspeakWrongUser()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Grant permission to user to make request
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);

        // Create user test
        $userTest = \Phoenix\Models\User::create(['email' => 'test2@fake.com','password'=>bcrypt('helloworld')]);
        $userTest->uuid = 'ec4bcb20-ab04-11e6-b0a4-33bff998e138';
        $userTest->save();

        $this->actingAs($user,'api')->json('POST', 'api/user/teamspeak', ['uuid' => 'number1', 'description' => 'Home Computer', 'user_uuid' => 'ec4bcb20-ab04-11e6-b0a4-33bff998e138'])
            ->assertResponseStatus(403);
    }

    /**
     * Tests removing a new teamspeak as a regular user
     * @group api-users-teamspeak-new
     */
    public function testRemoveTeamspeak()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->uuid = 'ec4bcb20-ab04-11e6-b0a4-33bff998e138';
        $user->save();

        $teamspeak = $user->teamspeak()->create(['uuid' => 'number1', 'description' => 'Home Computer']);

        $this->actingAs($user,'api')->json('DELETE', 'api/user/teamspeak/'.$teamspeak->id)
            ->assertResponseStatus(204);
    }

    /**
     * Tests removing a new teamspeak as a super admin
     * @group api-users-teamspeak-new
     */
    public function testRemoveTeamspeakSuperAdmin()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Grant permission to user to make request
        $role = \Phoenix\Models\Auth\Role::whereName('superadmin')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Create user test
        $userTest = \Phoenix\Models\User::create(['email' => 'test2@fake.com','password'=>bcrypt('helloworld')]);
        $userTest->uuid = 'ec4bcb20-ab04-11e6-b0a4-33bff998e138';
        $userTest->save();

        $teamspeak = $userTest->teamspeak()->create(['uuid' => 'number1', 'description' => 'Home Computer']);

        $this->actingAs($user,'api')->json('DELETE', 'api/user/teamspeak/'.$teamspeak->id)
            ->assertResponseStatus(204);
    }

    /**
     * Tests removing a new teamspeak as the wrong user
     * @group api-users-teamspeak-new
     */
    public function testRemoveTeamspeakWrongUser()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Grant permission to user to make request
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);

        // Create user test
        $userTest = \Phoenix\Models\User::create(['email' => 'test2@fake.com','password'=>bcrypt('helloworld')]);
        $userTest->uuid = 'ec4bcb20-ab04-11e6-b0a4-33bff998e138';
        $userTest->save();

        $teamspeak = $userTest->teamspeak()->create(['uuid' => 'number1', 'description' => 'Home Computer']);

        $this->actingAs($user,'api')->json('DELETE', 'api/user/teamspeak/'.$teamspeak->id)
            ->assertResponseStatus(403);
    }
}
