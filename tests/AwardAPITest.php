<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AwardAPITest extends TestCase
{
    use DatabaseMigrations;

    ///////////////////////////////// Awards Tests
    /**
     * Tests getting all Ranks
     * @group api-awards
     */
    public function testGetAllAwards()
    {
        // Lets create some models to test
        $awards = \Phoenix\Models\Unit\File\Award::create(['name' => 'Oscar']);
        $awards2 = \Phoenix\Models\Unit\File\Award::create(['name' => 'Academy Award']);

        // Actual Test
        $this->json('GET','api/unit/files/awards')->seeJson(['name'=> 'Academy Award']);
    }

    /**
     * Tests getting one Award
     * @group api-awards
     */
    public function testGetAward()
    {
        // Lets create some models to test
        $awards = \Phoenix\Models\Unit\File\Award::create(['name' => 'Oscar']);

        // Actual Test
        $this->json('GET','api/unit/files/awards/'.$awards->id)->seeJson(['name'=> 'Oscar']);
    }

    /**
     * Tests creating a Award
     * @group api-awards
     */
    public function testCreateAward()
    {
        // Seed Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Grant permission to user to make request
        $role = \Phoenix\Models\Auth\Role::whereName('records')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Make call to API and test
        $this->actingAs($user,'api')->json('POST', 'api/unit/files/awards',
            ['name' => 'Oscar', 'details'=> 'Details', 'link' => 'http://test.com'])
            ->seeJson(['name' => 'Oscar', 'details'=> 'Details', 'link' => 'http://test.com']);
    }

    /**
     * Tests deleting a award
     * @group api-awards
     */
    public function testDeleteAward()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user and attach correct role
        $role = \Phoenix\Models\Auth\Role::whereName('records')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Lets create some models to test
        $award = \Phoenix\Models\Unit\File\Award::create(['name' => 'Oscar']);

        // Ensure API sends back a correct code
        $this->actingAs($user,'api')->json('DELETE','api/unit/files/awards/'.$award->id)->assertResponseStatus(204);
    }

    /**
     * Tests creating a awards and expects a forbidden due to the roles
     * @group api-awards
     */
    public function testForbiddenCreateAward()
    {
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $this->actingAs($user,'api')->json('POST', 'api/unit/files/awards',
            ['name' => 'Oscar'])
            ->assertResponseStatus('403');
    }

    /**
     * Tests creating a award as a guest, expects unauthorized
     * @group api-awards
     */
    public function testUnauthorizedCreateAward()
    {
        $this->json('POST', 'api/unit/files/awards',
            ['name' => 'Oscar'])
            ->assertResponseStatus('401');
    }
}
