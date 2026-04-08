@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!--Things Changed-->
                <form method="POST" action="{{ route('companies.store') }}">
                    @csrf
                    <!-- Hidden field for company_id -->
                    <input type="hidden" name="company_id" >

                    <div class="card-header">
                        <input class="form-control" name="company_name" type="text" id="company_name">
                    </div>

                    <div class="card-body">
                        <div>
                            <label class="required">Website:</label>
                            <input class="form-control" name="website" type="text" id="website">
                        </div>
                        <br>
                        <div>
                            <label class="required">Email:</label>
                            <input class="form-control" name="company_email" type="text" id="company_email">
                        </div>
                        <br>
                        <div>
                            <label class="required">Description:</label>
                            <input class="form-control" name="description" type="text" id="description">
                        </div>
                        <br>
                        <div>
                            <label class="required">Employees:</label>
                            <!-- New Employee Inputs -->
                            <div id="new-employee-fields" class="mt-3">
                                <h5>Add New Employee</h5>
                                <input class="form-control" name="new_employee[first_name]" placeholder="First Name">
                                <input class="form-control" name="new_employee[last_name]" placeholder="Last Name">
                                <input class="form-control" name="new_employee[email]" placeholder="Email">
                                <input class="form-control" name="new_employee[phone_number]" placeholder="Phone Number">
                                <!-- Include company_id within the new_employee array -->
                                <input type="hidden" name="new_employee[company_id]">
                            </div> 
                        </div>
                    </div>
                    <div id="form-submit">
                        <button type="submit" id="form-button">Confirm Changes</button>
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
                </form>             
            </div>
            
            <!--Things Changed-->
            <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Back</a>
        </div>
    </div>
</div>
@endsection