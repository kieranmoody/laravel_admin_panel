@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="d-flex justify-content-between align-items-center mb-2">

                <div class="pagination">
                    {{-- page numbers --}}
                    @foreach ($companies->getUrlRange(1, $companies->lastPage()) as $page => $url)
                        <a class="page-link {{ $page == $companies->currentPage() ? 'active' : '' }}"
                        href="{{ $url }}">
                            {{ $page }}
                        </a>
                    @endforeach
                </div>

            </div>
            @if ($companies->count())
                @foreach($companies as $company)
                    <div class="col-md-6 mb-4 card-height company">
                        <a href="{{ route('companies.show', $company) }}">
                            <div class="card h-100 lift">
                                <div class="d-flex justify-content-between card-header">
                                    <div>{{ $company->name }}</div>
                                    <div class="mb-2 rounded-circle border company-logo">
                                        @if($company->logo)
                                            <img src="{{ asset('storage/' . $company->logo) }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column justify-content-center text-center">
                                    <p>{{ $company->website }}</p>
                                    <p>{{ $company->email }}</p>
                                    <p>{{ Str::limit($company->description, 100, '...') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
            
        </div>
        <div class="row g-4 justify-content-center">
            <a class="col-md-6 mb-4 card lift" id="new-company" href="{{ route('companies.create') }}">
                <div class="card-body h-100 text-center">
                    +
                </div>
            </a>
        </div>
    </div>
    <div class="d-flex justify-content-center pagination-buttons">
        @if ($companies->onFirstPage())
            <span class="btn btn-secondary disabled">Previous</span>
        @else
            <a class="btn btn-primary" href="{{ $companies->previousPageUrl() }}">Previous</a>
        @endif

        @if ($companies->hasMorePages())
            <a class="btn btn-primary ms-2" href="{{ $companies->nextPageUrl() }}">Next</a>
        @else
            <span class="btn btn-secondary ms-2 disabled">Next</span>
        @endif
    </div>
    <div class="d-flex justify-content-center">
        Showing {{ $companies->firstItem() }} - {{ $companies->lastItem() }}
        of {{ $companies->total() }} results
    </div>
</main>
@endsection
