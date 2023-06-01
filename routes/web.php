<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTestController;

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
    Route::get('/projects/timeline/{id}', [ProjectController::class, 'timeline'])->name('timeline');
    Route::post('/project_detail/store', [ProjectController::class, 'simpan_detail'])->name('simpan_detail');
    Route::get('/project_detail/edit_detail/{id}', [ProjectController::class, 'edit_detail'])->name('edit_detail');
    Route::post('/project_detail/update_detail', [ProjectController::class, 'update_detail'])->name('update_detail');
    Route::post('/project/planning_store', [ProjectController::class, 'planning_store'])->name('planning_store');
    Route::post('/project/design_store', [ProjectController::class, 'design_store'])->name('design_store');
    Route::get('/project/implementasi_store', [ProjectController::class, 'implementasi_store'])->name('implementasi_store');
    Route::post('/project/evolution_store', [ProjectController::class, 'evolution_store'])->name('evolution_store');
    Route::get('/project_timeline/status/{id}/{jenis}', [ProjectController::class, 'status_timeline'])->name('status_timeline');
    Route::post('/project_timeline/update_status', [ProjectController::class, 'status_timeline_store'])->name('status_timeline_store');
    Route::post('/project_test/accept_test', [ProjectTestController::class, 'accept_test'])->name('accept_test');
    Route::resource("/project_test", ProjectTestController::class);
    Route::resource("/users", UserController::class);
    Route::resource("/projects", ProjectController::class);
    Route::get('/dashboard', [HomeController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});