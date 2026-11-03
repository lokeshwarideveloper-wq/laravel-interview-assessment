<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StorefrontController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'integer', Rule::exists('categories', 'id')],
        ]);

        $products = Product::with('category')
            ->when($filters['search'] ?? null, function ($query, string $search): void {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($filters['category'] ?? null, fn ($query, int $category) => $query->where('category_id', $category))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('storefront.index', [
            'products' => $products,
            'categories' => Category::orderBy('name')->get(),
            'filters' => $filters,
        ]);
    }

    public function show(Product $product): View
    {
        $product->load('category');

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->getKey())
            ->latest()
            ->take(4)
            ->get();

        return view('storefront.show', compact('product', 'relatedProducts'));
    }
}
