<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;

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
    return view('login');
});

// Route::get('/register', [AuthController::class, 'register'])->name('register');
// Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/projects/detail/{id}', [ProjectController::class, 'detail'])->name('detail');
    Route::post('/project_detail/store', [ProjectController::class, 'simpan_detail'])->name('simpan_detail');
    Route::post('/project_detail/update', [ProjectController::class, 'update_detail'])->name('update_detail');
    Route::resource("/users", UserController::class);
    Route::resource("/projects", ProjectController::class);
    Route::get('/dashboard', [HomeController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});