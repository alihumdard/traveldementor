<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;;

use App\Http\Middleware\UserAuthCheck;

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

Route::middleware('check.userAuthCheck')->group(function () {
    Route::get('/run-commands', [UserController::class, 'runMigrations']);
    Route::match(['post', 'get'], '/admins',      [UserController::class, 'staff'])->name('staff');
    Route::match(['post', 'get'], '/users',       [UserController::class, 'users'])->name('users');
    Route::match(['post', 'get'], '/vfs/embassy', [UserController::class, 'vfs_embassy'])->name('vfs.embassy');
    Route::match(['post', 'get'], '/settings',    [UserController::class, 'settings'])->name('settings');
    Route::match(['post', 'get'], '/currencies',  [UserController::class, 'currencies'])->name('currencies');
    Route::match(['post', 'get'], '/categories',  [UserController::class, 'categories'])->name('categories');
    Route::match(['post', 'get'], '/countries',  [UserController::class, 'countries'])->name('countries');
    Route::match(['post', 'get'], '/blank-temp', [UserController::class, 'blank_temp'])->name('blank.temp');
    Route::match(['post', 'get'], '/add-blank', [UserController::class, 'add_blank'])->name('add.blank');
    Route::match(['post', 'get'], '/locations',   [UserController::class, 'locations'])->name('locations');
});
//basic routes of login and registeration ...
Route::get('/',       [UserController::class, 'index'])->name('dashboard');
Route::get('/login',  [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

//Auth Controller... 
Route::match(['post', 'get'], '/forgot_password', [AuthController::class, 'forgot_password'])->name('forgot.password');
Route::match(['post', 'get'], '/set_password',    [AuthController::class, 'set_password'])->name('set.password');
Route::match(['post', 'get'], '/register',        [AuthController::class, 'user_register'])->name('register.user');
Route::match(['post', 'get'], '/logout',          [AuthController::class, 'logout'])->name('logout');
Route::match(['post', 'get'], '/verify/{hash}',   [AuthController::class, 'verify'])->name('verify');
