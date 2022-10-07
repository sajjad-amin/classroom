<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TeacherCoureseExplore;
use App\Http\Controllers\CourseController;
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
        Route::get('/', [CourseController::class, 'index'])->name('all');
        Route::get('new', [CourseController::class, 'create'])->name('new');
        Route::post('create', [CourseController::class, 'store'])->name('create');
        Route::get('edit/{id}', [CourseController::class, 'edit'])->name('edit');
        Route::put('update', [CourseController::class, 'update'])->name('update');
        Route::delete('delete', [CourseController::class, 'delete'])->name('delete');
        Route::get('/{id}', [CourseController::class, 'open'])->name('open');
    });
    // Post
    Route::prefix('post')->name('post.')->group(function(){
        Route::get('/{id}', [PostController::class, 'index'])->name('open');
        Route::post('create', [PostController::class, 'create'])->name('create');
        Route::get('edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::put('update', [PostController::class, 'update'])->name('update');
        Route::delete('delete', [PostController::class, 'delete'])->name('delete');
    });
});

require __DIR__.'/auth.php';
