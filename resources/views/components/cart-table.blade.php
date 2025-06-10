@props(['cartItems'])

<div class="col-12">
    <table class="table" style="border-collapse: collapse; border: none;">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
                <tr>
                    <!-- Produk -->
                    <td class="d-flex align-items-center">
                        <a href="{{ route('products.show', $item->product->id) }}">
                            <img src="{{ asset($item->product->product_image) }}"class="img-thumbnail me-3" alt="Product Image">
                        </a>

                        <div>
                            <a href="{{ route('products.show', $item->product->id) }}" class="link-dark link-offset-2 link-underline link-underline-opacity-0">
                                <strong>{{ $item->product->title }}</strong><br>
                            </a>
                            <span class="text-muted">{{ $item->product->category->name }}</span><br>
                            <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-0 m-0 align-baseline btn btn-link text-decoration-none text-danger">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </td>

                    <!-- Harga -->
                    <td>{{ 'Rp ' . number_format($item->product->price, 2, ',', '.') }}</td>

                    <!-- Jumlah -->
                    <td>
                        <form action="{{ route('cart.update', $item) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <select class="form-select me-2" id="quantitySelect" name="quantity"
                                aria-label="Select quantity" style="width:60px" onchange="this.form.submit()">
                                <option value="1" {{ $item->quantity == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $item->quantity == 2 ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $item->quantity == 3 ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $item->quantity == 4 ? 'selected' : '' }}>4</option>
                                <option value="5" {{ $item->quantity == 5 ? 'selected' : '' }}>5</option>
                            </select>
                        </form>
                    </td>

                    <!-- Total -->
                    <td>{{ 'Rp ' . number_format($item->product->price * $item->quantity, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between">
        <span class="fw-bold">{{ count($cartItems) . ' Items' }}</span>
    </div>
</div>
