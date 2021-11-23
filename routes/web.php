<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'blog'])->name('blog');

Route::resource('posts', PostController::class);
Route::get('/postsAll', [PostController::class, 'allPostsForEditors'])->name('posts.editors');

Route::resource('categories', CategoryController::class);

Route::middleware(['guest'])->group(function () {
    Route::get('/registration', [AuthController::class, 'registration'])->name('registration.show');
    Route::post('/registration', [AuthController::class, 'store'])->name('registration.store');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'sessionStore'])->name('login.post');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware(['auth']);

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::patch('/users/{user}', [UserController::class, 'changeRole'])->name('users.update');
