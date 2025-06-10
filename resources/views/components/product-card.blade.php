@props(['product'])

<a href="{{ route('products.show', $product->id) }}" class="link-underline link-underline-opacity-0">
    <div class="bg-transparent border-0 card">
        <img src="{{ asset($product->product_image) }}" class="card-img-top rounded-4" alt="card example" />
        <div class="card-body">
            <h5 class="card-title">{{ $product->title }}</h5>
            <p class="card-text">{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</p>
        </div>
    </div>
</a>
