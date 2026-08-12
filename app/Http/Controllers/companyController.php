<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Http\Requests\DatabaseValidation;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = auth()->user()->companies()->paginate(10);
        return view('landing', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('newCompany');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DatabaseValidation $request)
    {
        // Create company
        $company = auth()->user()->companies()->create([
            'name' => $request->company_name,
            'website' => $request->website,
            'email' => $request->company_email,
            'description' => $request->description,
            'slug' => \Str::slug($request->company_name),
        ]);
        // Handle logo upload
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');

            $company->logo = $path;
            $company->save();
        }

        // Create employee if provided
        if ($newEmployee = $request->new_employee) {
            if (!empty($newEmployee['first_name']) && !empty($newEmployee['last_name'])) {
                Employee::create([
                    'company_id' => $company->id,
                    'first_name' => $newEmployee['first_name'],
                    'last_name' => $newEmployee['last_name'],
                    'email' => $newEmployee['email'] ?: null,
                    'phone_number' => $newEmployee['phone_number'] ?: null,
                ]);
            }
        }

        return redirect()
            ->route('companies.show', $company)
            ->with('success', 'Company created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        if ($company->user_id !== auth()->id()) {
            abort(403);
        }

        $employees = $company->employees()->paginate(10);

        return view('company', compact('company', 'employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DatabaseValidation $request, Company $company)
    {
        if ($company->user_id !== auth()->id()) {
            abort(403);
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {

            // Optional: delete old logo
            if ($company->logo) {
                \Storage::disk('public')->delete($company->logo);
            }

            // Store new logo
            $path = $request->file('logo')->store('logos', 'public');

            // Save to database
            $company->update([
                'logo' => $path
            ]);
        }

        $company->update([
            'name' => $request->company_name,
            'website' => $request->website,
            'email' => $request->company_email,
            'description' => $request->description,
            'slug' => \Str::slug($request->company_name),
        ]);

        

        // Update employees
        foreach ($request->employees ?? [] as $employeeData) {
            if (isset($employeeData['id'])) {
                $employee = Employee::find($employeeData['id']);
                if ($employee) {
                    // ✅ DELETE
                    if (isset($employeeData['delete']) && $employeeData['delete'] == 1) {
                        $employee->delete();
                        continue; // skip update
                    }

                    $employee->update([
                        'first_name' => $employeeData['first_name'],
                        'last_name' => $employeeData['last_name'],
                        'email' => $employeeData['email'],
                        'phone_number' => $employeeData['phone_number'],
                    ]);
                }
            }
        }
        
        // New employee
        if ($newEmployee = $request->new_employee) {
            if (!empty($newEmployee['first_name']) && !empty($newEmployee['last_name'])) {
                Employee::create([
                    'company_id' => $company->id,
                    'first_name' => $newEmployee['first_name'],
                    'last_name' => $newEmployee['last_name'],
                    'email' => $newEmployee['email'] ?: null,
                    'phone_number' => $newEmployee['phone_number'] ?: null,
                ]);
            }
        }

        return redirect()
            ->route('companies.show', $company->slug)
            ->with('success', 'Company updated!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Company $company)
    {
        if ($company->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        if ($company->logo) {
            \Storage::disk('public')->delete($company->logo);
        }
        
        $company->delete();

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company deleted!');
    }
}
