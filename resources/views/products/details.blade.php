@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if ($inWishlist)
            <form action="{{ route('wishlist.destroy', $product->id) }}" method="POST" class="float-end">
                @csrf
                @method('DELETE')

                <button type="submit" class="p-0 m-0 align-baseline btn btn-link text-decoration-none">
                    <i class="fa-solid fa-heart fa-xl" style="color: #d61c1c"></i>
                </button>
            </form>
        @else
            <form action="{{ route('wishlist.store', $product->id) }}" method="POST" class="float-end">
                @csrf
                <button type="submit" class="p-0 m-0 align-baseline btn btn-link text-decoration-none">
                    <i class="fa-regular fa-heart fa-xl" style="color: #0a0a0a"></i>
                </button>
            </form>
        @endif

        <form action="{{ route('cart.store') }}" method="POST">
            @csrf

            <input type="hidden" value="{{ $product->id }}" id="product_id" name="product_id">

            <div class="row">
                <!-- Bagian Kiri: Gambar Produk -->
                <div class="col-md-6">
                    <div class="d-flex flex-column align-items-center">
                        <!-- Gambar utama -->
                        <img src="{{ asset($product->product_image) }}" class="border rounded-4 img-fluid"
                            alt="Main Product" style="width: 70%;">
                    </div>
                </div>

                <!-- Bagian Kanan: Detail Produk -->
                <div class="col-md-6">
                    <div class="product-details">
                        <!-- Judul Produk -->
                        <h2 class="fw-bold">{{ $product->title }}</h2>

                        <h5 class="fw-bold"> Description</h5>

                        <!-- Deskripsi -->
                        <p class="text-muted">
                            {{ $product->description }}
                        </p>

                        <!-- Quantity dan Tombol Add to Cart -->
                        <div class="mt-3 d-flex align-items-center">
                            <label for="quantity" class="me-3 fw-bold">Quantity:</label>
                            <select class="form-select me-2" id="quantity" name="quantity"
                                aria-label="Floating label select example" style="width:60px">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <button class="btn fw-medium btn-success" type="submit">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-5">
        <h3 class="fw-bold">Similar Plants</h3>
        <div class="row">
            @forelse ($similar_products as $similar_product)
                <div class="col">
                    <x-product-card :product="$similar_product" />
                </div>
            @empty
                <div class="mt-3 text-center text-muted">
                    <h5>this plant does not have similar plants yet</h5>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: "error",
                title: "Fail!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
@endsection
