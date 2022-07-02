<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CourseController;

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
Route::post('/serviceAdd', [ServiceController::class, 'ServiceAdd'])->name('service.add');
Route::post('/serviceUpdate', [ServiceController::class, 'ServiceUpdate'])->name('service.update');
Route::post('/serviceDetails', [ServiceController::class, 'GetServiceDetails'])->name('service.details');



Route::get('/course', [CourseController::class, 'CourseIndex'])->name('course.index');
Route::get('/getCoursesData', [CourseController::class, 'GetCoursesData'])->name('course.data');
Route::post('/courseDelete', [CourseController::class, 'CourseDelete'])->name('course.delete');
Route::post('/courseAdd', [CourseController::class, 'CourseAdd'])->name('course.add');
Route::post('/courseUpdate', [CourseController::class, 'CourseUpdate'])->name('course.update');
Route::post('/courseDetails', [CourseController::class, 'GetCourseDetails'])->name('course.details');
