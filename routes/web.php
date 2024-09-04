<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ListenController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EventController;
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

Route::get('/', function () { // ルート( / )というURLにアクセスがあればgetリクエストされ無名関数が実行
    return view('welcome');   // 無名関数を実行するとviews/welcome.blade.phpが表示される
});

Route::get('/dashboard', function () { // /dashboardにというURLにアクセスがあれば関数が実行され
    return view('dashboard');          // views/dashboardが表示される
})->middleware(['auth', 'verified'])->name('dashboard'); //middlewareは認証されているユーザーしかアクセスできない
//authはユーザーをverifiedはメールアドレスを認証できているときしかアクセスできない。また、後ろの奴は名前をつけていて
// route('dashboard')とかくとこのルートのURLを取得できる。

require __DIR__.'/auth.php';

Route::get('/post/index',[PostController::class, 'index'])->middleware(['auth', 'verified'])->name('post');
Route::get('/calendar/calendar',[CalendarController::class, 'index'])->middleware(['auth', 'verified'])->name('schedule');
Route::get('/message/index',[ChatController::class, 'index'])->middleware(['auth', 'verified'])->name('message');
Route::get('/upload/index',[UploadController::class, 'index'])->middleware(['auth', 'verified'])->name('upload');
Route::get('/listen/index',[ListenController::class, 'show'])->middleware(['auth', 'verified'])->name('listen');

Route::get('/upload/create', [UploadController::class, 'create']);
Route::post('/upload/store', [UploadController::class ,'store']);
Route::get('/upload/{upload}/', [UploadController::class ,'index']);
Route::get('/upload/{upload}/edit', [UploadController::class, 'edit']);
Route::put('/upload/{upload}', [UploadController::class, 'update']);
Route::delete('/upload/delete/{upload}', [UploadController::class,'delete']);

ROute::get('/listen/{upload}', [ListenController::class, 'user']);
Route::post('/upload/like', [ListenController::class, 'likeUpload']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/chat/{user}', [ChatController::class, 'openChat']);
Route::post('/chat', [ChatController::class, 'sendMessage']);

Route::post('/calendar/store', [EventController::class, 'store'])->name('event.store');
Route::post('/calendar/event', [EventController::class, 'getEvent'])->name('event.get');
Route::post('/calendar/{event}', [EventController::class, 'update'])->name('event.update');
Route::post('/calendar/{id}/edit', [EventController::class, 'edit']);
Route::post('/calendar/{event}/delete', [EventController::class, 'delete'])->name('event.delete');



