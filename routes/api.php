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

Route::get('/testCodeAnotate', 'ApiListen@testCodeAnotate')->name('api.testCodeAnotate');

Route::post('/testCodeAnotate/process', 'ApiListen@testCodeAnotatePost')->name('api.testCodeAnotate.post');

Route::any('/parallelize', 'ApiListen@parallelize')->name('api.parallelize');
