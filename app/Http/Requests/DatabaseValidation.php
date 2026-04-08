<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DatabaseValidation extends FormRequest
{
    public function authorize(): bool
    {
        // Allow all users for now, adjust if you need authentication
        return true;
    }

    public function rules(): array
{
    return [
        'company_name' => 'required|string|max:255',
        'website' => 'nullable|url|max:255',
        'company_email' => 'nullable|email|max:255',
        'description' => 'nullable|string',

        // Existing employees: only validate if first_name or last_name filled
        'employees.*.first_name' => 'nullable|required_with:employees.*.last_name|string|max:255',
        'employees.*.last_name' => 'nullable|required_with:employees.*.first_name|string|max:255',
        'employees.*.email' => 'nullable|email|max:255',
        'employees.*.phone_number' => 'nullable|numeric',

        // New employee
        'new_employee.first_name' => 'nullable|required_with:new_employee.last_name|string|max:255',
        'new_employee.last_name' => 'nullable|required_with:new_employee.first_name|string|max:255',
        'new_employee.email' => 'nullable|email|max:255',
        'new_employee.phone_number' => 'nullable|numeric',
    ];
}

    public function messages(): array
    {
        return [
            'company_name.required' => 'Company name is required.',
            'company_email.email' => 'Company email must be a valid email address.',

            'employees.*.first_name.required_with' => 'Employee first name is required when last name is filled.',
            'employees.*.last_name.required_with' => 'Employee last name is required when first name is filled.',
            'employees.*.email.email' => 'Employee email must be a valid email address.',
            'employees.*.phone_number.numeric' => 'Employee phone number must be numeric.',

            'new_employee.first_name.required_with' => 'New employee first name is required when last name is filled.',
            'new_employee.last_name.required_with' => 'New employee last name is required when first name is filled.',
            'new_employee.email.email' => 'New employee email must be a valid email address.',
            'new_employee.phone_number.numeric' => 'New employee phone number must be numeric.',
        ];
    }
}
