@extends('admin.layouts.app')

@section('content')
    <div class="my-2 container-fluid">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h2>Create Product</h2>
            </div>
            <div class="text-end col-sm-6">
                <a href="{{ route('product.list') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <section>
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3 card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" name="title" id="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Title" value="{{ old('title') }}">
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Write product description here"
                                                id="description" name="description" style="height: 100px">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 card">
                            <div class="card-body">
                                <label for="product_image" class="form-label">Product Image</label>
                                <input class="form-control @error('product_image') is-invalid @enderror" type="file"
                                    id="product_image" name="product_image">
                                @error('product_image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="text" name="price" id="price"
                                                class="form-control @error('price') is-invalid @enderror"
                                                placeholder="Price" value="{{ old('price') }}">
                                            @error('price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="mb-3 h4">Product category</h2>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select name="category" id="category"
                                        class="form-control @error('category') is-invalid @enderror">
                                        <option value="">Select a Category</option>
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-3 pb-5">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('product.list') }}" class="ms-3 btn btn-outline-dark">Cancel</a>
                </div>
            </div>
        </form>

    </section>
@endsection
