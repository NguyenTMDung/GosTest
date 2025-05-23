<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamScoreController;
use App\Http\Controllers\ReportController;


Route::get('/', function () {
    return view('pages.checkScore');
});

Route::get('/check-score', [ExamScoreController::class, 'showForm'])->name('check.score.form');
Route::post('/check-score', [ExamScoreController::class, 'check'])->name('check.score');
Route::get('/report', [ReportController::class, 'report'])->name('report');
