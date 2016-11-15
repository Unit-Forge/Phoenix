<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('users', 'Frontend\API\UserController@index')->name('api.users');
Route::get('users/{user}', 'Frontend\API\UserController@show')->name('api.users');
Route::post('users', 'Frontend\API\UserController@create')->name('api.users.create');

// Documentation
Route::group(['prefix' => 'documentation'], function (){

    Route::get('categories', 'Frontend\API\Unit\Documentation\CategoryController@index')->name('api.documentation.categories');
    Route::get('categories/{category}', 'Frontend\API\Unit\Documentation\CategoryController@get')->name('api.documentation.categories.get');
    Route::get('categories/{category}/sections', 'Frontend\API\Unit\Documentation\SectionController@index')->name('api.documentation.sections');
    Route::get('categories/{category}/sections/{section}', 'Frontend\API\Unit\Documentation\SectionController@get')->name('api.documentation.sections.get');
    Route::get('categories/{category}/sections/{section}/pages', 'Frontend\API\Unit\Documentation\PageController@index')->name('api.documentation.pages');
    Route::get('categories/{category}/sections/{section}/pages/{page}', 'Frontend\API\Unit\Documentation\PageController@get')->name('api.documentation.pages.get');

    // Authenticated Methods
    Route::group(['middleware'=>'auth:api'], function () {
        Route::post('categories', 'Frontend\API\Unit\Documentation\CategoryController@create')->name('api.documentation.categories.create');
        Route::put('categories/{category}', 'Frontend\API\Unit\Documentation\CategoryController@update')->name('api.documentation.categories.update');
        Route::delete('categories/{category}', 'Frontend\API\Unit\Documentation\CategoryController@delete')->name('api.documentation.categories.delete');
        Route::post('categories/{category}/sections', 'Frontend\API\Unit\Documentation\SectionController@create')->name('api.documentation.sections.create');
        Route::put('categories/{category}/sections/{section}', 'Frontend\API\Unit\Documentation\SectionController@update')->name('api.documentation.sections.update');
        Route::delete('categories/{category}/sections/{section}', 'Frontend\API\Unit\Documentation\SectionController@delete')->name('api.documentation.sections.delete');
        Route::post('categories/{category}/sections/{section}/pages', 'Frontend\API\Unit\Documentation\PageController@create')->name('api.documentation.pages.create');
        Route::put('categories/{category}/sections/{section}/pages/{page}', 'Frontend\API\Unit\Documentation\PageController@update')->name('api.documentation.pages.update');
        Route::delete('categories/{category}/sections/{section}/pages/{page}', 'Frontend\API\Unit\Documentation\PageController@delete')->name('api.documentation.pages.delete');
    });
});

Route::group(['prefix' => 'unit'], function() {
    // Files

    Route::get('files/awards', 'Frontend\API\Unit\File\AwardController@index')->name('api.unit.awards');
    Route::get('files/awards/{award}', 'Frontend\API\Unit\File\AwardController@get')->name('api.unit.awards.get');
    Route::get('files', 'Frontend\API\Unit\File\FileController@index')->name('api.unit.files');
    Route::get('files/{file}', 'Frontend\API\Unit\File\FileController@get')->name('api.unit.files.get');

    // Groups
    Route::get('groups', 'Frontend\API\Unit\Group\GroupController@index')->name('api.unit.group');
    Route::get('groups/{group}', 'Frontend\API\Unit\Group\GroupController@get')->name('api.unit.group.get');
    Route::get('groups/{group}/positions',
        'Frontend\API\Unit\Group\PositionController@index')->name('api.unit.group.positions');
    Route::get('groups/{group}/positions/{position}',
        'Frontend\API\Unit\Group\PositionController@get')->name('api.unit.group.positions.get');

    // Ranks
    Route::get('ranks', 'Frontend\API\Unit\RankController@index')->name('api.unit.rank');
    Route::get('ranks/{rank}', 'Frontend\API\Unit\RankController@get')->name('api.unit.rank.get');



        // Authenticated Methods
    Route::group(['middleware' => 'auth:api'], function () {
        // Groups
        Route::post('groups', 'Frontend\API\Unit\Group\GroupController@create')->name('api.unit.group.create');
        Route::put('groups/{group}', 'Frontend\API\Unit\Group\GroupController@update')->name('api.unit.group.update');
        Route::delete('groups/{group}', 'Frontend\API\Unit\Group\GroupController@delete')->name('api.unit.group.delete');
        Route::post('groups/{group}/positions', 'Frontend\API\Unit\Group\PositionController@create')->name('api.unit.group.positions.create');
        Route::put('groups/{group}/positions/{position}', 'Frontend\API\Unit\Group\PositionController@update')->name('api.unit.group.positions.update');
        Route::delete('groups/{group}/positions/{position}', 'Frontend\API\Unit\Group\PositionController@delete')->name('api.unit.group.positions.delete');

        // Ranks
        Route::post('ranks', 'Frontend\API\Unit\RankController@create')->name('api.unit.rank.create');
        Route::put('ranks/{rank}', 'Frontend\API\Unit\RankController@update')->name('api.unit.rank.update');
        Route::delete('ranks/{rank}', 'Frontend\API\Unit\RankController@delete')->name('api.unit.rank.delete');

        // Files
        Route::post('files/awards', 'Frontend\API\Unit\File\AwardController@create')->name('api.unit.awards.create');
        Route::put('files/awards/{award}', 'Frontend\API\Unit\File\AwardController@update')->name('api.unit.awards.update');
        Route::delete('files/awards/{award}', 'Frontend\API\Unit\File\AwardController@delete')->name('api.unit.awards.delete');
        Route::post('files', 'Frontend\API\Unit\File\FileController@create')->name('api.unit.files.create');
        Route::put('files/{file}', 'Frontend\API\Unit\File\FileController@update')->name('api.unit.files.update');
        Route::delete('files/{file}', 'Frontend\API\Unit\File\FileController@delete')->name('api.unit.files.delete');
    });

});