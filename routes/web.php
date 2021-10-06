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

// AUTHENTICATION
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::post('/login', [UserController::class, 'login'])->name('login');

// HOME
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');

// ADMIN - GET
Route::get('/', [AdminController::class, 'dashboard'])->middleware('auth')->name('admin-dashboard');
Route::get('admin/users', [AdminController::class, 'users'])->name('admin-users');
Route::get('admin/users/add', [AdminController::class, 'addUser'])->name('admin-add-user');
Route::get('admin/roles', [AdminController::class, 'roles'])->name('admin-roles');
Route::get('admin/permissions', [AdminController::class, 'permissions'])->name('admin-permissions');
Route::get('admin/ipcr', [AdminController::class, 'ipcrView'])->name('admin-ipcr');
Route::get('admin/create', [AdminController::class, 'ipcrCreate'])->name('ipcr-create');
Route::get('admin/form', [AdminController::class, 'ipcrForm'])->name('admin-form');


// ADMIN - POST
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/add-role', [AdminController::class, 'addRole'])->name('admin-add-role');
Route::post('/update-role', [AdminController::class, 'updateRole'])->name('admin-update-role');
Route::post('/add-permission', [AdminController::class, 'addPermission'])->name('admin-add-permission');
Route::post('/update-permission', [AdminController::class, 'updatePermission'])->name('admin-update-permission');