@extends('admin.layouts.app')

@section('content')
    <div class="my-2 container-fluid">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h2>Dashboard</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-3 col-md-6">
                <div class="shadow-sm card">
                    <div class="card-body">
                        <h3>{{ $products }}</h3>
                        <p>Total Products</p>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('product.list') }}" class="text-secondary">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
