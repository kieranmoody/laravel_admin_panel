@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <!--Things Changed-->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
            </div>
            <div class="col-11">
                <!--Things Changed-->
                <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
                    <div class="card">
                        @csrf
                        <!-- Hidden field for company_id -->
                        <input type="hidden" name="company_id" >

                        <div class="card-header">
                            <input class="form-control card-header fw-bold" name="company_name" type="text" id="company_name" value="{{ old('company_name') }}">
                        </div>

                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center mb-3">

                                <div id="logo-add-preview" class="mb-2 rounded-circle border">

                                    <div id="logo-preview" class="mb-2 rounded-circle border">
                                    </div>

                                </div>

                                <!-- Hidden file input -->
                                <input type="file" id="logo-input" name="logo" accept="image/*" hidden>

                                <!-- Button -->
                                <button type="button" class="btn btn-dark"
                                        onclick="document.getElementById('logo-input').click()">
                                    Upload Logo
                                </button>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Website:</label>
                                    <input class="form-control" name="website" type="text" id="website" value="{{ old('website') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email:</label>
                                    <input class="form-control" name="company_email" type="text" id="company_email" value="{{ old('company_email') }}">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Description:</label>
                                <textarea class="form-control" name="description" type="text" rows="3" id="description">{{ old('description') }}</textarea>
                            </div>

                            <div id="new-employee-fields" class="card mt-3">
                                <div class="card-header">
                                    Add Employee
                                </div>
                                <!-- New Employee Inputs -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="col-md-6">
                                                <input class="form-control" name="new_employee[first_name]" placeholder="First Name" value="{{ old('new_employee.first_name') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control" name="new_employee[last_name]" placeholder="Last Name" value="{{ old('new_employee.last_name') }}">
                                            </div>
                                        </div>
                                            <div class="mb-2">
                                                <input class="form-control" name="new_employee[email]" placeholder="Email" value="{{ old('new_employee.email') }}">
                                            </div>
                                            <div>
                                                <input class="form-control" name="new_employee[phone_number]" placeholder="Phone Number" value="{{ old('new_employee.phone_number') }}">
                                            </div>

                                            <!-- Include company_id within the new_employee array -->
                                            <input type="hidden" name="new_employee[company_id]">
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-between align-items-start gap-3">
                        <div id="form-submit">
                            <button type="submit" class="btn btn-primary px-4" id="form-button">Confirm Changes</button>
                            <div>
                                <p><span>*</span> Fields Required</p>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </form>             
            </div>
        </div>
    </div>
</main>
@endsection