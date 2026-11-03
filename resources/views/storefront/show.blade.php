@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="mb-4">
    <a href="{{ route('shop.index') }}" class="text-decoration-none">&larr; Continue shopping</a>
</div>
<section class="card overflow-hidden mb-5">
    <div class="row g-0">
        <div class="col-lg-7 bg-white d-flex align-items-center justify-content-center p-3 p-lg-5">
            <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($product->image_path) }}" target="_blank" rel="noopener" aria-label="Open full-size {{ $product->name }} image">
                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($product->image_path) }}" alt="{{ $product->name }}" class="store-detail-image rounded">
            </a>
        </div>
        <div class="col-lg-5">
            <div class="card-body p-4 p-lg-5">
                <span class="badge text-bg-light text-primary mb-3">{{ $product->category->name }}</span>
                <h1 class="display-6 page-heading mb-3">{{ $product->name }}</h1>
                <p class="h2 fw-bold text-primary mb-4">{{ number_format((float) $product->price, 2) }}</p>
                <p class="text-secondary">Available from {{ $product->branch->name }}.</p>
                <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($product->image_path) }}" target="_blank" rel="noopener" class="small">Open product image in a new tab</a>
                <div class="border-top mt-4 pt-4">
                    <p class="text-secondary small mb-0">Interested in this product? Contact the store for availability and purchase information.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@if ($relatedProducts->isNotEmpty())
    <section>
        <h2 class="h3 page-heading mb-4">More in {{ $product->category->name }}</h2>
        <div class="row g-4">
            @foreach ($relatedProducts as $relatedProduct)
                <div class="col-sm-6 col-lg-3">
                    <article class="card h-100 overflow-hidden">
                        <a href="{{ route('shop.show', $relatedProduct) }}">
                            <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($relatedProduct->image_path) }}" alt="{{ $relatedProduct->name }}" class="store-product-image">
                        </a>
                        <div class="card-body">
                            <h3 class="h6 fw-bold"><a href="{{ route('shop.show', $relatedProduct) }}" class="text-dark text-decoration-none">{{ $relatedProduct->name }}</a></h3>
                            <p class="fw-bold mb-0">{{ number_format((float) $relatedProduct->price, 2) }}</p>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </section>
@endif
@endsection
