<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'productCount' => Product::count(),
            'categoryCount' => Category::count(),
            'branchCount' => Branch::count(),
            'recentProducts' => Product::with(['category', 'branch'])
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
