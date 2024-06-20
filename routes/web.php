<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', DashboardController::class)->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'storeModules'])->name('profile.store.modules');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // solo podrían entrar los que tengan el rol USER_ROLE
    Route::resource('/question', QuestionController::class);
    Route::get('/my-questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::post('/question/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');
    Route::patch('/question/{question_id}/edit', [QuestionController::class, 'update'])->name('question.update');
    Route::get('/questions/module/{module_id}', [QuestionController::class, 'allByModule'])->name('questions.module');
    Route::get('/questions/pending/module/{module_id}', [QuestionController::class, 'pendingWithPriority'])->name('questions.pending');
    Route::delete('/question/{id}/delete/', [QuestionController::class, 'destroy'])->name('question.destroy');

    Route::resource('/module', ModuleController::class);
    Route::prefix('/module')->group(function () {
        Route::get('{module_id}/add-question', [QuestionController::class, 'create'])->name('question.create');
    });

    Route::get('/module/{module_id}/users', [ModuleController::class, 'usersWithModule'])->name('module.users');


    // solo podrían entrar los que tengan el rol TEACHER_ROLE
    Route::get('/answer/question/{question}/', [AnswerController::class, 'create'])->name('answer.question');
    Route::post('/add/answer', [AnswerController::class, 'store'])->name('answer.store');
    Route::post('/edit/answer/{answer_id}', [AnswerController::class, 'update'])->name('answer.update');
});

require __DIR__ . '/auth.php';
