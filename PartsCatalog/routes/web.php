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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource("/motorcycles", "MotorcycleController")->middleware("auth");


//Categories
Route::get("/motorcycles/{motorcycle}/category/create", "CategoryController@create")->middleware("auth");

Route::get("/motorcycles/{motorcycle}/category/{category}/edit", "CategoryController@edit")->middleware("auth");

Route::patch("/motorcycles/{motorcycle}/category/{category}", "CategoryController@update")->middleware("auth");

Route::delete("/motorcycles/{motorcycle}/category/{category}", "CategoryController@destroy")->middleware("auth");

Route::get("/motorcycles/{motorcycle}/category/{category}/show", "CategoryController@show")->middleware("auth");

Route::post("/motorcycles/{motorcycle}/category", "CategoryController@store")->middleware("auth");

//Parts

Route::get("/motorcycles/{motorcycle}/category/{category}/part/create", "PartsController@create")->middleware("auth");

Route::post("/motorcycles/{motorcycle}/category/{category}/part", "PartsController@store")->middleware("auth");

Route::get("/motorcycles/{motorcycle}/category/{category}/show/{part}/show", "PartsController@show")->middleware("auth");

Route::get("/motorcycles/{motorcycle}/category/{category}/show/{part}/edit", "PartsController@edit")->middleware("auth");

Route::patch("/motorcycles/{motorcycle}/category/{category}/show/{part}", "PartsController@update")->middleware("auth");

Route::delete("/motorcycles/{motorcycle}/category/{category}/show/{part}", "PartsController@destroy")->middleware("auth");
