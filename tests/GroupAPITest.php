<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupAPITest extends TestCase
{
    use DatabaseMigrations;

    ///////////////////////////////// Group Tests
    /**
     * Tests getting all groups
     * @group api-groups
     */
    public function testGetAllGroups()
    {
        // Lets create some models to test
        $group = \Phoenix\Models\Unit\Group\Group::create(['name' => '1st Company', 'order'=> 1]);
        $group2 = \Phoenix\Models\Unit\Group\Group::create(['name' => '2nd Company', 'order'=> 2]);

        // Actual Test
        $this->json('GET','api/unit/groups')->seeJson(['name'=> '2nd Company']);
    }

    /**
     * Tests getting one groups
     * @group api-groups
     */
    public function testGetGroup()
    {
        // Lets create some models to test
        $group = \Phoenix\Models\Unit\Group\Group::create(['name' => 'Aviation Group', 'order'=> 1]);

        // Actual Test
        $this->json('GET','api/unit/groups/'.$group->id)->seeJson(['name'=> 'Aviation Group']);
    }

    /**
     * Tests creating a group
     * @group api-groups
     */
    public function testCreateGroup()
    {
        // Seed Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Grant permission to user to make request
        $role = \Phoenix\Models\Auth\Role::whereName('records')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Make call to API and test
        $this->actingAs($user,'api')->json('POST', 'api/unit/groups',
            [
                'name' => 'Special Forces Group',
                'order' => 5
            ])
            ->seeJson(
                [
                    'name' => 'Special Forces Group',
                    'order' => 5,
                ]);
    }

    /**
     * Tests deleting a group
     * @group api-groups
     */
    public function testDeleteGroup()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user and attach correct role
        $role = \Phoenix\Models\Auth\Role::whereName('recordsphpunit')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Lets create some models to test
        $group = \Phoenix\Models\Unit\Group\Group::create(['name' => 'Aviation Group', 'order'=> 1]);

        // Ensure API sends back a correct code
        $this->actingAs($user,'api')->json('DELETE','api/unit/groups/'.$group->id)->assertResponseStatus(204);
    }

    /**
     * Tests creating a group and expects a forbidden due to the roles
     * @group api-groups
     */
    public function testForbiddenCreateGroup()
    {
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $this->actingAs($user,'api')->json('POST', 'api/unit/groups',
            [
                'name' => 'Special Forces Group',
                'order' => 5
            ])
            ->assertResponseStatus('403');
    }

    /**
     * Tries to delete a resources without authorization within api group
     */
    public function testUnauthorized()
    {
        // Lets create some models to test
        $group = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Aviation Group', 'order'=> 1]);

        // Ensure API sends back a correct code
        $this->json('DELETE','api/unit/groups/'.$group->id)->assertResponseStatus(401);
    }

    /**
     * Tests creating a category as a guest, expects unauthorized
     * @group api-groups
     */
    public function testUnauthorizedCreateGroup()
    {
        $this->json('POST', 'api/unit/groups',
            [
                'name' => 'Test',
                'order' => 1
            ])
            ->assertResponseStatus('401');
    }

    ///////////////////////////////// Position Tests
    /**
     * Tests getting all positions from specific group
     * @group api-positions
     */
    public function testGetAllPositions()
    {
        // Lets create some models to test
        $group = \Phoenix\Models\Unit\Group\Group::create(['name' => '1st Company', 'order'=> 1]);
        $group->positions()->create([
            'name' => 'Company Commander'
        ]);
        $group->positions()->create([
            'name' => 'Company Executive Officer'
        ]);

        // Actual Test
        $this->json('GET','api/unit/groups/'.$group->id.'/positions')->seeJson(['name'=> 'Company Executive Officer']);
    }
    /**
     * Tests getting a position from specific group
     * @group api-positions
     */
    public function testGetPositions()
    {
        // Lets create some models to test
        $group = \Phoenix\Models\Unit\Group\Group::create(['name' => '1st Company', 'order'=> 1]);
        $group->positions()->create([
            'name' => 'Company Commander'
        ]);
        $position = $group->positions()->create([
            'name' => 'Company Executive Officer'
        ]);

        // Actual Test
        $this->json('GET','api/unit/groups/'.$group->id.'/positions/'.$position->id)->seeJson(['name'=> 'Company Executive Officer']);
    }


    /**
     * Tests creating a position
     * @group api-positions
     */
    public function testCreatePosition()
    {
        // Seed Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Grant permission to user to make request
        $role = \Phoenix\Models\Auth\Role::whereName('records')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Lets create some models to test
        $group = \Phoenix\Models\Unit\Group\Group::create(['name' => '1st Company', 'order'=> 1]);


        // Make call to API and test
        $this->actingAs($user,'api')->json('POST', 'api/unit/groups/'.$group->id.'/positions',
            [
                'name' => 'Tactical Operator',
                'leader' => true
            ])
            ->seeJson(
                [
                    'name' => 'Tactical Operator',
                    'leader' => true,
                ]);
    }

    /**
     * Tests deleting a position
     * @group api-positions
     */
    public function testDeletePosition()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user and attach correct role
        $role = \Phoenix\Models\Auth\Role::whereName('records')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Lets create some models to test
        $group = \Phoenix\Models\Unit\Group\Group::create(['name' => 'Aviation Group', 'order'=> 1]);
        $position = $group->positions()->create([
            'name' => 'Company Executive Officer'
        ]);

        // Ensure API sends back a correct code
        $this->actingAs($user,'api')->json('DELETE','api/unit/groups/'.$group->id.'/positions/'.$position->id)->assertResponseStatus(204);
    }



}
