<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\ExamController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\Backend\ExamSettingsController;
use App\Http\Controllers\Backend\AdminDashboardController;

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
    Route::get('/exams/{exam}/edit', [ExamController::class, 'edit'])->name('admin.exams.edit');
    Route::put('/exams/{exam}', [ExamController::class, 'update'])->name('admin.exams.update');
    Route::delete('/exams/{exam}', [ExamController::class, 'destroy'])->name('admin.exams.destroy');
});

// ****** Exam-settings Route ****** //
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('subject', ExamSettingsController::class)
        ->names([
            'index'   => 'admin.subject.index',
            'create'  => 'admin.subject.create',
            'store'   => 'admin.subject.store',
            'show'    => 'admin.subject.show',
            'edit'    => 'admin.subject.edit',
            'update'  => 'admin.subject.update',
            'destroy' => 'admin.subject.destroy',
        ]);
});

require __DIR__.'/auth.php';
