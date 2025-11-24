<?php

use App\Http\Controllers\Backend\AdminDashboardController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ExamController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

    // ****** Questions ******* //
    Route::get('/questions', [QuestionController::class, 'index'])->name('admin.question.index');
    Route::post('/questions/import', [QuestionController::class, 'store'])->name('admin.question.import');
});

// ****** Exam Route ****** //
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/exams', [ExamController::class, 'index'])->name('admin.exams.index');
    Route::get('/exams/create', [ExamController::class, 'create'])->name('admin.exams.create');
    Route::post('/exams/store', [ExamController::class, 'store'])->name('admin.exams.store');
});

require __DIR__.'/auth.php';
