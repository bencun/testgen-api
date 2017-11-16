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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('/login', "AuthController@login");
Route::post('/logout', "AuthController@logout");
Route::post('/verify', "AuthController@verify");

Route::middleware(['APIAuthMW:admin'])
    ->group(function(){
        //get all categories
        Route::get('/categories', "CategoryController@index");
        //read
        Route::get('/categories/{category}', "CategoryController@show");
        //create
        Route::post('/categories', "CategoryController@store");
        //update
        Route::put('/categories', "CategoryController@update");
        //delete
        Route::delete('/categories/{category}', "CategoryController@delete");
        
        //read all questions from a category
        Route::get('/questions/all/{category}', "QuestionController@index");
        //read
        Route::get('/questions/{question}', "QuestionController@show");
        //create
        Route::post('/questions', "QuestionController@store");
        //update
        Route::put('/questions', "QuestionController@update");
        //delete
        Route::delete('/questions/{question}', "QuestionController@delete");
        
        //read all test templates
        Route::get('/templates', "TestTemplateController@index");
        //read
        Route::get('/templates/{template}', "TestTemplateController@show");
        //create
        Route::post('/templates', "TestTemplateController@store");
        //update
        Route::put('/templates', "TestTemplateController@update");
        //delete
        Route::delete('/templates/{template}', "TestTemplateController@delete");
        
        //read all users
        Route::get('/users', "UsersController@index");
        //read
        Route::get('/users/{user}', "UsersController@show");
        //create
        Route::post('/users', "UsersController@store");
        //update
        Route::put('/users', "UsersController@update");
        //delete
        Route::delete('/users/{user}', "UsersController@delete");
    });

    Route::middleware(['APIAuthMW:user'])
    ->group(function(){
        //get all the assigned test templates
        Route::get('/alltemplates', "TestController@all");
        //get all the assigned test templates
        Route::get('/alltemplates/{template}', "TestController@template");
        //get all the graded tests for the current user
        Route::get('/test', "TestController@index");
        //get a specific graded test (for listing of the results)
        Route::get('/test/{test}', "TestController@read");
        //generate the entire test to work on based on test template id
        Route::get('/test/generate/{template}', "TestController@generate");
        //this POST updates the complete test (for timed tests and the test finale)
        Route::post('/test', "TestController@store");
        //this updates a single question (for timed questions)
        Route::put('/test/question', "TestController@update");
        //this deletes the test from the DB
        //Route::delete('/test', "TestController@delete");
        //TODO
    });
