<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get("/", function () {
    return view("homepage");
})->name('homepage');

Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/profile/payment-methods', [UserController::class, 'paymentMethod'])->name('profile.payment-methods');
Route::get('/profile/manage-subscriptions', [UserController::class, 'manageSubscriptions'])->name('profile.manage-subscriptions');
Route::get('/subscribe/{plan}/{interval}', [UserController::class, 'subscribe'])->name('plan.subscribe');

Route::get('/movie/thumbnail/{id}', [MovieController::class, 'getThumbnail'])->name('movie.thumbnail');
Route::get('/movie/fav/{id}', [MovieController::class, 'addToFavourites'])->name('movie.fav');
Route::get('/movie/ban/{id}', [MovieController::class, 'removeFromRecommendations'])->name('movie.ban');

Route::resource('genres', GenreController::class);
Route::resource('movie', MovieController::class);

Route::get("/logout", function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect("/");

});
