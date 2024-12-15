<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/course', [App\Http\Controllers\LmsCourseController::class, 'index'])->name('lms_course');
    Route::get('/items', [App\Http\Controllers\LmsItemController::class, 'index'])->name('lms_item');
    Route::get('/content', [App\Http\Controllers\LmsContentController::class, 'index'])->name('lms_content');
});
Auth::routes();
Route::get('/learn', [App\Http\Controllers\LmsLearnController::class, 'index'])->name('lms_learn');
Route::get('/lesson', [App\Http\Controllers\LmsLessonController::class, 'index'])->name('lms_lesson');
