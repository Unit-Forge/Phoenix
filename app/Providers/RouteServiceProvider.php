<?php

namespace Phoenix\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Phoenix\Models\Unit\Documentation\Category;
use Phoenix\Models\Unit\Documentation\Page;
use Phoenix\Models\Unit\Documentation\Section;
use Phoenix\Models\Unit\Group\Group;
use Phoenix\Models\Unit\Group\Position;
use Phoenix\Models\Unit\Rank;
use Phoenix\Models\Unit\File\File;
use Phoenix\Models\Unit\File\Award;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Phoenix\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();

        Route::model('category', Category::class);
        Route::model('section', Section::class);
        Route::model('page', Page::class);
        Route::model('group', Group::class);
        Route::model('position', Position::class);
        Route::model('rank', Rank::class);
        Route::model('award', Award::class);
        Route::model('file', File::class);

    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}
