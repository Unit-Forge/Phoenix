<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class DocumentationAPITest
 */
class DocumentationAPITest extends TestCase
{
    use DatabaseMigrations;



    ///////////////////////////////// Category Tests
    /**
     * Tests getting all categories
     */
    public function testGetAllCategories()
    {
        // Lets create some models to test
        $cat = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Basic Training', 'order'=> 1]);
        $cat2 = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Advanced Training', 'icon'=> 'fa fa-users', 'order'=> 1]);

        // Actual Test
        $this->json('GET','api/documentation/categories')->seeJson(['icon'=> 'fa fa-users']);
    }

    /**
     * Tests getting one categories
     */
    public function testGetCategory()
    {
        // Lets create some models to test
        $cat = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Basic Training', 'order'=> 1]);

        // Actual Test
        $this->json('GET','api/documentation/categories/'.$cat->id)->seeJson(['name'=> 'Basic Training']);
    }

    /**
     * Tests creating a category
     */
    public function testCreateCategory()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user and attach correct role
        $role = \Phoenix\Models\Auth\Role::whereName('documentation')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Make the call
        $this->actingAs($user,'api')->json('POST', 'api/documentation/categories',
            [
                'name' => 'Test Category',
                'icon' => 'fa fa-icon',
                'order' => 1
            ])
            ->seeJson(
            [
                'name' => 'Test Category',
            ]);
    }
    /**
     * Tests creating a category and expects a forbidden due to the roles
     */
    public function testForbiddenCreateCategory()
    {
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $this->actingAs($user,'api')->json('POST', 'api/documentation/categories',
            [
                'name' => 'Test Category',
                'icon' => 'fa fa-icon',
                'order' => 1
            ])
            ->assertResponseStatus('403');
    }

    /**
     * Tries to delete a resources without authorization within api group
     */
    public function testUnauthorized()
    {
        // Lets create some models to test
        $cat = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Basic Training', 'order'=> 1]);
        $section = $cat->sections()->create(['name' => 'First Steps', 'order' => 1]);

        // Ensure API sends back a correct code
        $this->json('DELETE','api/documentation/categories/'.$cat->id.'/sections/'.$section->id)->assertResponseStatus(401);
    }

    /**
     * Tests creating a category as a guest, expects unauthorized
     */
    public function testUnauthorizedCreateCategory()
    {
        $this->json('POST', 'api/documentation/categories',
            [
                'name' => 'Test Category',
                'icon' => 'fa fa-icon',
                'order' => 1
            ])
            ->assertResponseStatus('401');
    }

    /**
     * Tests updating one categories
     */
    public function testUpdateCategory()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user and attach correct role
        $role = \Phoenix\Models\Auth\Role::whereName('documentation')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);


        // Lets create some models to test
        $cat = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Advanced Training', 'order'=> 1]);

        // Ensure API sends back a correct code
        $this->actingAs($user,'api')->json('PUT','api/documentation/categories/'.$cat->id,['name'=>'Advanced Training','order' => 1])->assertResponseStatus(200);
    }

    /**
     *
     */
    public function testDeleteCategory()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user and attach correct role
        $role = \Phoenix\Models\Auth\Role::whereName('documentation')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Lets create some models to test
        $cat = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Basic Training', 'order'=> 1]);

        // Ensure API sends back a correct code
        $this->actingAs($user,'api')->json('DELETE','api/documentation/categories/'.$cat->id)->assertResponseStatus(204);
    }

    ///////////////////////////////// Section Tests
    /**
     * Tests getting all sections
     */
    public function testGetAllSections()
    {
        // Lets create some models and relationships
        $cat = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Basic Training', 'order'=> 1]);
        $cat->sections()->create(['name' => 'First Steps', 'order' => 1]);
        $cat->sections()->create(['name' => 'Second Steps', 'icon' => 'fa fa-jet', 'order' => 2]);

        // Actual Test
        $this->json('GET','api/documentation/categories/'.$cat->id.'/sections')->seeJson(['icon'=> 'fa fa-jet']);
    }


    /**
     * Tests getting one section
     */
    public function testGetSection()
    {
        // Lets create some models to test
        $cat = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Basic Training', 'order'=> 1]);
        $section = $cat->sections()->create(['name' => 'First Steps', 'order' => 1]);

        // Actual Test
        $this->json('GET','api/documentation/categories/'.$cat->id.'/sections/'.$section->id)->seeJson(['name'=> 'First Steps']);
    }

    /**
     * Tests creating a new section with an existing category
     */
    public function testCreateSection()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user and attach correct role
        $role = \Phoenix\Models\Auth\Role::whereName('documentation')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Create some models
        $cat = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Basic Training', 'order'=> 1]);

        $this->actingAs($user,'api')->json('POST', 'api/documentation/categories/'.$cat->id.'/sections',
            [
                'name' => 'Test Section',
                'icon' => 'fa fa-server',
                'order' => 1
            ])
            ->seeJson(
                [
                    'name' => 'Test Section',
                ]);
    }

    /**
     * Tests updating one section
     */
    public function testUpdateSection()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user and attach correct role
        $role = \Phoenix\Models\Auth\Role::whereName('documentation')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Lets create some models to test
        $cat = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Basic Training', 'order'=> 1]);
        $section = $cat->sections()->create(['name' => 'First Steps', 'order' => 1]);

        // Ensure API sends back a correct code
        $this->actingAs($user,'api')->json('PUT','api/documentation/categories/'.$cat->id.'/sections/'.$section->id,['name'=>'Secondary Steps', 'order' => 1])->assertResponseStatus(200);
    }

    /**
     *
     */
    public function testDeleteSection()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user and attach correct role
        $role = \Phoenix\Models\Auth\Role::whereName('documentation')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Lets create some models to test
        $cat = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Basic Training', 'order'=> 1]);
        $section = $cat->sections()->create(['name' => 'First Steps', 'order' => 1]);

        // Ensure API sends back a correct code
        $this->actingAs($user,'api')->json('DELETE','api/documentation/categories/'.$cat->id.'/sections/'.$section->id)->assertResponseStatus(204);
    }


    ///////////////////////////////// Pages Tests
    /**
     * Tests getting all pages
     */
    public function testGetAllPages()
    {
        // Lets create some models and relationships
        $cat = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Basic Training', 'order'=> 1]);
        $section = $cat->sections()->create(['name' => 'First Steps', 'order' => 1]);
        $section->pages()->create(['name' => 'Page 1 Test', 'order' => 1, 'content' => 'The Fox jumped over the moon!', 'published' => true]);
        $section->pages()->create(['name' => 'Page 2 Test', 'order' => 1, 'content' => 'The Fox jumped over the moon!', 'published' => true]);

        // Actual Test
        $this->json('GET','api/documentation/categories/'.$cat->id.'/sections/'.$section->id.'/pages')->seeJson(['name'=> 'Page 2 Test']);
    }

    /**
     * Tests creating a page with the use of an existing category and section
     */
    public function testCreatePage()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user and attach correct role
        $role = \Phoenix\Models\Auth\Role::whereName('documentation')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Create some models
        $cat = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Basic Training', 'order'=> 1]);
        $section = $cat->sections()->create(['name' => 'First Steps', 'order' => 1]);

        $this->actingAs($user,'api')->json('POST', 'api/documentation/categories/'.$cat->id.'/sections/'.$section->id.'/pages', ['name' => 'Page 2 Test', 'order' => 1, 'content' => 'The Fox jumped over the moon!', 'published' => true])
            ->seeJson(
                [
                    'name' => 'Page 2 Test',
                ]);
    }

    /**
     * Tests updating one page
     */
    public function testUpdatePage()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user and attach correct role
        $role = \Phoenix\Models\Auth\Role::whereName('documentation')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Lets create some models to test
        $cat = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Basic Training', 'order'=> 1]);
        $section = $cat->sections()->create(['name' => 'First Steps', 'order' => 1]);
        $page = $section->pages()->create(['name' => 'Page 1 Test', 'order' => 1, 'content' => 'The Fox jumped over the moon!', 'published' => true]);

        // Ensure API sends back a correct code
        $this->actingAs($user,'api')
            ->json('PUT','api/documentation/categories/'.$cat->id.'/sections/'.$section->id.'/pages/'.$page->id,
                [
                    'name'=>'Page 1',
                    'order' => 1,
                    'content' => 'Content',
                    'published' => true

                ])
            ->assertResponseStatus(200);
    }

    /**
     *
     */
    public function testDeletePage()
    {
        // Seed the Database for roles
        \Artisan::call('migrate:refresh',['--seed' => true]);

        // Create user and attach correct role
        $role = \Phoenix\Models\Auth\Role::whereName('documentation')->first();
        $user = \Phoenix\Models\User::create(['email' => 'test1@fake.com','password'=>bcrypt('helloworld')]);
        $user->attachRole($role);

        // Lets create some models to test
        $cat = \Phoenix\Models\Unit\Documentation\Category::create(['name' => 'Basic Training', 'order'=> 1]);
        $section = $cat->sections()->create(['name' => 'First Steps', 'order' => 1]);
        $page = $section->pages()->create(['name' => 'Page 1 Test', 'order' => 1, 'content' => 'The Fox jumped over the moon!', 'published' => true]);

        // Ensure API sends back a correct code
        $this->actingAs($user,'api')->json('DELETE','api/documentation/categories/'.$cat->id.'/sections/'.$section->id.'/pages/'.$page->id)->assertResponseStatus(204);
    }



}
