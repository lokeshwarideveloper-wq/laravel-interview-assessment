@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-page">
    <header class="dashboard-header d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4 mb-lg-5">
        <div>
            <p class="dashboard-eyebrow mb-2">Admin overview</p>
            <h1 class="page-heading h2 mb-2">Welcome back, {{ auth()->user()->name }}</h1>
            <p class="text-secondary mb-0">Here’s what’s happening with your product catalog.</p>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-2">
            <span class="dashboard-date">{{ now()->format('M j, Y') }}</span>
            <a class="btn btn-primary px-3" href="{{ route('products.create') }}">
                <svg class="dashboard-button-icon" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                    <path d="M10 4v12M4 10h12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                Add product
            </a>
        </div>
    </header>

    <section class="row g-3 g-lg-4 mb-4 mb-lg-5" aria-label="Catalog summary">
        <div class="col-sm-6 col-xl-4">
            <article class="card dashboard-stat-card h-100">
                <div class="card-body d-flex justify-content-between align-items-start p-4">
                    <div>
                        <p class="dashboard-stat-label mb-2">Total products</p>
                        <p class="dashboard-stat-value mb-2">{{ number_format($productCount) }}</p>
                        <p class="dashboard-stat-note mb-0">Products in your catalog</p>
                    </div>
                    <span class="dashboard-stat-icon dashboard-stat-icon--products" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="m12 3 8 4.5v9L12 21l-8-4.5v-9L12 3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                            <path d="m4.5 7.8 7.5 4.3 7.5-4.3M12 12.2V21" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </div>
            </article>
        </div>
        <div class="col-sm-6 col-xl-4">
            <article class="card dashboard-stat-card h-100">
                <div class="card-body d-flex justify-content-between align-items-start p-4">
                    <div>
                        <p class="dashboard-stat-label mb-2">Categories</p>
                        <p class="dashboard-stat-value mb-2">{{ number_format($categoryCount) }}</p>
                        <p class="dashboard-stat-note mb-0">Ways to organize products</p>
                    </div>
                    <span class="dashboard-stat-icon dashboard-stat-icon--categories" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none">
                            <rect x="4" y="4" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.7"/>
                            <rect x="14" y="4" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.7"/>
                            <rect x="4" y="14" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.7"/>
                            <rect x="14" y="14" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.7"/>
                        </svg>
                    </span>
                </div>
            </article>
        </div>
        <div class="col-sm-6 col-xl-4">
            <article class="card dashboard-stat-card h-100">
                <div class="card-body d-flex justify-content-between align-items-start p-4">
                    <div>
                        <p class="dashboard-stat-label mb-2">Branches</p>
                        <p class="dashboard-stat-value mb-2">{{ number_format($branchCount) }}</p>
                        <p class="dashboard-stat-note mb-0">Locations in your network</p>
                    </div>
                    <span class="dashboard-stat-icon dashboard-stat-icon--branches" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M19 10c0 5-7 11-7 11S5 15 5 10a7 7 0 1 1 14 0Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                            <circle cx="12" cy="10" r="2.3" stroke="currentColor" stroke-width="1.7"/>
                        </svg>
                    </span>
                </div>
            </article>
        </div>
    </section>

    <section class="card dashboard-recent-card">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 px-4 py-4">
            <div>
                <h2 class="h5 fw-bold mb-1">Recently added</h2>
                <p class="dashboard-section-note mb-0">The latest products in your catalog.</p>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-light dashboard-view-all">
                View all products
                <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        @if ($recentProducts->isEmpty())
            <div class="dashboard-empty-state text-center px-4 py-5">
                <span class="dashboard-empty-icon mb-3" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="m12 3 8 4.5v9L12 21l-8-4.5v-9L12 3Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                        <path d="M12 12v4m0-7h.01" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </span>
                <h3 class="h6 fw-bold mb-2">Your catalog is ready for its first product</h3>
                <p class="text-secondary mb-3">Add a product to see your latest updates here.</p>
                <a class="btn btn-primary btn-sm px-3" href="{{ route('products.create') }}">Add your first product</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 dashboard-table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Category</th>
                            <th scope="col" class="d-none d-md-table-cell">Branch</th>
                            <th scope="col" class="text-end">Price</th>
                            <th scope="col"><span class="visually-hidden">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentProducts as $product)
                            <tr>
                                <td>
                                    <a class="dashboard-product-link d-flex align-items-center gap-3" href="{{ route('products.show', $product) }}">
                                        <img
                                            src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($product->image_path) }}"
                                            alt=""
                                            class="product-thumb"
                                            loading="lazy"
                                        >
                                        <span class="fw-semibold">{{ $product->name }}</span>
                                    </a>
                                </td>
                                <td><span class="dashboard-table-tag">{{ $product->category->name }}</span></td>
                                <td class="d-none d-md-table-cell text-secondary">{{ $product->branch->name }}</td>
                                <td class="text-end text-nowrap fw-semibold">{{ number_format((float) $product->price, 2) }}</td>
                                <td class="text-end">
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
</div>
@endsection
