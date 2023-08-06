<?php

use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\ImageController;
use Illuminate\Support\Facades\Route;
use App\Models\BlogPost;
use App\Http\Controllers\admin\PostController;
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
    return view('welcome');
});

//Route::get('/blog' , [PostController::class , 'index']);
//Route::get('/blog/{blogPost}' , [PostController::class , 'show']);
//


Route::resource('blogposts' , PostController::class);

Route::post('/comments/{blogPost}' , [CommentController::class , 'store']);


Route::get('/gallery' , [ImageController::class , 'index']);
Route::get('/gallery/{image}' , [ImageController::class , 'show']);

Route::post('/gallery/store' , [ImageController::class , 'store']);
Route::delete('/gallery/{image}', [ImageController::class , 'destroy']);


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
