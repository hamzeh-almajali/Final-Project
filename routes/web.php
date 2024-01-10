<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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
//     return view('home');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');
Route::get('/homee/{userid}/{userid2}',[App\Http\Controllers\UserController::class, 'update'])->name('homee');
Route::get('/cancel/{userid}/{userid2}',[App\Http\Controllers\UserController::class, 'canelreq'])->name('cancel');
route::get('/profilee/{userid}',[App\Http\Controllers\HomeController::class,'add'])->name('profilee');
route::post('/profile',[App\Http\Controllers\HomeController::class,'updateprofileImage'])->name('profileImage');
route::post('/profile-cover',[App\Http\Controllers\HomeController::class,'updatecoverImage'])->name('coverImage');



