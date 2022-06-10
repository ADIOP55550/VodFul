<?php

use App\Http\Controllers\AdminMovieController;
use App\Http\Controllers\AdminPlanController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

Route::middleware(['auth', 'verified'])->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [UserController::class, 'profile'])->name('index');
    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update-password');
    Route::middleware(['password.confirm'])->delete('/delete-profile', [UserController::class, 'deleteProfile'])->name('delete');
    Route::get('/manage-subscriptions', [UserController::class, 'manageSubscriptions'])->name('manage-subscriptions');
});

Route::get('/subscribe/{plan}/{priceData}', [UserController::class, 'subscribe'])->name('plan.subscribe');
Route::get('movie/thumbnail/component', [MovieController::class, 'getThumbnailComponent'])->name('movie.thumbnailComponent');


Route::middleware(['auth'])->name('movie.')->prefix('movie')->group(function () {
    Route::get('/thumbnail/{id}', [MovieController::class, 'getThumbnail'])->name('thumbnail');
    Route::post('/fav/{id}', [MovieController::class, 'addToFavourites'])->name('fav');
    Route::post('/unfav/{id}', [MovieController::class, 'removeFromFavourites'])->name('unfav');
    Route::post('/ban/{id}', [MovieController::class, 'removeFromRecommendations'])->name('ban');
    Route::post('/unban/{id}', [MovieController::class, 'addToRecommendations'])->name('unban');
});
Route::middleware(['auth'])->resource('movie', MovieController::class, ['except' => ['show']]);
Route::middleware(['auth', 'verified', 'subscribed'])->get('/movie/{movie}', [MovieController::class, 'show'])->name('movie.show');


Route::resource('genres', GenreController::class);

Route::get("/logout", function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect("/");
});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/', function () {
        return view("admin.index");
    })->name('index');
    // Route::get('/users', function () {
    //     return view("admin.users");
    // })->name('users');
    Route::resource('users', AdminUserController::class);
    Route::resource('movies', AdminMovieController::class);
    Route::resource('plans', AdminPlanController::class);
    Route::post('/users/{id}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('users.toggle-admin');
    Route::post('/plans/reorder', [AdminPlanController::class, 'reorder'])->name('plans.reorder');
    Route::post('/plans/{id}/restore', [AdminPlanController::class, 'restore'])->name('plans.restore');
    Route::post('/plans/{id}/toggle-visibility', [AdminPlanController::class, 'toggleVisibility'])->name('plans.toggle-visibility');

    // Route::resource('users', UserController::class);
});
