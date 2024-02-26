<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[PageController::class,'index'])->name('login');
Route::post('/login',[AuthController::class,'login']);

Route::middleware(['guest'])->group(function(){

    Route::get('/register',[PageController::class,'registerPage']);
    Route::post('/register',[RegisterController::class,'registerUser']);
});


Route::middleware(['auth'])->group(function(){
    
    Route::post('/logout',[AuthController::class,'logout']);

    Route::get('/create_blog',[PageController::class,'create_blog']);

    Route::post('/create_blog',[BlogController::class,'create']);

    Route::get('/blog/edit/{id}',[PageController::class,'edit_blog']);

    Route::put('/edit_blog',[BlogController::class,'edit_blog']);
    
    Route::post('/delete_blog',[BlogController::class,'delete_blog']);

    Route::post('/add_comment',[CommentController::class,'add_comment']);

    Route::post('/load_comments',[CommentController::class,'load_comments']);

    Route::get('/view_blog/{blog}',[PageController::class,'view_blog']);
});


Route::get('{any}',function(){

    abort(404);
});

