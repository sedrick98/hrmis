<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

// HOME
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');

// ADMIN
Route::get('/', [AdminController::class, 'dashboard'])->middleware('auth')->name('admin-dashboard');
Route::get('admin/users', [AdminController::class, 'users'])->name('admin-users');
Route::get('admin/roles', [AdminController::class, 'roles'])->name('admin-roles');

// POST
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/users', function(){
    return view('admin/users');
});

Route::get('/allusers', function(){
    return view('admin/userview');
});

Route::get('/dashboard', function(){
    return view('admin/dashboard');
});

Route::get('/roles', function(){
    return view('admin/roles');
});

Route::get('/permissions', function(){
    return view('admin/permissions');
});