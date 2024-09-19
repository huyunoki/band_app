<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ListenController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/register', function () {
    return view('auth/register');
});
Route::get('/login', function () {
    return view('auth/register');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UrlController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [UrlController::class, 'store']);

    // カレンダー
    Route::get('/calendar/calendar', [CalendarController::class, 'index'])->name('schedule');
    Route::post('/calendar/store', [EventController::class, 'store'])->name('event.store');
    Route::post('/calendar/event', [EventController::class, 'getEvent'])->name('event.get');
    Route::post('/calendar/{event}', [EventController::class, 'update'])->name('event.update');
    Route::post('/calendar/{id}/edit', [EventController::class, 'edit']);
    Route::post('/calendar/{event}/delete', [EventController::class, 'delete'])->name('event.delete');

    // チャット
    Route::get('/message/index', [ChatController::class, 'index'])->name('message');
    Route::get('/chat/{user}', [ChatController::class, 'openChat']);
    Route::post('/chat', [ChatController::class, 'sendMessage']);

    // アップロード
    Route::get('/upload/index', [UploadController::class, 'index'])->name('upload');
    Route::get('/upload/create', [UploadController::class, 'create']);
    Route::post('/upload/store', [UploadController::class, 'store']);
    Route::get('/upload/{upload}/', [UploadController::class, 'index']);
    Route::get('/upload/{upload}/edit', [UploadController::class, 'edit']);
    Route::put('/upload/{upload}', [UploadController::class, 'update']);
    Route::delete('/upload/delete/{upload}', [UploadController::class, 'delete']);
    Route::post('/upload/like', [ListenController::class, 'likeUpload']);

    // 聴く用
    Route::get('/listen/index', [ListenController::class, 'show'])->name('listen');
    Route::get('/listen/{upload}', [ListenController::class, 'user']);

    // プロファイル
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
