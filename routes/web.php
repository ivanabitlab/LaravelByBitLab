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

Route::get('/', function () {
    return view('home');
});

Route::resource('posts', PostController::class);
Route::get('/postsAll', [PostController::class, 'allPostsForEditors'])->name('posts.editors');

// Gornja linija koda menja ovih 7 ispod
// Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
// Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
// Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
// Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
// Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
// Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
// Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::resource('categories', CategoryController::class);


Route::middleware(['guest'])->group(function () {
    Route::get('/registration', [AuthController::class,'registration'])->name('registration.show');
    Route::post('/registration', [AuthController::class,'store'])->name('registration.store');
    Route::get('/login', [AuthController::class,'login'])->name('login');
    Route::post('/login', [AuthController::class,'sessionStore'])->name('login.post');
});
Route::get('/logout', [AuthController::class,'logout'])->name('logout')->middleware(['auth']);

Route::get('/users', [UserController::class,'index'])->name('users');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::patch('/users/{user}', [UserController::class, 'changeRole'])->name('users.update');
