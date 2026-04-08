@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($companies->count())
                @foreach($companies as $company)
                    <a href="{{ route('companies.show', $company) }}">
                        <div class="card">
                            <div class="card-header">{{ $company->name }}</div>

                            <div class="card-body">
                                {{ $company->website }}
                                <br>
                                {{ $company->email }}
                                <br>
                                {{ $company->description }}
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
            <div>
                <a href="{{ route('companies.create') }}">
                    +
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
