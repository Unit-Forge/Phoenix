<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FileAPITest extends TestCase
{
    use DatabaseMigrations;

    ///////////////////////////////// Files Tests
    /**
     * Tests getting all Files
     * @group api-files
     */
    public function testGetAllFiles()
    {

        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user2 = \Phoenix\Models\User::create(['email' => 'test2@fake.com','password'=>bcrypt('helloworld')]);

        // Lets create some models to test
        $file = $user->file()->create([
            'name' => 'TheElector',
            'first_name' => 'James',
            'last_name' => 'Wilco'
        ]);

        $file = $user->file()->create([
            'name' => 'TheMarco',
            'first_name' => 'Alex',
            'last_name' => 'Lima'
        ]);

        // Actual Test
        $this->json('GET','api/unit/files')->seeJson(['name'=> 'TheMarco']);

    }

    /**
     * Tests getting one Files
     * @group api-files
     */
    public function testGetFile()
    {
        $userTest = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);

        // Lets create some models to test
        $file = $userTest->file()->create([
            'name' => 'TheElector',
            'first_name' => 'James',
            'last_name' => 'Wilco'
        ]);

        // Actual Test
        $this->json('GET','api/unit/files/'.$file->id)->seeJson(['name'=> 'TheElector']);
    }

    /**
     * Tests creating a Files
     * @group api-files
     */
    public function testCreateFile()
    {
        // Seed Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Grant permission to user to make request
        $role = \Phoenix\Models\Auth\Role::whereName('records')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        $userTest = \Phoenix\Models\User::create(['email' => 'test2@fake.com','password'=>bcrypt('helloworld')]);
        $userTest->uuid = 'ec4bcb20-ab04-11e6-b0a4-33bff998e138';
        $userTest->save();

        // Actual Test
        $this->actingAs($user,'api')
            ->json('POST','api/unit/files', ['name'=> 'TheElector', 'user_uuid' => $userTest->uuid])
            ->seeJson(['name' => 'TheElector']);
    }

    /**
     * Tests deleting a File
     * @group api-files
     */
    public function testDeleteFile()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user and attach correct role
        $role = \Phoenix\Models\Auth\Role::whereName('records')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Lets create some models to test
        $userTest = \Phoenix\Models\User::create(['email' => 'test2@fake.com','password'=>bcrypt('helloworld')]);

        // Lets create some models to test
        $file = $userTest->file()->create([
            'name' => 'TheElector',
            'first_name' => 'James',
            'last_name' => 'Wilco'
        ]);

        // Ensure API sends back a correct code
        $this->actingAs($user,'api')->json('DELETE','api/unit/files/'.$file->id)->assertResponseStatus(204);
    }

    /**
     * Tests creating a files and expects a forbidden due to the roles
     * @group api-files
     */
    public function testForbiddenCreateFile()
    {
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $userTest = \Phoenix\Models\User::create(['email' => 'test2@fake.com','password'=>bcrypt('helloworld')]);


        // Actual Test
        $this->actingAs($user,'api')
            ->json('POST','api/unit/files', ['name'=> 'TheElector', 'user' => $userTest->uuid])
            ->assertResponseStatus('403');
    }

    /**
     * Tests creating a award as a guest, expects unauthorized
     * @group api-files
     */
    public function testUnauthorizedCreateFile()
    {
        $userTest = \Phoenix\Models\User::create(['email' => 'test2@fake.com','password'=>bcrypt('helloworld')]);
        $this->json('POST','api/unit/files', ['name'=> 'TheElector', 'user' => $userTest->uuid])
            ->assertResponseStatus('401');
    }
}
