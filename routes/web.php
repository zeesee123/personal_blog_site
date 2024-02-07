<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
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

Route::get('/',[PageController::class,'index']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware(['guest'])->group(function(){

    Route::get('/register',[PageController::class,'registerPage']);
    Route::post('/register',[RegisterController::class,'registerUser']);
});


Route::middleware(['auth'])->group(function(){
    
    Route::post('/logout',[AuthController::class,'logout']);
});

