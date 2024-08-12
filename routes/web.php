<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
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

Route::get('/post/index',[PostController::class, 'index'])->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';


