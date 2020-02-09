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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication routes
Route::post('/register', 'Auth\Api\AuthController@register')->name('api.register');
Route::post('/login', 'Auth\Api\AuthController@login')->name('api.login');
Route::post('/logout', 'Auth\Api\AuthController@logout')->name('api.logout');
Route::post('/get_user_by_token', 'Auth\Api\AuthController@getUserByToken')->name('api.get_user_by_token');

// Route::group(['middleware' => ['auth']], function() 
// {
    Route::resource('/learning_goals', 'LearningGoalsController', [
      // 'as' => 'admin'
    ]);

    Route::resource('/users/{user}/learning_goals', 'UserLearningGoalsController', [
      // 'as' => 'admin'
    ]);

    Route::resource('/progress_levels', 'ProgressLevelsController', [
      // 'as' => 'admin'
    ]);

    Route::resource('/topics', 'TopicsController', [
        // 'as' => 'admin'
    ]);
//}