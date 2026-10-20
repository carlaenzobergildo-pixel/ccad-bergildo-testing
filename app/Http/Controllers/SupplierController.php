<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SupplierController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('supplier/index', [
            'records' => Supplier::query()->latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('supplier/create');
    }

    public function store(Request $request): RedirectResponse
    {
        Supplier::create($request->validate([
            'supplier_name' => ['required', 'string', 'max:255'],
        ]));

        return to_route('suppliers.index');
    }

    public function edit(Supplier $supplier): Response
    {
        return Inertia::render('supplier/edit', ['record' => $supplier]);
    }

    public function update(Request $request, Supplier $supplier): RedirectResponse
    {
        $supplier->update($request->validate([
            'supplier_name' => ['required', 'string', 'max:255'],
        ]));

        return to_route('suppliers.index');
    }

    public function destroy(Supplier $supplier): RedirectResponse
    {
        $supplier->delete();

        return to_route('suppliers.index');
    }
}
