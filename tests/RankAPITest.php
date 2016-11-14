<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RankAPITest extends TestCase
{
    use DatabaseMigrations;

///////////////////////////////// Group Tests
    /**
     * Tests getting all Ranks
     * @group api-ranks
     */
    public function testGetAllRanks()
    {
        // Lets create some models to test
        $rank = \Phoenix\Models\Unit\Rank::create(['name' => 'Private', 'pay_grade'=> 'PV1', 'abbreviation' => 'PV1']);
        $rank2 = \Phoenix\Models\Unit\Rank::create(['name' => 'Private First Class', 'pay_grade'=> 'PV2', 'abbreviation' => 'PV2']);

        // Actual Test
        $this->json('GET','api/unit/ranks')->seeJson(['name'=> 'Private First Class']);
    }

    /**
     * Tests getting one Rank
     * @group api-ranks
     */
    public function testGetRank()
    {
        // Lets create some models to test
        $rank = \Phoenix\Models\Unit\Rank::create(['name' => 'Private', 'pay_grade'=> 'PV1', 'abbreviation' => 'PV1']);

        // Actual Test
        $this->json('GET','api/unit/ranks/'.$rank->id)->seeJson(['name'=> 'Private']);
    }

    /**
     * Tests creating a Rank
     * @group api-ranks
     */
    public function testCreateRank()
    {
        // Seed Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Grant permission to user to make request
        $role = \Phoenix\Models\Auth\Role::whereName('records')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Make call to API and test
        $this->actingAs($user,'api')->json('POST', 'api/unit/ranks',
            ['name' => 'Private', 'pay_grade'=> 'PV1', 'abbreviation' => 'PV1'])
            ->seeJson(['name' => 'Private', 'pay_grade'=> 'PV1', 'abbreviation' => 'PV1']);
    }

    /**
     * Tests deleting a rank
     * @group api-ranks
     */
    public function testDeleteRank()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user and attach correct role
        $role = \Phoenix\Models\Auth\Role::whereName('records')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Lets create some models to test
        $rank = \Phoenix\Models\Unit\Rank::create(['name' => 'Private', 'pay_grade'=> 'PV1', 'abbreviation' => 'PV1']);

        // Ensure API sends back a correct code
        $this->actingAs($user,'api')->json('DELETE','api/unit/ranks/'.$rank->id)->assertResponseStatus(204);
    }

    /**
     * Tests creating a rank and expects a forbidden due to the roles
     * @group api-ranks
     */
    public function testForbiddenCreateRank()
    {
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $this->actingAs($user,'api')->json('POST', 'api/unit/ranks',
            ['name' => 'Private', 'pay_grade'=> 'PV1', 'abbreviation' => 'PV1'])
            ->assertResponseStatus('403');
    }

    /**
     * Tests creating a rank as a guest, expects unauthorized
     * @group api-ranks
     */
    public function testUnauthorizedCreateRank()
    {
        $this->json('POST', 'api/unit/ranks',
            ['name' => 'Private', 'pay_grade'=> 'PV1', 'abbreviation' => 'PV1'])
            ->assertResponseStatus('401');
    }
}
