@extends('admin.layouts.app')

@section('content')
    <div class="my-2 container-fluid">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h2>Orders</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools d-flex">
                    <div class="input-group" style="width: 250px;">
                        <form action="{{ route('order.list') }}" method="GET" class="d-flex">
                            <input type="text" name="search" id="searchInput" class="form-control" placeholder="Search"
                                value="{{ Request::get('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    @if (Request::get('search'))
                        <div>
                            <a href="{{ route('order.list') }}" class="btn">Clear Search</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="p-0 card-body table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="80">#</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Date Purchased</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td class="align-middle">
                                    <a href="javascript:void(0)" id="show-order"
                                        data-url="{{ route('order.show', $order->id) }}"
                                        class="link-offset-2 link-underline link-underline-opacity-0">
                                        {{ $order->id }}
                                    </a>
                                </td>
                                <td class="align-middle">{{ $order->user->name }}</td>
                                <td class="align-middle">{{ $order->user->email }}</td>
                                <td class="align-middle">
                                    <form action="{{ route('order.update', $order) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <select class="form-select me-2" id="statusSelect" name="status"
                                            aria-label="Status" style="width: inherit" onchange="this.form.submit()">
                                            <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>New</option>
                                            <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="align-middle">{{ 'Rp ' . number_format($order->grand_total, 2, ',', '.') }}</td>
                                <td class="align-middle">{{ $order->created_at->format('d F Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="text-center alert alert-danger">
                                        @if (Request::get('search'))
                                            Search result not found.
                                        @else
                                            Records Not Found.
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="orderShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>ID:</strong> <span id="order-id"></span></p>
                    <p><strong>Name:</strong> <span id="order-name"></span></p>
                    <p><strong>Email:</strong> <span id="order-email"></span></p>
                    <hr>
                    <p><strong>Product:</strong> <span id="order-product"></span></p>
                    <hr>
                    <p><strong>Shipping:</strong> <span id="order-shipping"></span></p>
                    <p><strong>Address:</strong> <span id="order-address"></span></p>
                    <hr>
                    <p><strong>Payment:</strong> <span id="order-payment"></span></p>
                    <p><strong>Sub Total:</strong> <span id="order-subTotal"></span></p>
                    <p><strong>Grand Total:</strong> <span id="order-grandTotal"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '#show-order', function() {
                var userURL = $(this).data('url');
                $('#orderShowModal').modal('show');
                $('#order-id').text('Loading...');
                $('#order-name').text('');
                $('#order-email').text('');
                $('#order-address').text('');
                $('#order-payment').text('');
                $('#order-subTotal').text('');
                $('#order-grandTotal').text('');
                $('#order-product').html('');
                $('#order-shipping').html('');

                $.get(userURL, function(data) {
                    const formatCurrency = (value) => {
                        return `Rp ${value}`;
                    };

                    $('#order-id').text(data.id);
                    $('#order-name').text(data.name);
                    $('#order-email').text(data.email);
                    $('#order-address').text(data.address);
                    $('#order-payment').text(data.payment);
                    $('#order-subTotal').text(formatCurrency(data.subTotal));
                    $('#order-grandTotal').text(formatCurrency(data.grandTotal));

                    if (data.products && data.products.length > 0) {
                        let productList = '<ol>';
                        data.products.forEach(function(product) {
                            productList += `<li>${product.name} (Qty: ${product.quantity})</li>`;
                        });
                        productList += '</ol>';
                        $('#order-product').html(productList);
                    } else {
                        $('#order-product').html('<em>No products available</em>');
                    }

                    if (data.shipping) {
                        $('#order-shipping').html(
                            `${data.shipping.type} (Cost: Rp ${data.shipping.cost})`
                        );
                    } else {
                        $('#order-shipping').html('<em>No shipping details available</em>');
                    }
                }).fail(function() {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Failed to fetch order details."
                    });
                });
            });

            function updateUrl() {
                const search = $('#searchInput').val();
                let url = "{{ route('product.list') }}";

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
