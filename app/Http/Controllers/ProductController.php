<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'integer', Rule::exists('categories', 'id')],
            'branch' => ['nullable', 'integer', Rule::exists('branches', 'id')],
        ]);

        $products = Product::with(['category', 'branch'])
            ->when($filters['search'] ?? null, function ($query, string $search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($filters['category'] ?? null, fn ($query, int $category) => $query->where('category_id', $category))
            ->when($filters['branch'] ?? null, fn ($query, int $branch) => $query->where('branch_id', $branch))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('products.index', [
            'products' => $products,
            'categories' => Category::orderBy('name')->get(),
            'branches' => Branch::orderBy('name')->get(),
            'filters' => $filters,
        ]);
    }

    public function create(): View
    {
        return view('products.create', $this->formOptions());
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->productRules(true));
        $imagePath = $request->file('image')->store('products', 'public');

        if ($imagePath === false) {
            return back()->withInput()->withErrors([
                'image' => 'The product image could not be saved. Please try again.',
            ]);
        }

        unset($validated['image']);

        Product::create([
            ...$validated,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product): View
    {
        $product->load(['category', 'branch']);

        return view('products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        return view('products.edit', [
            ...$this->formOptions(),
            'product' => $product,
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate($this->productRules(false));
        $oldImagePath = $product->image_path;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');

            if ($imagePath === false) {
                return back()->withInput()->withErrors([
                    'image' => 'The product image could not be saved. Please try again.',
                ]);
            }

            $validated['image_path'] = $imagePath;
        }

        unset($validated['image']);
        $product->update($validated);

        if (isset($validated['image_path']) && $oldImagePath !== $validated['image_path']) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return redirect()->route('products.show', $product)->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $imagePath = $product->image_path;
        $product->delete();
        Storage::disk('public')->delete($imagePath);

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    private function formOptions(): array
    {
        return [
            'categories' => Category::orderBy('name')->get(),
            'branches' => Branch::orderBy('name')->get(),
        ];
    }

    private function productRules(bool $imageRequired): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99', 'decimal:0,2'],
            'email' => ['required', 'email', 'max:255'],
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'branch_id' => ['required', 'integer', Rule::exists('branches', 'id')],
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
