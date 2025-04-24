<?php

use Illuminate\Support\Facades\Route;
use Project\Controllers\ProjectController;
use Project\Controllers\ExpenseController;

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::resource('projects', ProjectController::class)->names('admin.projects');
    Route::get('expenses/summary', [ExpenseController::class, 'summary'])->name('admin.expenses.summary');
    Route::resource('expenses', ExpenseController::class)->names('admin.expenses');
});