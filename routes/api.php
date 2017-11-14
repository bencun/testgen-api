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

Route::middleware(['APIAuthMW'])
    ->group(function(){
        Route::get('/categories', "CategoryController@index");
        Route::get('/categories/{category}', "CategoryController@show");
        Route::post('/categories', "CategoryController@store");
        Route::put('/categories', "CategoryController@update");
        Route::delete('/categories', "CategoryController@delete");
        
        Route::get('/questions/all/{category}', "QuestionController@index");
        Route::get('/questions/{question}', "QuestionController@show");
        Route::post('/questions', "QuestionController@store");
        Route::put('/questions', "QuestionController@update");
        Route::delete('/questions', "QuestionController@delete");
        
        Route::get('/templates', "TestTemplateController@index");
        Route::get('/templates/{template}', "TestTemplateController@show");
        Route::post('/templates', "TestTemplateController@store");
        Route::put('/templates', "TestTemplateController@update");
        Route::delete('/templates', "TestTemplateController@delete");
        
        Route::get('/users', "UsersController@index");
        Route::get('/users/{user}', "UsersController@show");
        Route::post('/users', "UsersController@store");
        Route::put('/users', "UsersController@update");
        Route::delete('/users', "UsersController@delete");
        
        //get all the graded tests for the current user
        Route::get('/test/{user}', "TestController@index");
        //get a specific graded test (for listing of the results)
        Route::get('/test/{user}/{test}', "TestController@read");
        //generate the entire test to work on based on test template id
        Route::get('/test/generate/{user}/{template}', "TestController@generate");
        //this POST updates the complete test (for timed tests and the test finale)
        Route::post('/test', "TestController@store");
        //this updates a single question (for timed questions)
        Route::put('/test/question', "TestController@update");
        //this deletes the test from the DB
        //Route::delete('/test', "TestController@delete");
        //TODO
    });
