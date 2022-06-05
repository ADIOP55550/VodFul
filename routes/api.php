<?php

use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//
//Route::get('/', function (Request $request) {
//    return response(json_encode("Hello, world!"), 200);
//});
//
//// protected routes
//Route::group(['middleware' => 'auth:sanctum'], function () {
//    Route::get('/user', function (Request $request) {
//        return $request->user();
//    });
//
//});


Route::get('/genre/{id}/movies/', [GenreController::class, 'showMovies'])->name('genre.movies.page');
