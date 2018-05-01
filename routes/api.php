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

Route::middleware(
    'auth:api'
)->get(
    '/user', function (Request $request) {
        return $request->user();
    }
);

// item type routes
Route::post('generate_mcs', 'MultipleChoiceController@generateItems');
Route::post('generate_tfs', 'TrueFalseController@generateItems');
Route::post('generate_sss','SingleSelectController@generateItems');

// get jobs reports
Route::get('jobs', 'JobsController@getJobs');
Route::post('jobs/search', 'JobsController@searchJobs');
Route::post('job','JobsController@logJob');

// generate html files routes
// Route::post('generate_html','HTMLController@generateHTML');
