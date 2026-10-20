<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class WarehouseController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('warehouse/index', [
            'records' => Warehouse::with('supplier:id,supplier_name')->latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('warehouse/create', ['options' => $this->options()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Warehouse::create($this->validated($request));

        return to_route('warehouses.index');
    }

    public function edit(Warehouse $warehouse): Response
    {
        return Inertia::render('warehouse/edit', ['record' => $warehouse, 'options' => $this->options()]);
    }

    public function update(Request $request, Warehouse $warehouse): RedirectResponse
    {
        $warehouse->update($this->validated($request));

        return to_route('warehouses.index');
    }

    public function destroy(Warehouse $warehouse): RedirectResponse
    {
        $warehouse->delete();

        return to_route('warehouses.index');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'supplier_id' => ['required', 'integer', Rule::exists('suppliers', 'id')],
            'location' => ['required', 'string', 'max:255'],
        ]);
    }

    private function options(): array
    {
        return [
            'suppliers' => Supplier::query()->orderBy('supplier_name')->get(['id', 'supplier_name'])->map(fn (Supplier $supplier) => ['id' => $supplier->id, 'label' => $supplier->supplier_name]),
        ];
    }
}
