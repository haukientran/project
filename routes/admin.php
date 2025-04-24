<?php

use Illuminate\Support\Facades\Route;
use Project\Controllers\ProjectController;
use Project\Controllers\ExpenseController;

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::resource('projects', ProjectController::class)->names('admin.projects');
    Route::get('build-demo', [ProjectController::class, 'buildDemo'])->name('admin.build.demo');
    Route::post('build-demo', [ProjectController::class, 'processBuildDemo'])->name('admin.build.demo.process');
    Route::get('expenses/summary', [ExpenseController::class, 'summary'])->name('admin.expenses.summary');
    Route::resource('expenses', ExpenseController::class)->names('admin.expenses');
});