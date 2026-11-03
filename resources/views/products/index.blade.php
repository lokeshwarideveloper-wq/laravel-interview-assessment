@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <p class="text-primary fw-semibold mb-1">CATALOG</p>
        <h1 class="h2 page-heading mb-1">Products</h1>
        <p class="text-secondary mb-0">Search, filter, and manage your inventory.</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Add product</a>
</div>

<section class="card">
    <div class="card-body p-3 p-lg-4">
        <form action="{{ route('products.index') }}" method="GET" class="row g-2 align-items-end mb-4">
            <div class="col-md-5">
                <label for="search" class="form-label">Search</label>
                <input id="search" name="search" type="search" value="{{ $filters['search'] ?? '' }}" class="form-control" placeholder="Product name or email">
            </div>
            <div class="col-md-3">
                <label for="category" class="form-label">Category</label>
                <select id="category" name="category" class="form-select">
                    <option value="">All categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(($filters['category'] ?? '') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="branch" class="form-label">Branch</label>
                <select id="branch" name="branch" class="form-select">
                    <option value="">All branches</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" @selected(($filters['branch'] ?? '') == $branch->id)>{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1 d-grid">
                <button class="btn btn-dark" type="submit">Go</button>
            </div>
            @if ($filters !== [])
                <div class="col-12"><a href="{{ route('products.index') }}" class="small">Clear filters</a></div>
            @endif
        </form>

        @if ($products->isEmpty())
            <div class="text-center py-5">
                <h2 class="h5">No products found</h2>
                <p class="text-secondary mb-0">Adjust your search or add a new product.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light"><tr><th>Product</th><th>Price</th><th>Email</th><th>Category</th><th>Branch</th><th class="text-end">Actions</th></tr></thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($product->image_path) }}" alt="{{ $product->name }}" class="product-thumb">
                                    <a class="fw-semibold text-decoration-none" href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                </div>
                            </td>
                            <td>{{ number_format((float) $product->price, 2) }}</td>
                            <td>{{ $product->email }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->branch->name }}</td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pt-4">{{ $products->links() }}</div>
        @endif
    </div>
</section>
@endsection
