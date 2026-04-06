<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Company;


Route::get('/', function () {
    $companies = DB::table('companies')->get();

    #dd($companies);

    return view('landing', ['companies' => $companies,]); 

});

//Things changed
Route::get('/company/{slug}', function ($slug) {
    $company = \App\Models\Company::where('slug', $slug)
        ->with('employees')
        ->firstOrFail();

    return view('company', ['company' => $company]);
})->name('company.show');

Route::put('/company/{slug}', function ($slug) {

    // Debugging the request data
    //dd(request()->all());

    // Get the company with its employees
    $company = \App\Models\Company::where('slug', $slug)
        ->with('employees')
        ->firstOrFail();

    // Update company details
    $company->update([
        'name' => request('company_name'),
        'website' => request('website'),
        'email' => request('company_email'),
        'description' => request('description'),
    ]);

    // Update existing employees
    foreach (request('employees', []) as $employeeData) {
        if (isset($employeeData['id']) && $employeeData['id'] !== 'new') {
            $employee = \App\Models\Employee::find($employeeData['id']);
            if ($employee) {
                $employee->update([
                    'first_name' => $employeeData['first_name'],
                    'last_name' => $employeeData['last_name'],
                    'email' => $employeeData['email'],
                    'phone_number' => $employeeData['phone_number'],
                ]);
            }
        }
    }

    // Add a new employee if the fields are filled
    if ($newEmployee = request('new_employee')) {
        // Debugging output
        //dd($newEmployee, request()->all());
        // Ensure all fields are present before creating a new employee
        if (!empty($newEmployee['first_name']) && !empty($newEmployee['last_name'])) {
            \App\Models\Employee::create([
                'company_id' => $newEmployee['company_id'],
                'first_name' => $newEmployee['first_name'],
                'last_name' => $newEmployee['last_name'],
                'email' => $newEmployee['email'] ?: null,  // Set null if empty
                'phone_number' => $newEmployee['phone_number'] ?: null,  // Set null if empty
            ]);
            
        }
    }
//$newEmployee['company_id'],
    return redirect()->route('company.show', $company->slug)
                     ->with('success', 'Company updated!');
})->name('company.update');
//Things Changed


Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
