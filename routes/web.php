<?php

use App\Http\Controllers\IpAddressController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::resource('roles', RoleController::class);
Route::resource('ip_addresses', IpAddressController::class);
