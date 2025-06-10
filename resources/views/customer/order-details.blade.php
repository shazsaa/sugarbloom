@extends('layouts.app')
@section('content')
    <div class="container">
        <!-- Order History -->
        <div class="mb-4">
            <a class="link-offset-2 link-underline link-underline-opacity-0 text-dark" href="{{ route('orderHistory') }}">
                <i class="fa-solid fa-arrow-left-long fa-xl"></i>
                <span class="text-center fs-5 ms-1">
                    Back to history
                </span>
            </a>
        </div>

        <h3 class="mb-4 fw-bold">{{ 'Order #' . $order->id }}</h3>
        <div class="p-4 card">
            <div class="table-responsive">
                <table class="table align-middle table-borderless">
                    <thead>
                        <tr class="border-bottom">
                            <th>{{ count($order->items) > 1 ? 'Items' : 'Item' }}</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="d-flex align-items-center">
                                    <img src="{{ asset($item->product_image) }}"class="img-thumbnail me-3"
                                        alt="Product Image">
                                    <span class="fw-bold">{{ $item->product_title }}</span>
                                </td>
                                <td>{{ 'Rp ' . number_format($item->product_price, 2, ',', '.') }}</td>
                                <td>{{ $item->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary and Shipping -->
        <div class="mt-4 row">
            <!-- Order Summary -->
            <div class="col-md-4">
                <h5 class="fw-bold">Order Summary</h5>
                <div class="p-3 card">
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span>{{ 'Rp ' . number_format($order->sub_total, 2, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between text-muted">
                        <small>{{ count($order->items) > 1 ? count($order->items) . ' Items' : count($order->items) . ' Item' }}</small>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>Shipping</span>
                        <span>{{ 'Rp ' . number_format($order->shipping_price, 2, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between text-muted">
                        <small>{{ $order->shipping_type }}</small>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span>{{ 'Rp ' . number_format($order->grand_total, 2, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Shipping Info -->
            <div class="col-md-8">
                <h5 class="fw-bold">Shipping Info</h5>
                <div class="p-3 card">
                    <span>Sent to:</span>
                    <p class="mt-2">{{ $order->address }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
