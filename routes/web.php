<?php

use App\Http\Controllers\ProfileController;
// 🔽 追加（TweetControllerファイルを使うので読み込む）
use App\Http\Controllers\TweetController;
// 🔽 追加（TweetLikeControllerファイルを使うので読み込む）
use App\Http\Controllers\TweetLikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // 🔽 追加
    Route::resource('tweets', TweetController::class);
    // 🔽 追加（読み込んだTweetLikeControllerのstoreの関数を使う。）
    Route::post('/tweets.{tweet}/like',
    [TweetLikeController::class, 'store'])->name('tweets.like');
    Route::delete('/tweets/{tweet}/like',[TweetLikeController::class, 'destroy'])->name('tweets.dislike');
});

require __DIR__.'/auth.php';
