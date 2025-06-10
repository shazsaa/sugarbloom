@extends('layouts.app')

@section('content')
    <!-- Banner -->
    <div class="w-full p-5 mb-5 text-center bg-image"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
           url('customer-assets/new-toko-kue.jpg'); 
           background-repeat: no-repeat; 
           background-size: cover; 
           background-position: center; 
           height: 400px;">
        <div class="d-flex align-items-center h-100">
            <div class="container">
                <h1 class="mb-3 text-white" style="font-size: 6rem;">Our Special Menu</h1>
            </div>
        </div>
    </div>
    <!-- Banner-->

    {{-- Search --}}
    <div class="container mt-4">
        <form method="GET" action="{{ route('shop') }}" class="mb-4 justify-content-between d-flex">
            <div class="input-group" style="width: 250px">
                <input type="search" name="search" id="searchInput" class="form-control form-control-sm"
                    placeholder="Search" aria-label="Search" value="{{ request('search') }}">
                <button type="button" id="searchButton" class="">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <span class="me-2">Sort</span>
                <select class="form-select" name="sort" id="sortSelect">
                    <option value="" {{ request('sort') === null ? 'selected' : '' }}>Default</option>
                    <option value="highest" {{ request('sort') === 'highest' ? 'selected' : '' }}>Highest</option>
                    <option value="lowest" {{ request('sort') === 'lowest' ? 'selected' : '' }}>Lowest</option>
                </select>
            </div>
        </form>
    </div>
    {{-- Search --}}

    {{-- Product --}}
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse ($products as $product)
                <div class="col">
                    <x-product-card :product="$product" />
                </div>
            @empty
                <div class="mx-auto text-center text-secondary-emphasis">
                    @if (Request::get('search'))
                        <h5 class="text-muted">Can't find that plant...</h5>
                        <a href="{{ route('shop') }}" class="btn btn-success btn-sm">Clear search</a>
                    @else
                        <h4>Data Products not yet available.</h4>
                    @endif
                </div>
            @endforelse
        </div>

        <div class="mt-5">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
    {{-- Product --}}
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            function updateUrl() {
                const search = $('#searchInput').val();
                const sort = $('#sortSelect').val();
                let url = "{{ route('shop') }}";

                const params = [];
                if (search) params.push(`search=${encodeURIComponent(search)}`);
                if (sort) params.push(`sort=${encodeURIComponent(sort)}`);

                if (params.length > 0) {
                    url += '?' + params.join('&');
                }

                window.location.href = url;
            }

            $('#sortSelect').change(function() {
                updateUrl();
            });

            $('#searchButton').click(function() {
                updateUrl();
            });
        });
    </script>
@endsection
