<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentCourseController;
use App\Http\Controllers\StudentPostController;
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

Route::prefix('chat')->name('chat.')->group(function(){
    Route::get('/get/{course_id}/{offset}', [ChatController::class, 'getMessages'])->name('get');
    Route::post('/send', [ChatController::class, 'send'])->name('send');
});

Route::prefix('class')->middleware(['auth'])->name('class.')->group(function(){
    Route::get('/{id}', [StudentCourseController::class, 'index'])->name('open');
    Route::post('/join', [MemberController::class, 'joinCourse'])->name('join');
    Route::delete('/leave', [MemberController::class, 'leaveCourse'])->name('leave');
    Route::get('/{id}/student', [StudentCourseController::class, 'listStudent'])->name('students');
    Route::prefix('post')->name('post.')->group(function(){
        Route::get('/{id}', [StudentPostController::class, 'index'])->name('index');
        Route::post('comment/create', [CommentController::class, 'create'])->name('comment.create');
        Route::delete('comment/delete', [CommentController::class, 'destroy'])->name('comment.delete');
    });
});

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
        Route::put('{id}/student/move', [SectionController::class, 'moveStudent'])->name('student.move');
        Route::delete('{id}/student/remove', [CourseController::class, 'removeStudent'])->name('student.remove');
        Route::get('{id}/section/{section}', [SectionController::class, 'index'])->name('section.open');
        Route::post('{id}/section/add', [SectionController::class, 'addSection'])->name('section.add');
    });
    // Post
    Route::prefix('post')->name('post.')->group(function(){
        Route::get('/{id}', [PostController::class, 'index'])->name('open');
        Route::post('create', [PostController::class, 'create'])->name('create');
        Route::get('edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::put('update', [PostController::class, 'update'])->name('update');
        Route::delete('delete', [PostController::class, 'delete'])->name('delete');
        Route::post('comment/create', [PostController::class, 'createComment'])->name('comment.create');
        Route::delete('comment/delete', [PostController::class, 'deleteComment'])->name('comment.delete');
    });
});

require __DIR__.'/auth.php';
