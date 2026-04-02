<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Company;


Route::get('/', function () {
    $companies = DB::table('companies')->get();

    #dd($companies);

    return view('landing', ['companies' => $companies,]); 

});

Route::get('/company/{slug}', function ($slug) {
    $company = Company::where('slug', $slug)->with('employees')->first();

    if (!$company) {
        abort(404);
    }

    return view('company', ['company' => $company]);
})->name('company.show');



Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
