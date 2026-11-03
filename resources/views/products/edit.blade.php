@extends('layouts.app')

@section('title', 'Edit product')

@section('content')
<div class="mb-4">
    <a href="{{ route('products.show', $product) }}" class="text-decoration-none">&larr; Back to product</a>
    <h1 class="h2 page-heading mt-3 mb-1">Edit product</h1>
    <p class="text-secondary mb-0">Update the details for {{ $product->name }}.</p>
</div>
<section class="card"><div class="card-body p-4 p-lg-5">
    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('products._form', ['imageRequired' => false])
        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <a href="{{ route('products.show', $product) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div></section>
@endsection
