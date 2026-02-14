<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\ExamController as FrontendExamController;
use App\Http\Controllers\Backend\ExamController as BackendExamController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ExamSettingsController;
use App\Http\Controllers\Backend\AdminDashboardController;
use App\Http\Controllers\Backend\UserController;

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
    Route::get('/profile/edit/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/exams', [FrontendExamController::class, 'exam'])->name('exam');
Route::middleware('auth')->group(function () {
    Route::get('/exam/{id}/rules', [FrontendExamController::class, 'rules'])->name('exam.rules');
    Route::get('/exam/{id}/start', [FrontendExamController::class, 'start'])->name('exam.start');
    Route::get('/exam/{id}/result', [FrontendExamController::class, 'result'])->name('exam.result');
});

//=================================*** Backend Routes ***====================================//
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

    // ****** Questions ******* //
    Route::get('/questions', [QuestionController::class, 'index'])->name('admin.question.index');
    Route::post('/questions/import', [QuestionController::class, 'store'])->name('admin.question.import');
});

// ****** Exam Route ****** //
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/exams', [BackendExamController::class, 'index'])->name('admin.exams.index');
    Route::get('/exams/create', [BackendExamController::class, 'create'])->name('admin.exams.create');
    Route::post('/exams/store', [BackendExamController::class, 'store'])->name('admin.exams.store');
    Route::get('/exams/{exam}/edit', [BackendExamController::class, 'edit'])->name('admin.exams.edit');
    Route::put('/exams/{exam}', [BackendExamController::class, 'update'])->name('admin.exams.update');
    Route::delete('/exams/{exam}', [BackendExamController::class, 'destroy'])->name('admin.exams.destroy');
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

// ****** User mangement Route ****** //
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('user', UserController::class)
        ->names([
            'index'   => 'admin.user.index',
            'create'  => 'admin.user.create',
            'store'   => 'admin.user.store',
            'show'    => 'admin.user.show',
            'edit'    => 'admin.user.edit',
            'update'  => 'admin.user.update',
            'destroy' => 'admin.user.destroy',
        ]);
    Route::post('users/{user}/assign-role', [UserController::class, 'assignRole']) ->name('admin.users.assignRole');
});

// ***** Role Permission Route *****//
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('roles', RoleController::class)
        ->names([
            'index'   => 'admin.roles.index',
            'create'  => 'admin.roles.create',
            'store'   => 'admin.roles.store',
            'edit'    => 'admin.roles.edit',
            'update'  => 'admin.roles.update',
            'destroy' => 'admin.roles.destroy',
        ]);

    Route::resource('permissions', PermissionController::class)
        ->names([
            'index'   => 'admin.permissions.index',
            'create'  => 'admin.permissions.create',
            'store'   => 'admin.permissions.store',
            'edit'    => 'admin.permissions.edit',
            'update'  => 'admin.permissions.update',
            'destroy' => 'admin.permissions.destroy',
        ]);
});

require __DIR__.'/auth.php';
