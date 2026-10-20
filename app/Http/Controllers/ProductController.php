<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('product/index', ['records' => Product::query()->latest()->get()]);
    }

    public function create(): Response
    {
        return Inertia::render('product/create');
    }

    public function store(Request $request): RedirectResponse
    {
        Product::create($this->validated($request));

        return to_route('products.index');
    }

    public function edit(Product $product): Response
    {
        return Inertia::render('product/edit', ['record' => $product]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $product->update($this->validated($request));

        return to_route('products.index');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return to_route('products.index');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'prod_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);
    }
}
