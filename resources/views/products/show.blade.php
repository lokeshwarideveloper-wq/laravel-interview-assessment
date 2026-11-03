@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="mb-4">
    <a href="{{ route('products.index') }}" class="text-decoration-none">&larr; Back to products</a>
</div>
<section class="card overflow-hidden">
    <div class="row g-0">
        <div class="col-md-5 bg-light d-flex align-items-center justify-content-center p-4">
            <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($product->image_path) }}" target="_blank" rel="noopener">
                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($product->image_path) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="max-height: 440px; object-fit: contain">
            </a>
        </div>
        <div class="col-md-7">
            <div class="card-body p-4 p-lg-5">
                <p class="text-primary fw-semibold mb-2">{{ $product->category->name }}</p>
                <h1 class="h2 page-heading">{{ $product->name }}</h1>
                <p class="h3 text-primary fw-bold mb-4">{{ number_format((float) $product->price, 2) }}</p>
                <dl class="row">
                    <dt class="col-sm-4">Email ID</dt><dd class="col-sm-8">{{ $product->email }}</dd>
                    <dt class="col-sm-4">Branch</dt><dd class="col-sm-8">{{ $product->branch->name }}</dd>
                    <dt class="col-sm-4">Created</dt><dd class="col-sm-8">{{ $product->created_at->format('M j, Y') }}</dd>
                    <dt class="col-sm-4">Image URL</dt>
                    <dd class="col-sm-8"><a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($product->image_path) }}" target="_blank" rel="noopener" class="text-break">Open image in new tab</a></dd>
                </dl>
                <div class="d-flex flex-wrap gap-2 mt-4">
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">Edit product</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger" type="submit">Delete product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
