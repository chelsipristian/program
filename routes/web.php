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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function(){

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\dashboard\DashboardController::class, 'index'])->name('dashboard');

//Users
Route::get('/dashboard/users', [App\Http\Controllers\dashboard\UserController::class, 'index'])->name('dashboard.users');
Route::get('/dashboard/user/edit/{id}', [App\Http\Controllers\dashboard\UserController::class, 'edit'])->name('dashboard.user.edit');
Route::post('/dashboard/user/update/{id}', [App\Http\Controllers\dashboard\UserController::class, 'update'])->name('dashboard.user.update');
Route::delete('/dashboard/user/delete/{id}', [App\Http\Controllers\dashboard\UserController::class, 'destroy'])->name('dashboard.userdelete');

Route::get('/dashboard/student', [App\Http\Controllers\dashboard\StudentController::class, 'index'])->name('dashboard.student');
Route::get('/dashboard/student/create', [App\Http\Controllers\dashboard\StudentController::class, 'create'])->name('dashboard.student.create');
Route::post('/dashboard/student', [App\Http\Controllers\dashboard\StudentController::class, 'store'])->name('dashboard.student.store');
Route::delete('/dashboard/student{student}', [App\Http\Controllers\dashboard\StudentController::class, 'destroy'])->name('dashboard.student.delete');
Route::get('/dashboard/student/edit/{student}', [App\Http\Controllers\dashboard\StudentController::class, 'edit'])->name('dashboard.student.edit');
Route::put('/dashboard/student/edit/{student}', [App\Http\Controllers\dashboard\StudentController::class, 'update'])->name('dashboard.student.update');
});

