<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\IpAddressController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('ip_addresses', IpAddressController::class);

Route::get('/companies/{company}/users', [CompanyController::class, 'users'])->name('companies.users');
Route::post('/companies/{company}/users', [CompanyController::class, 'addUser'])->name('companies.addUser');
Route::delete('/companies/{company}/users/{user}', [CompanyController::class, 'companyUserdestroy']);

Route::resource('companies', CompanyController::class);

Route::resource('packages', PackageController::class);
Route::resource('bills', BillController::class);
