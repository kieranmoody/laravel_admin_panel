<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Models\Company;





Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('landing');
    Route::resource('companies', CompanyController::class);
});

