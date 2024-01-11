<?php

use App\Http\Controllers\UserController;
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

Route::get('/login',[UserController::class,'showLoginForm'])->name('login.form');
Route::get('/register',[UserController::class,'register'])->name('register.form');
Route::post('/registerusers',[UserController::class,'userRegistration'])->name('register');
Route::get("/verificationCompleted/{id}",[UserController::class,"userActivation"])->name("verification.completed");

Route::post('/loginusers',[UserController::class,'userLogin'])->name('login')->middleware('single.login');


Route::middleware('auth.check')->group(function () {
    Route::get('/index',[UserController::class,'index'])->name('dashboard');
    Route::get('/showallusers',[UserController::class,'showAllUsers'])->name('allusers.info');
    Route::get("/userinfos/{id}",[UserController::class,'showSingleUser'])->name("user.info");
    Route::get("/user/logout/{sessionid}",[UserController::class,"logOut"])->name('user.logout');
});

