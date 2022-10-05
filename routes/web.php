<?php

use App\Http\Controllers\TeacherCourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebsiteController;
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

Route::get('/', [WebsiteController::class, 'home'])->name('home');


Route::prefix('dashboard')->middleware(['auth', 'verified', 'role'])->name('dashboard.')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // Classes
    Route::prefix('class')->name('class.')->group(function(){
        Route::get('/', [TeacherCourseController::class, 'index'])->name('all');
        Route::get('new', [TeacherCourseController::class, 'create'])->name('new');
        Route::post('create', [TeacherCourseController::class, 'store'])->name('create');
        Route::get('edit', [TeacherCourseController::class, 'edit'])->name('edit');
        Route::put('update', [TeacherCourseController::class, 'update'])->name('update');
        Route::delete('delete', [TeacherCourseController::class, 'delete'])->name('delete');
    });
});

require __DIR__.'/auth.php';
