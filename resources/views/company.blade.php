@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!--Things Changed-->
                <form method="POST" action="{{ route('company.update', $company->slug) }}">
                    @csrf
                    @method('PUT')
                    <!-- Hidden field for company_id -->
                    <input type="hidden" name="company_id" value="{{ $company->id }}">

                    <div class="card-header">
                        <input class="form-control" name="company_name" type="text" id="company_name" value="{{ $company->name }}">
                    </div>

                    <div class="card-body">
                        <div>
                            <label class="required">Website:</label>
                            <input class="form-control" name="website" type="text" id="website" value="{{ $company->website }}">
                        </div>
                        <br>
                        <div>
                            <label class="required">Email:</label>
                            <input class="form-control" name="company_email" type="text" id="company_email" value="{{ $company->email }}">
                        </div>
                        <br>
                        <div>
                            <label class="required">Description:</label>
                            <input class="form-control" name="description" type="text" id="description" value="{{ $company->description }}">
                        </div>
                        <br>
                        <div>
                            <label class="required">Employees:</label>
                            <ul>
                                @forelse($company->employees as $employee)
                                    <li>
                                        <input type="hidden" 
                                            name="employees[{{ $employee->id }}][id]" 
                                            value="{{ $employee->id }}">

                                        <input class="form-control"
                                            name="employees[{{ $employee->id }}][first_name]"
                                            value="{{ $employee->first_name }}">

                                        <input class="form-control"
                                            name="employees[{{ $employee->id }}][last_name]"
                                            value="{{ $employee->last_name }}">

                                        <input class="form-control"
                                            name="employees[{{ $employee->id }}][email]"
                                            value="{{ $employee->email }}">

                                        <input class="form-control"
                                            name="employees[{{ $employee->id }}][phone_number]"
                                            value="{{ $employee->phone_number }}">
                                    </li>
                                @empty
                                    <li>No employees for this company yet.</li>
                                @endforelse

                            </ul>
                            <!-- New Employee Inputs -->
                            <div id="new-employee-fields" class="mt-3">
                                <h5>Add New Employee</h5>
                                <input class="form-control" name="new_employee[first_name]" placeholder="First Name" value="{{ old('new_employee.first_name') }}">
                                <input class="form-control" name="new_employee[last_name]" placeholder="Last Name" value="{{ old('new_employee.last_name') }}">
                                <input class="form-control" name="new_employee[email]" placeholder="Email" value="{{ old('new_employee.email') }}">
                                <input class="form-control" name="new_employee[phone_number]" placeholder="Phone Number" value="{{ old('new_employee.phone_number') }}">
                                <!-- Include company_id within the new_employee array -->
                                <input type="hidden" name="new_employee[company_id]" value="{{ $company->id }}">
                            </div> 
                        </div>
                    </div>
                    <div id="form-submit">
                        <button type="submit" id="form-button">Confirm Changes</button>
                        <div>
                            <p><span>*</span> Fields Required</p>
                        </div>
                    </div>
                </form>
                <!--Things Changed-->
            </div>
            <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Back</a>
        </div>
    </div>
</div>
@endsection