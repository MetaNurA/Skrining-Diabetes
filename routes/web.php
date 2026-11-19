<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkriningController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('skrining.create');
});

Route::prefix('skrining')->name('skrining.')->group(function () {
    Route::get('/',  [SkriningController::class, 'create'])->name('create');
    Route::post('/', [SkriningController::class, 'store'])->name('store');
    Route::get('/pdf', [SkriningController::class, 'downloadPdf'])->name('pdf');
});