<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Form\AssessmentController;
use App\Http\Controllers\Master\QuestionController;

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

Route::get('/', [AuthController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::resource('master/question', QuestionController::class);
    Route::post('master/question_detail', [QuestionController::class, 'update_detail'])->name('question_detail');
    Route::post('master/update_detail_delete_question', [QuestionController::class, 'update_detail_delete_question'])->name('update_detail_delete_question');
    
    // Route::resource('form/assessment', AssessmentController::class);
    Route::get('form/assessment', [AssessmentController::class, 'index'])->name('assessment.index');
    Route::post('form/assessment', [AssessmentController::class, 'store'])->name('assessment.store');
    Route::get('form/assessment/assessment_exam/{id}', [AssessmentController::class, 'assessment_exam'])->name('assessment.exam');
    Route::post('form/assessment/assessment_exam/update_start_time', [AssessmentController::class, 'update_start_time'])->name('assessment.update_start_time');
    Route::post('form/assessment/assessment_exam/autosave', [AssessmentController::class, 'autosave'])->name('assessment.autosave');
    Route::get('form/history', [AssessmentController::class, 'history'])->name('assessment.history');
});

// Route::middleware('guest')->group(function () {
    // Route Login
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'store_login'])->name('store_login');
    
    // Route Register
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'store_register'])->name('store_register');
    
    // Route Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
// });