<?php
 
 
use App\Http\Controllers\Admin\AdminBooksController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminReviewsController;
use App\Http\Controllers\Admin\AdminUsersController;
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Book\CartController;

use App\Http\Controllers\user\ReviewController;
use App\Http\Controllers\user\UserController;

Route::get('/', [BookController::class, 'index'])->name('home');

Route::resource('books', BookController::class)->only(['index', 'show']);
// Cart routes 
Route::post('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{book}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/increase/{book}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{book}', [CartController::class, 'decrease'])->name('cart.decrease');
//----AdMin--//
Route::middleware(['auth','admin'])
      ->prefix('admin')
      ->name('admin.')
      ->group(function () {
     
     Route::get('/info', [AdminController::class, 'index'])
            ->name('info');
     Route::get('users/history', [AdminUsersController::class, 'history'])->name('users.history');
     Route::resource('users', AdminUsersController::class );
     Route::resource('books', AdminBooksController::class );
     Route::resource('reviews', AdminReviewsController::class);
   
                       
    });

//----UserS--------//
Route::middleware('auth')->group(function(){
        Route::resource('books.reviews', ReviewController::class);
        Route::get('user/history', [UserController::class, 'history'])->name('user.history');
        Route::resource('user', UserController::class);

});
require __DIR__.'/auth.php';
 