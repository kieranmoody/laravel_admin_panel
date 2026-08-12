<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DatabaseValidation extends FormRequest
{
    public function authorize(): bool
    {
        // Allow all users for now, adjust if you need authentication
        return true;
    }

    public function rules(): array
{  
    //dd($this->all());
    return [
        'company_name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('companies', 'name')->ignore($this->route('company')),
        ],
        'website' => 'nullable|url|max:255',
        'company_email' => 'nullable|email|max:255',
        'description' => 'nullable|string',

        'logo' => ['nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:min_width=100,min_height=100'],

        // Existing employees: only validate if first_name or last_name filled
        'employees.*.first_name' => 'required_unless:employees.*.delete,1|string|max:255',
        'employees.*.last_name' => 'required_unless:employees.*.delete,1|string|max:255',
        'employees.*.email' => 'nullable|email|max:255',
        'employees.*.phone_number' => 'nullable|numeric',

        // New employee
        'new_employee.first_name' => [
            'nullable',
            'required_with:new_employee.last_name,new_employee.email,new_employee.phone_number',
            'string',
            'max:255',
        ],

        'new_employee.last_name' => [
            'nullable',
            'required_with:new_employee.first_name,new_employee.email,new_employee.phone_number',
            'string',
            'max:255',
        ],
        'new_employee.email' => 'nullable|email|max:255',
        'new_employee.phone_number' => 'nullable|numeric',
    ];
}

    public function messages(): array
    {
        return [
            'company_name.required' => 'Company name is required.',
            'company_email.email' => 'Company email must be a valid email address.',
            'company_name.unique' => 'A company with this name already exists.',

            'employees.*.first_name.required' => 'Employee first name is required.',
            'employees.*.last_name.required' => 'Employee last name is required.',
            'employees.*.email.email' => 'Employee email must be a valid email address.',
            'employees.*.phone_number.numeric' => 'Employee phone number must be numeric.',
            'employees.*.last_name.required_unless' => 'An employee must have a last name',
            'employees.*.first_name.required_unless' => 'An employee must have a first name',

            'new_employee.first_name.required_with' => 'New employee first name is required.',
            'new_employee.last_name.required_with' => 'New employee last name is required.',
            'new_employee.email.email' => 'New employee email must be a valid email address.',
            'new_employee.phone_number.numeric' => 'New employee phone number must be numeric.',

            'logo.image' => 'The logo must be an image file.',
            'logo.mimes' => 'The logo must be a JPEG, PNG, JPG, or WEBP file.',
            'logo.max' => 'The logo must not be larger than 2MB.',
            'logo.dimensions' => 'The logo must be at least 100x100 pixels.',
        ];
    }
}
