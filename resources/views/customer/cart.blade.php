@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 fw-bold">Your shopping cart</h2>
        @if (count($cartItems) == 0)
            <div class="py-5 text-center">
                <h4>Cart is empty</h4>
                <a href="{{ route('shop') }}"
                    class="fs-6 link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                    Browse all products
                </a>
            </div>
        @else
            <div class="row">
                <!-- Tabel Produk -->
                <x-cart-table :cartItems="$cartItems" />

                <!-- Rincian Pembayaran -->
                <form action="{{ route('processOrder') }}" method="POST" class="container mt-5">
                    @csrf
                    <!-- Shipping Type -->
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <span>Shipping type</span>
                        <select id="shipping-type" name="shipping_type" class="w-auto form-select ms-3" required>
                            <option value="" selected disabled>Shipping method</option>
                            @foreach ($shippings as $shipping)
                                <option value="{{ $shipping->type }}" data-price="{{ $shipping->price }}">
                                    {{ $shipping->type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Shipping Cost -->
                    <div class="mb-3 d-flex justify-content-between">
                        <span>Shipping cost</span>
                        <span id="shipping-price" class="fw-bold">Rp. 0,00</span>
                        <input type="hidden" id="hidden-shipping-price" name="shipping_price" value="0">
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <span>Payment method</span>
                        <select name="payment" class="w-auto form-select ms-3" required>
                            <option value="Bank Transfer" selected>Bank Transfer</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Cash on Delivery">Cash on Delivery</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Delivery Address</label>
                        <textarea name="address" class="form-control" id="address" rows="3" required></textarea>
                    </div>

                    <!-- Horizontal Line -->
                    <hr class="border opacity-100 border-dark" />

                    <!-- Total Cost -->
                    <div class="py-3 d-flex justify-content-between fw-bold">
                        <span>Total Cost</span>
                        <span id="total-cost">{{ 'Rp. ' . number_format($cartTotal, 2, ',', '.') }}</span>
                        <input type="hidden" id="hidden-total-cost" name="total_cost" value="{{ $cartTotal }}">
                    </div>

                    <!-- Pay Now Button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="px-4 py-2 btn btn-success">Pay Now</button>
                    </div>
                </form>
            </div>
        @endif
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

        $(document).ready(function() {
            const cartTotal = {{ $cartTotal ?? 0 }};

            $('#shipping-type').on('change', function() {
                const selectedOption = $(this).find(':selected');
                const shippingPrice = parseFloat(selectedOption.data('price') || 0);

                $('#shipping-price').text(
                    `Rp. ${shippingPrice.toLocaleString('id-ID', { minimumFractionDigits: 2 })}`);
                $('#hidden-shipping-price').val(shippingPrice);

                const totalCost = cartTotal + shippingPrice;
                $('#total-cost').text(
                    `Rp. ${totalCost.toLocaleString('id-ID', { minimumFractionDigits: 2 })}`);
                $('#hidden-total-cost').val(totalCost);
            });
        });
    </script>
@endsection
