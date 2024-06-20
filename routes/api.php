<?php

use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas protegidas
Route::apiResource('questions', QuestionController::class)->middleware('auth:sanctum');;
Route::apiResource('modules', ModuleController::class)->middleware('auth:sanctum');;
Route::apiResource('answers', AnswerController::class)->middleware('auth:sanctum');;
Route::apiResource('users', UserController::class)->middleware('auth:sanctum');;

// rutas desprotegidas
Route::post('login', [LoginController::class, 'login']);
