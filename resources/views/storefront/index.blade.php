@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<section class="rounded-4 p-4 p-lg-5 mb-4 text-white" style="background: linear-gradient(120deg, #14213d, #3156a4)">
    <div class="row align-items-center g-4">
        <div class="col-lg-8">
            <p class="text-uppercase fw-semibold small mb-2">Welcome to Product Store</p>
            <h1 class="display-5 fw-bold mb-3">Find something you'll love.</h1>
            <p class="lead mb-0 text-white-50">Browse our latest products and discover your next favorite.</p>
        </div>
        <div class="col-lg-4">
            <form action="{{ route('shop.index') }}" method="GET" class="bg-white rounded-3 p-3">
                <label for="search" class="form-label text-dark">Search products</label>
                <div class="input-group">
                    <input id="search" type="search" name="search" value="{{ $filters['search'] ?? '' }}" class="form-control" placeholder="Product name">
                    @if (isset($filters['category']))
                        <input type="hidden" name="category" value="{{ $filters['category'] }}">
                    @endif
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
</section>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
    <div>
        <h2 class="h3 page-heading mb-1">Our products</h2>
        <p class="text-secondary mb-0">{{ $products->total() }} products to explore</p>
    </div>
    <form action="{{ route('shop.index') }}" method="GET" class="d-flex gap-2">
        @if (isset($filters['search']))
            <input type="hidden" name="search" value="{{ $filters['search'] }}">
        @endif
        <label for="category" class="visually-hidden">Filter by category</label>
        <select id="category" name="category" class="form-select" onchange="this.form.submit()">
            <option value="">All categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(($filters['category'] ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @if ($filters !== [])
            <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary">Clear</a>
        @endif
    </form>
</div>

@if ($products->isEmpty())
    <div class="card"><div class="card-body text-center py-5">
        <h2 class="h5">No products found</h2>
        <p class="text-secondary mb-0">Try another search or category.</p>
    </div></div>
@else
    <div class="row g-4">
        @foreach ($products as $product)
            @php($imageUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($product->image_path))
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <article class="card h-100 overflow-hidden">
                    <a href="{{ route('shop.show', $product) }}" class="d-block">
                        <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="store-product-image">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <span class="small text-primary fw-semibold mb-2">{{ $product->category->name }}</span>
                        <h3 class="h5 fw-bold"><a href="{{ route('shop.show', $product) }}" class="text-dark text-decoration-none">{{ $product->name }}</a></h3>
                        <div class="mt-auto d-flex justify-content-between align-items-center pt-2">
                            <span class="fs-5 fw-bold">{{ number_format((float) $product->price, 2) }}</span>
                            <a href="{{ route('shop.show', $product) }}" class="btn btn-outline-primary btn-sm">View product</a>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
    <div class="mt-4">{{ $products->links() }}</div>
@endif
@endsection
