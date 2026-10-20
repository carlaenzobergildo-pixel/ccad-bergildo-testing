<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Warehouse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class ManagerController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('manager/index', [
            'records' => Manager::with('warehouse:id,location')->latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('manager/create', ['options' => $this->options()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Manager::create($this->validated($request));

        return to_route('managers.index');
    }

    public function edit(Manager $manager): Response
    {
        return Inertia::render('manager/edit', ['record' => $manager, 'options' => $this->options()]);
    }

    public function update(Request $request, Manager $manager): RedirectResponse
    {
        $manager->update($this->validated($request, $manager));

        return to_route('managers.index');
    }

    public function destroy(Manager $manager): RedirectResponse
    {
        $manager->delete();

        return to_route('managers.index');
    }

    private function validated(Request $request, ?Manager $manager = null): array
    {
        return $request->validate([
            'warehouse_id' => [
                'required',
                'integer',
                Rule::exists('warehouses', 'id'),
                Rule::unique('managers', 'warehouse_id')->ignore($manager?->id),
            ],
            'mngr_name' => ['required', 'string', 'max:255'],
        ]);
    }

    private function options(): array
    {
        return [
            'warehouses' => Warehouse::query()->orderBy('location')->get(['id', 'location'])->map(fn (Warehouse $warehouse) => ['id' => $warehouse->id, 'label' => $warehouse->location]),
        ];
    }
}
