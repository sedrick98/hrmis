<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\SignatoryController;
use App\Http\Controllers\IPCRController;

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

// ADMIN - POST
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/add-role', [AdminController::class, 'addRole'])->name('admin-add-role');
Route::post('/update-role', [AdminController::class, 'updateRole'])->name('admin-update-role');
Route::post('/add-permission', [AdminController::class, 'addPermission'])->name('admin-add-permission');
Route::post('/update-permission', [AdminController::class, 'updatePermission'])->name('admin-update-permission');

// SIGNATORIES - GET
Route::get('signatory/divisions', [SignatoryController::class, 'divisions'])->name('signatory-divisions');
Route::get('signatory/divisions/sections', [SignatoryController::class, 'sections'])->name('signatory-sections');
Route::get('signatory/divisions/assignments', [SignatoryController::class, 'assignments'])->name('signatory-assignments');

// SIGNATORIES - POST
Route::post('signatory/divisions', [SignatoryController::class, 'divisions'])->name('signatory-divisions');
Route::post('signatory/divisions/sections', [SignatoryController::class, 'sections'])->name('signatory-sections');
Route::post('signatory/divisions/assignments', [SignatoryController::class, 'assignments'])->name('signatory-assignments');

// IPCR - GET
Route::get('ipcr/submitted', [IPCRController::class, 'ipcrSubmitted'])->name('ipcr-submitted');
Route::get('ipcr/create', [IPCRController::class, 'ipcrForm'])->name('ipcr-create');
Route::get('ipcr/Approval', [IPCRController::class, 'ipcrApproval'])->name('ipcr-approval');
Route::get('edit/{ipcr_id}', [IPCRController::class, 'displayData']);
Route::get('rate/{ipcr_id}', [IPCRController::class, 'rateData']);
Route::get('display/{ipcr_id}', [IPCRController::class, 'viewData']);
//Route::get('/view/pdf', [IPCRController::class, 'createPDF'])->name('ipcr-pdf');
Route::get('review/{ipcr_id}', [IPCRController::class, 'reviewData']);
Route::get('view/{ipcr_id}', [IPCRController::class, 'displayPDF']);
Route::get('delete/{ipcr_id}', [IPCRController::class, 'deleteIPCR']);  

//IPCR - POST
Route::post('ipcr/create', [IPCRController::class, 'saveIPCR'])->name('ipcr-save');
Route::post('ipcr/update', [IPCRController::class, 'updateIPCR'])->name('ipcr-update');
Route::post('ipcr/rate', [IPCRController::class, 'rateIPCR'])->name('ipcr-rate');
Route::post('ipcr/approve', [IPCRController::class, 'approveIPCR'])->name('ipcr-approve');

// LEAVE REQUEST - GET
Route::get('leave/create', [LeaveController::class, 'create'])->name('leave-create');
Route::get('leave/all', [LeaveController::class, 'all'])->name('leave-all');
Route::get('leave/view/{leave_request}', [LeaveController::class, 'view'])->name('leave-view');

// LEAVE REQUEST FOR APPROVAL - GET
Route::get('leave/approvals/all', [LeaveController::class, 'allApprovals'])->name('leave-approval');
Route::get('leave/print/{leave_request}', [LeaveController::class, 'printLeaveRequest'])->name('leave-print');

// LEAVE REQUEST FOR APPROVAL - POST
Route::post('leave/approvals/{approval}', [LeaveController::class, 'approvalUpdate'])->name('leave-approval-update');
Route::post('leave/approvals/reject/{approval}', [LeaveController::class, 'rejectApproval'])->name('leave-reject-approval');

// LEAVE REQUEST - POST
Route::post('leave/create', [LeaveController::class, 'create'])->name('leave-create');