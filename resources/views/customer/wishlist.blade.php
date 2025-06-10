@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h3 class="mb-4 fw-semibold">Wishlist</h3>
    </div>

    {{-- Search --}}
    @if ($wishlists->isNotEmpty() || Request::get('search'))
        <div class="container mt-4">
            <form method="GET" action="{{ route('wishlist') }}" class="mb-4 justify-content-between d-flex">
                <div class="input-group" style="width: 250px; height: 35px">
                    <input type="search" name="search" id="searchInput" class="form-control form-control-sm"
                        placeholder="Search" aria-label="Search" value="{{ request('search') }}">
                    <button type="button" id="searchButton" class="btn btn-success btn-sm">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    @endif
    {{-- Search --}}

    {{-- Product --}}
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse ($wishlists as $item)
                <div class="col">
                    <a href="{{ route('products.show', $item->product->id) }}"
                        class="link-underline link-underline-opacity-0">
                        <div class="bg-transparent border-0 card">
                            <img src="{{ asset($item->product->product_image) }}" class="card-img-top rounded-4"
                                alt="card example" />
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->product->title }}</h5>
                                <p class="card-text">{{ 'Rp ' . number_format($item->product->price, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="mx-auto text-center text-secondary-emphasis">
                    @if (Request::get('search'))
                        <h5 class="text-muted">Can't find that plant...</h5>
                        <a href="{{ route('wishlist') }}" class="btn btn-success btn-sm">Clear search</a>
                    @else
                        <h4>Your wishlist is empty</h4>
                        <a href="{{ route('shop') }}"
                            class="fs-6 link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                            Explore our products
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        <div class="mt-5">
            {{ $wishlists->links('pagination::bootstrap-5') }}
        </div>
    </div>
    {{-- Product --}}
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            function updateUrl() {
                const search = $('#searchInput').val();
                let url = "{{ route('wishlist') }}";

                const params = [];
                if (search) params.push(`search=${encodeURIComponent(search)}`);

                if (params.length > 0) {
                    url += '?' + params.join('&');
                }

                window.location.href = url;
            }

            $('#searchButton').click(function() {
                updateUrl();
            });
        });
    </script>
@endsection
