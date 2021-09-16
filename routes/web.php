<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/home', function () {
    return view('home');
});


Route::get('/dashboard', function () {
    return view('admin/dashboard');
}); 

Route::get('/roles', function () {
    return view('admin/roles');
}); 

Route::get('/users', function () {
    return view('admin/users');
}); 









Route::get('/login', function () {
   return view('auth/login');
});

Route::get('/register', function () {
   return view('auth/register');
});

Route::get('/admin-dashboard', function () {
   return view('admin-dashboard');
});

Route::get('/admin-dashboard', function () {
   return view('admin/roles');
});