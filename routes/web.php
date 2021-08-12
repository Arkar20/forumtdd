<?php

use App\Models\ThreadSubscription;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\NotificationThreadController;
use App\Http\Controllers\ThreadNotificationController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/threads', [ThreadController::class, 'index'])->name('thread');
Route::get('/threads/{channel}', [ThreadController::class, 'index'])->name(
    'thread.index'
);
Route::post('/threads', [ThreadController::class, 'store'])->name(
    'thread.store'
);
Route::get('/threads/{slug}/{thread}', [ThreadController::class, 'show']);
Route::delete('/threads/{slug}/{thread}', [ThreadController::class, 'destroy']);
Route::get('/threads/{slug}/{thread}/replies', [
    ReplyController::class,
    'index',
]);
Route::post('/threads/{slug}/{thread}/replies', [
    ReplyController::class,
    'store',
]);
Route::post('/threads/{slug}/{thread}/subscriptions', [
    ThreadSubscription::class,
    'store',
])->middleware('auth');
Route::post('/replies/{reply}/favourites', [
    FavouriteController::class,
    'store',
])->name('reply.favourite');
Route::delete('/replies/{reply}/favourites', [
    FavouriteController::class,
    'destroy',
]);

Route::delete('replies/{reply}', [ReplyController::class, 'destroy']);
Route::patch('replies/{reply}', [ReplyController::class, 'update']);

Route::get('/profile/{user}/notifications', [
    ThreadNotificationController::class,
    'index',
]);
Route::delete('/profile/{user}/notifications/{notificationid}', [
    ThreadNotificationController::class,
    'update',
]);
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name(
    'profile'
);
// require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [
    App\Http\Controllers\HomeController::class,
    'index',
])->name('home');
