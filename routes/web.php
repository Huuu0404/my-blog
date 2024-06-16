<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LogoutController;


Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'loginIndex'); //登入頁面
    Route::post('/login', 'login'); // ajax - 登入驗證
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'registerIndex'); //註冊頁面
    Route::post('/register', 'register'); // ajax - 註冊帳號
});

Route::controller(PostController::class)->group(function () {
    Route::get('/whats_new', 'whatsNew'); //whats new頁面
    Route::get('/my_world', 'myWorld'); //My World頁面

    Route::post('/posts/create', 'createPost'); // ajax - 建立貼文
    Route::post('/posts/update', 'updatePost'); // ajax - 編輯貼文
    Route::post('/posts/delete', 'deletePost'); // ajax - 刪除貼文
});

Route::controller(LogoutController::class)->group(function () {
    Route::get('/logout', 'logout'); // ajax - 登出
});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
