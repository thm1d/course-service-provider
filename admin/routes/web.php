<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;

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

Route::get('/', [HomeController::class, 'HomeIndex'])->name('home.index');
Route::get('/visitor', [VisitorController::class, 'VisitorIndex'])->name('visitor.index');
Route::get('/service', [ServiceController::class, 'ServiceIndex'])->name('service.index');
Route::get('/getServicesData', [ServiceController::class, 'GetServiceData'])->name('service.data');
Route::post('/serviceDelete', [ServiceController::class, 'ServiceDelete'])->name('service.delete');

Route::post('/serviceUpdate', [ServiceController::class, 'ServiceUpdate'])->name('service.update');
Route::post('/serviceDetails', [ServiceController::class, 'GetServiceDetails'])->name('service.details');

