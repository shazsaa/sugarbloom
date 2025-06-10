@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="p-5 mb-5 text-center rounded bg-image"
            style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
            url('customer-assets/new-toko-kue.jpg'); 
            background-repeat: no-repeat; 
            background-size: cover; 
            background-position: center; 
            height: 500px;">
            <div class="d-flex align-items-center h-100">
                <div class="container text-start">
                    <h1 class="mb-3 text-white" style="font-size: 3rem;">Welcome to Sugar Bloom<br>Your favorite place for delicious cakes and pastries.</h1>
                </div>
            </div>
        </div>

        <div class="mb-5">
            <h2>Our Special Menu</h2>
            
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse ($products as $product)
                <div class="col">
                    <x-product-card :product="$product" />
                </div>
            @empty
                <div class="mx-auto text-center text-secondary-emphasis">
                    <h4>Data Products not yet available.</h4>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            <a href="{{ route('shop') }}"
                class="link-dark link-underline link-underline-opacity-0 link-underline-opacity-75-hover link-offset-3-hover fs-5">Browse
                All Product</a>
        </div>
    </div>
@endsection
