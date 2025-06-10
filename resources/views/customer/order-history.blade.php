@extends('layouts.app')

@section('content')
    <div class="container">
        @if (count($orders) == 0)
            <div class="py-5 text-center">
                <h4>Let's go shopping now</h4>
                <a href="{{ route('shop') }}"
                    class="fs-6 link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                    Browse all products
                </a>
            </div>
        @else
            <h3 class="mb-4 fw-bold">Order History</h3>
            <div class="card">
                <div class="card-body">
                    <table class="table mb-0 align-middle table-responsive">
                        <thead class="bg-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Total</th>
                                <th>Shipping</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ '#' . $order->id }}</td>
                                    <td>{{ 'Rp ' . number_format($order->grand_total, 2, ',', '.') }}</td>
                                    <td>{{ $order->shipping_type }}</td>
                                    <td>{{ $order->created_at->format('d F Y') }}</td>
                                    <td>{{ $order->status == 'Pending' ? 'Waiting for confirmation' : $order->status }}</td>
                                    <td><a href="{{ route('orderDetails', $order->id) }}">Details</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
    </script>
@endsection
