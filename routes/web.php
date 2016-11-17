<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

// Documentation
Route::group(['prefix' => 'documentation'], function (){
    Route::get('/', 'Frontend\Unit\Documentation\DocumentationController@index')->name('documentation.index');
    Route::get('/sections/{section}', 'Frontend\Unit\Documentation\DocumentationController@getSection')->name('documentation.section.get');
    Route::get('/sections/{section}/{page}', 'Frontend\Unit\Documentation\DocumentationController@getPage')->name('documentation.section.page.get');

    Route::get('sidebar', 'Frontend\Unit\Documentation\DocumentationController@getSidebar')->name('documentation.sidebar');

});