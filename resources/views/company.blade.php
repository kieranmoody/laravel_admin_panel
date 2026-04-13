@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!--Things Changed-->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
            <form method="POST" action="{{ route('companies.destroy', $company) }}">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    Delete Company
                </button>
            </form>
        </div>
        <div class="col-11">
            <form class="resetable-form editing-form" method="POST" action="{{ route('companies.update', $company) }}" enctype="multipart/form-data">
                <div class="card">
                <!--Things Changed-->
                    @csrf
                    @method('PUT')
                    <!-- Hidden field for company_id -->
                    <input type="hidden" name="company_id" value="{{ $company->id }}">

                    <div class="card-header">
                        <input class="form-control card-header fw-bold" name="company_name" type="text" id="company_name" value="{{ $company->name }}">
                    </div>

                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center mb-3">

                            <div id="logo-preview" class="mb-2 rounded-circle border">

                                @if($company->logo)
                                    <img src="{{ asset('storage/' . $company->logo) }}">
                                @endif

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
                                <input class="form-control" name="website" type="text" id="website" value="{{ $company->website }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email:</label>
                                <input class="form-control" name="company_email" type="text" id="company_email" value="{{ $company->email }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description:</label>
                            <textarea class="form-control" name="description" type="text" rows="3" id="description">{{ $company->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <div class="card">
                                <label class="card-header form-label" id="accordion-trigger">Employees:</label>
                                <div class=" accordion-hidden">
                                    <div class="pagination">
                                        {{-- page numbers --}}
                                        @foreach ($employees->getUrlRange(1, $employees->lastPage()) as $page => $url)
                                            <a class="page-link {{ $page == $employees->currentPage() ? 'active' : '' }}"
                                            href="{{ $url }}&open=employees">
                                                {{ $page }}
                                            </a>
                                        @endforeach
                                    </div> 
                                    @forelse($employees as $employee)
                                        <div class="p-3">
                                            <div class="row">
                                                <input type="hidden" name="employees[{{ $employee->id }}][id]" value="{{ $employee->id }}">
                                                <div class="d-flex justify-content-between mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">First Name:</label>
                                                        <input class="form-control" name="employees[{{ $employee->id }}][first_name]" value="{{ $employee->first_name }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Last Name:</label>
                                                        <input class="form-control" name="employees[{{ $employee->id }}][last_name]" value="{{ $employee->last_name }}">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email:</label>
                                                    <input class="form-control" name="employees[{{ $employee->id }}][email]" value="{{ $employee->email }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Phone Number:</label>
                                                    <input class="form-control" name="employees[{{ $employee->id }}][phone_number]" value="{{ $employee->phone_number }}">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <label class="form-label">
                                                        Delete this employee:
                                                        <input type="checkbox" name="employees[{{ $employee->id }}][delete]" value="1">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    @empty
                                        No employees for this company yet.
                                    @endforelse

                                    <div class="d-flex justify-content-center">
                                        @if ($employees->onFirstPage())
                                            <span class="btn btn-secondary disabled">Previous</span>
                                        @else
                                            <a class="btn btn-primary" href="{{ $employees->previousPageUrl() }}&open=employees">Previous</a>
                                        @endif

                                        @if ($employees->hasMorePages())
                                            <a class="btn btn-primary ms-2" href="{{ $employees->nextPageUrl() }}&open=employees">Next</a>
                                        @else
                                            <span class="btn btn-secondary ms-2 disabled">Next</span>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        Showing {{ $employees->firstItem() }} - {{ $employees->lastItem() }}
                                        of {{ $employees->total() }} results
                                    </div>
                                </div>
                            </div>
                            <!-- New Employee Inputs -->
                            <div id="new-employee-fields" class="card mt-3">
                                <div class="card-header">
                                    Add New Employee
                                </div>
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
                                        <input type="hidden" name="new_employee[company_id]" value="{{ $company->id }}">
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
                            <small class="text-muted"><span>*</span> Required fields</small>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif (session('success'))
                        <div class="alert alert-success">
                            <div class="mb-0">
                                Edits made successfully!
                            </div>
                        </div>
                    @endif

                    <div>
                        <button type="button" class="btn btn-secondary reset-button">Reset</button>
                    </div>
                </div>
            </form>
  
        </div>
    </div>
</div>
@endsection