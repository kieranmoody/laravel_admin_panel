@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $company->name }}
                </div>

                <div class="card-body">
                    <p><strong>ID:</strong> {{ $company->id }}</p>
                    {{ $company->website }}
                    <br>
                    {{ $company->email }}
                    <br>
                    {{ $company->description }}
                    <br>
                    <ul>
                        @forelse($company->employees as $employee)
                            <li>{{ $employee->first_name }} {{ $employee->last_name }} ({{ $employee->email }}) ({{ $employee->phone_number }})</li>
                        @empty
                            <li>No employees for this company yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Back</a>
        </div>
    </div>
</div>
@endsection