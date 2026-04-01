<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

use App\Models\Quiz;

Route::get('/', function () {
    return redirect('/quizzes');
});

Route::get('/quiz/create', [QuizController::class, 'create']);
Route::post('/quiz/store', [QuizController::class, 'store']);

Route::get('/quizzes', [QuizController::class, 'index']);

Route::get('/quiz/{id}/questions', [QuizController::class, 'addQuestions']);
Route::post('/quiz/{id}/questions', [QuizController::class, 'storeQuestion']);

Route::get('/quiz/{id}/attempt', [QuizController::class, 'attempt']);
Route::post('/quiz/{id}/submit', [QuizController::class, 'submitQuiz']);