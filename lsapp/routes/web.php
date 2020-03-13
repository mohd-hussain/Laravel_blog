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

/*
Route::get('hello', function () {
    return '<h1>hello world ..how are u excited for this laravel series</h1>';
});

Route::get('/users/{id}/{name}', function ($id,$name){
    return 'This is user '.$name. ' with an id of '.$id;
});

Route::get('/home', function (){
    return view('pages.index');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function (){
    return view('pages.about');
});

*/

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::resource('posts','PostsController');
// Route::post('posts','PostsController@store')->name('posts.store');
// Route::get('posts/edit','PostsController@store')->name('posts.edit');


Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
