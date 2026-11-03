@extends('layouts.app')

@section('title', 'Add product')

@section('content')
<div class="mb-4">
    <a href="{{ route('products.index') }}" class="text-decoration-none">&larr; Back to products</a>
    <h1 class="h2 page-heading mt-3 mb-1">Add product</h1>
    <p class="text-secondary mb-0">Enter the product details below.</p>
</div>
<section class="card"><div class="card-body p-4 p-lg-5">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('products._form', ['imageRequired' => true])
        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-primary">Save product</button>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div></section>
@endsection
