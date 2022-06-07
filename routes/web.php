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

Route::middleware(['auth'])->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [UserController::class, 'profile'])->name('index');
    Route::get('/payment-methods', [UserController::class, 'paymentMethod'])->name('payment-methods');
    Route::get('/manage-subscriptions', [UserController::class, 'manageSubscriptions'])->name('manage-subscriptions');
});

Route::get('/subscribe/{plan}/{interval}', [UserController::class, 'subscribe'])->name('plan.subscribe');


Route::middleware(['auth'])->name('movie.')->prefix('movie')->group(function () {
    Route::get('/thumbnail/component', [MovieController::class, 'getThumbnailComponent'])->name('thumbnailComponent');
    Route::get('/thumbnail/{id}', [MovieController::class, 'getThumbnail'])->name('thumbnail');
    Route::post('/fav/{id}', [MovieController::class, 'addToFavourites'])->name('fav');
    Route::post('/unfav/{id}', [MovieController::class, 'removeFromFavourites'])->name('unfav');
    Route::post('/ban/{id}', [MovieController::class, 'removeFromRecommendations'])->name('ban');
    Route::post('/unban/{id}', [MovieController::class, 'addToRecommendations'])->name('unban');
});
Route::middleware(['auth'])->resource('movie', MovieController::class);


Route::resource('genres', GenreController::class);

Route::get("/logout", function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect("/");
});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return view("admin.index");
    })->name('index');
    // Route::resource('users', UserController::class);
});
