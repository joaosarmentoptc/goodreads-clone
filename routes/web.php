<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/', function() { return view('admin.index'); })->name('admin.index');
});

Route::prefix('auth')->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('auth.logout');
    Route::middleware('guest')->group(function () {
        Route::get('/register', [UserController::class, 'registerForm'])->name('auth.register');
        Route::post('/register', [UserController::class, 'register']);
        Route::get('/login', [UserController::class, 'loginForm'])->name('auth.login');
        Route::post('/login', [UserController::class, 'login'])->name('auth.login.post');
    });
});

Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('books.index');
    Route::get('/{book}', [BookController::class, 'show'])->name('books.show');
    Route::post('/{book}/rating/{rating}', [RatingController::class, 'store'])->name('books.rating');
});

Route::prefix('wishlist')->middleware('auth')->group(function () {
   Route::post('/add/{book}', [WishlistController::class, 'store'])->name('wishlist.store');
   Route::delete('/remove/{book}', [WishlistController::class, 'destroy'])->name('wishlist.delete');
});
